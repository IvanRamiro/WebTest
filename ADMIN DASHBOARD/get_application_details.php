<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    header('Content-Type: application/json');

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_GET['id'];

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
                agree_terms,
                allow_marketing,
                DATE_FORMAT(submitted_at, '%Y-%m-%d %H:%i:%s') as submitted_at
            FROM loan_application 
            WHERE id = ?
        ");
        $stmt->execute([$id]);
        $application = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($application) {
            $application['full_name'] = trim(
                $application['first_name'] . ' ' .
                ($application['middle_name'] ? $application['middle_name'] . ' ' : '') .
                $application['last_name']
            );

            $application['monthly_income'] = number_format($application['monthly_income'], 2);
            $application['loan_amount'] = number_format($application['loan_amount'], 2);

            $application['same_as_current'] = $application['same_as_current'] ? 'Yes' : 'No';
            $application['agree_terms'] = $application['agree_terms'] ? 'Yes' : 'No';
            $application['allow_marketing'] = $application['allow_marketing'] ? 'Yes' : 'No';

            $docTypes = ['valid_id_1', 'valid_id_2', 'proof_of_income', 'proof_of_billing'];
            foreach ($docTypes as $docType) {
                if (!empty($application[$docType])) {
                    $fileName = basename($application[$docType]);
                    $absolutePath = $_SERVER['DOCUMENT_ROOT'] . '/website/ImageUpload/' . $fileName;
            
                    if (file_exists($absolutePath)) {
                        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
                        $host = $_SERVER['HTTP_HOST'];
                        $application[$docType . '_url'] = $protocol . $host . '/website/ImageUpload/' . $fileName;
                    } else {
                        $application[$docType . '_url'] = null;
                    }
                } else {
                    $application[$docType . '_url'] = null;
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
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
}
