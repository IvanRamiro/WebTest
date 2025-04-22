<?php
include 'config.php';

header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET['id'] ?? 0;
    
    $stmt = $pdo->prepare("
        SELECT * FROM loan_application 
        WHERE id = ?
    ");
    $stmt->execute([$id]);
    $application = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($application) {
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