<?php
include 'config.php';

header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = json_decode(file_get_contents('php://input'), true);
    
    $loanId = $data['loan_id'];
    $amount = $data['amount'];
    $paymentDate = $data['date'];
    $paymentType = $data['type'];
    $notes = $data['notes'];

    $pdo->beginTransaction();

    $stmt = $pdo->prepare("SELECT * FROM loan_tracking WHERE loan_id = ?");
    $stmt->execute([$loanId]);
    $loan = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$loan) {
        $stmt = $pdo->prepare("
            INSERT INTO loan_tracking (loan_id, original_amount, current_balance, total_paid, status)
            SELECT id, loan_amount, loan_amount, 0, 'active' 
            FROM loan_application 
            WHERE id = ? AND status = 'approved'
        ");
        $stmt->execute([$loanId]);
        
        if ($stmt->rowCount() === 0) {
            throw new Exception("Loan not found or not approved");
        }
        
        $stmt = $pdo->prepare("SELECT * FROM loan_tracking WHERE loan_id = ?");
        $stmt->execute([$loanId]);
        $loan = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($amount <= 0) {
        throw new Exception("Payment amount must be positive");
    }

    if ($amount > $loan['current_balance'] && $paymentType !== 'interest') {
        throw new Exception("Payment amount cannot exceed current balance");
    }

    $stmt = $pdo->prepare("
        INSERT INTO loan_payments (loan_id, amount, payment_date, payment_type, notes)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([$loanId, $amount, $paymentDate, $paymentType, $notes]);

    $newBalance = $paymentType === 'interest' 
        ? $loan['current_balance'] 
        : max(0, $loan['current_balance'] - $amount);
    
    $totalPaid = $loan['total_paid'] + $amount;
    
    $newStatus = $newBalance <= 0 ? 'completed' : $loan['status'];

    $stmt = $pdo->prepare("
        UPDATE loan_tracking 
        SET current_balance = ?, 
            total_paid = ?, 
            status = ?,
            updated_at = NOW()
        WHERE loan_id = ?
    ");
    $stmt->execute([$newBalance, $totalPaid, $newStatus, $loanId]);

    $pdo->commit();

    $stmt = $pdo->prepare("
        SELECT CONCAT(first_name, ' ', last_name) as borrower 
        FROM loan_application 
        WHERE id = ?
    ");
    $stmt->execute([$loanId]);
    $borrower = $stmt->fetchColumn();

    echo json_encode([
        'success' => true,
        'amount' => number_format($amount, 2),
        'borrower' => $borrower,
        'new_balance' => number_format($newBalance, 2)
    ]);

} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}