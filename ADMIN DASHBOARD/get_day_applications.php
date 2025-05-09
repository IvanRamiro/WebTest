<?php
include 'config.php';

header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $day = (int)$_GET['day'];
    $month = (int)$_GET['month'];
    $year = (int)$_GET['year'];

    $stmt = $pdo->prepare("
        SELECT id, first_name, last_name, status, submitted_at 
        FROM loan_application 
        WHERE DAY(submitted_at) = :day 
        AND MONTH(submitted_at) = :month 
        AND YEAR(submitted_at) = :year
        ORDER BY submitted_at DESC
    ");
    $stmt->execute([':day' => $day, ':month' => $month, ':year' => $year]);
    $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'applications' => $applications
    ]);
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>