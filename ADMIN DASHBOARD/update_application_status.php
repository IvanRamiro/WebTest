<?php
include 'config.php';

header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_POST['id'] ?? 0;
    $status = $_POST['status'] ?? '';
    
    if (!in_array($status, ['pending', 'approved', 'rejected'])) {
        throw new Exception('Invalid status');
    }

    $stmt = $pdo->prepare("
        UPDATE loan_application 
        SET status = ?
        WHERE id = ?
    ");
    $stmt->execute([$status, $id]);

    echo json_encode([
        'success' => true,
        'message' => 'Status updated successfully'
    ]);
} catch(Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}