<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $status = $_POST['status'] ?? null;
    
    if ($id && $status && in_array($status, ['pending', 'approved', 'rejected'])) {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $pdo->prepare("UPDATE loan_application SET status = ? WHERE id = ?");
            $stmt->execute([$status, $id]);
            
            echo "Status updated successfully";
        } catch(PDOException $e) {
            http_response_code(500);
            echo "Error updating status: " . $e->getMessage();
        }
    } else {
        http_response_code(400);
        echo "Invalid request";
    }
} else {
    http_response_code(405);
    echo "Method not allowed";
}
?>