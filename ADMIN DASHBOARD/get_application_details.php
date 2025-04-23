<?php
include 'config.php';

header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET['id'] ?? 0;
    
    $stmt = $pdo->prepare("
        SELECT 
            id,
            first_name,
            middle_name,
            last_name,
            birth_date,
            civil_status,
            email,
            mobile,
            current_address,
            permanent_address,
            same_as_current,
            city,
            province,
            zip_code,
            employment_status,
            monthly_income,
            employer_name,
            job_position,
            work_duration,
            work_address,
            loan_amount,
            loan_purpose,
            loan_term,
            payment_method,
            valid_id_1,
            valid_id_2,
            proof_of_income,
            proof_of_billing,
            status,
            DATE_FORMAT(submitted_at, '%Y-%m-%d %H:%i:%s') as submitted_at
        FROM loan_application 
        WHERE id = ?
    ");
    $stmt->execute([$id]);
    $application = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($application) {
        $application['full_name'] = trim($application['first_name'] . ' ' . 
                                      ($application['middle_name'] ? $application['middle_name'] . ' ' : '') . 
                                      $application['last_name']);
        
        $application['monthly_income'] = number_format($application['monthly_income'], 2);
        $application['loan_amount'] = number_format($application['loan_amount'], 2);
        
        $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $uploadPath = '/fastcash/uploads/';
        
        $docFields = ['valid_id_1', 'valid_id_2', 'proof_of_income', 'proof_of_billing'];
        
        foreach ($docFields as $field) {
            if (!empty($application[$field])) {
                $filename = basename($application[$field]);
                $application[$field] = [
                    'url' => $baseUrl . $uploadPath . rawurlencode($filename),
                    'name' => $filename,
                    'type' => pathinfo($filename, PATHINFO_EXTENSION)
                ];
            } else {
                $application[$field] = null;
            }
        }

        echo json_encode([
            'success' => true,
            'data' => $application
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Application not found'
        ]);
    }
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}