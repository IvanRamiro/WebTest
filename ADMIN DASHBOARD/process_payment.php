<?php
include 'config.php';

header('Content-Type: application/json');

// Function to validate payment data
function validatePaymentData($data) {
    $errors = [];
    
    if (!isset($data['loan_id']) || !is_numeric($data['loan_id'])) {
        $errors[] = "Invalid loan ID";
    }
    
    if (!isset($data['amount']) || !is_numeric($data['amount']) || $data['amount'] <= 0) {
        $errors[] = "Payment amount must be a positive number";
    }
    
    if (!isset($data['date']) || !strtotime($data['date'])) {
        $errors[] = "Invalid payment date";
    }
    
    if (!isset($data['type']) || !in_array($data['type'], ['full', 'partial', 'interest'])) {
        $errors[] = "Invalid payment type";
    }
    
    return $errors;
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get and validate input
    $input = [
        'loan_id' => $_POST['loan_id'] ?? null,
        'amount' => $_POST['amount'] ?? null,
        'date' => $_POST['date'] ?? null,
        'type' => $_POST['type'] ?? null,
        'notes' => $_POST['notes'] ?? null
    ];

    $validationErrors = validatePaymentData($input);
    if (!empty($validationErrors)) {
        throw new Exception(implode(", ", $validationErrors));
    }

    $pdo->beginTransaction();

    // 1. Get current loan details with borrower information
    $stmt = $pdo->prepare("
        SELECT lt.*, la.loan_amount as original_amount, 
               CONCAT(la.first_name, ' ', la.last_name) as borrower_name
        FROM loan_tracking lt
        JOIN loan_application la ON lt.loan_id = la.id
        WHERE lt.loan_id = ?
    ");
    $stmt->execute([$input['loan_id']]);
    $loan = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$loan) {
        throw new Exception("Loan not found or not approved");
    }

    // Validate payment amount doesn't exceed balance
    if ($input['amount'] > $loan['current_balance']) {
        throw new Exception("Payment amount exceeds current balance");
    }

    // 2. Update loan tracking
    $newBalance = $loan['current_balance'] - $input['amount'];
    $status = ($newBalance <= 0) ? 'completed' : 'active';
    $nextPaymentDate = ($status == 'active') ? date('Y-m-d', strtotime($input['date'] . ' +1 month')) : null;

    $updateStmt = $pdo->prepare("
        UPDATE loan_tracking 
        SET current_balance = ?,
            last_payment_date = ?,
            last_payment_amount = ?,
            total_paid = total_paid + ?,
            next_payment_date = ?,
            status = ?,
            updated_at = NOW()
        WHERE loan_id = ?
    ");
    $updateStmt->execute([
        max(0, $newBalance),
        $input['date'],
        $input['amount'],
        $input['amount'],
        $nextPaymentDate,
        $status,
        $input['loan_id']
    ]);

    // 3. Record payment in payment history
    $paymentStmt = $pdo->prepare("
        INSERT INTO loan_payments 
        (loan_id, amount, payment_date, payment_type, notes, created_at)
        VALUES (?, ?, ?, ?, ?, NOW())
    ");
    $paymentStmt->execute([
        $input['loan_id'],
        $input['amount'],
        $input['date'],
        $input['type'],
        $input['notes']
    ]);

    // 4. If loan is completed, update completion date
    if ($status == 'completed') {
        $completeStmt = $pdo->prepare("
            UPDATE loan_tracking 
            SET completed_at = NOW() 
            WHERE loan_id = ?
        ");
        $completeStmt->execute([$input['loan_id']]);
    }

    // Commit transaction
    $pdo->commit();

    // Prepare response with loan details
    $response = [
        'success' => true,
        'message' => 'Payment processed successfully',
        'data' => [
            'loan_id' => $input['loan_id'],
            'borrower' => $loan['borrower_name'],
            'payment_amount' => number_format($input['amount'], 2),
            'new_balance' => number_format($newBalance, 2),
            'payment_type' => $input['type'],
            'loan_status' => $status
        ]
    ];

    echo json_encode($response);

} catch (PDOException $e) {
    $pdo->rollBack();
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage(),
        'error_code' => $e->getCode()
    ]);
} catch (Exception $e) {
    if (isset($pdo)) {
        $pdo->rollBack();
    }
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}