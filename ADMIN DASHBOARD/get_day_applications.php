<?php
include 'config.php';

header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $day = (int)$_GET['day'];
    $month = (int)$_GET['month'];
    $year = (int)$_GET['year'];

    // Get applications for the specific day
    $stmt = $pdo->prepare("
        SELECT id, first_name, last_name, submitted_at 
        FROM loan_application 
        WHERE DAY(submitted_at) = :day 
        AND MONTH(submitted_at) = :month 
        AND YEAR(submitted_at) = :year
        ORDER BY submitted_at DESC
    ");
    $stmt->execute([':day' => $day, ':month' => $month, ':year' => $year]);
    $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get weekly statistics
    $weeklyStmt = $pdo->prepare("
        SELECT DAYNAME(submitted_at) as day, COUNT(*) as count 
        FROM loan_application 
        WHERE submitted_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
        GROUP BY DAYNAME(submitted_at)
        ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')
    ");
    $weeklyStmt->execute();
    $weeklyData = $weeklyStmt->fetchAll(PDO::FETCH_KEY_PAIR);

    // Get monthly statistics
    $monthlyStmt = $pdo->prepare("
        SELECT MONTHNAME(submitted_at) as month, COUNT(*) as count 
        FROM loan_application 
        WHERE YEAR(submitted_at) = YEAR(CURDATE())
        GROUP BY MONTHNAME(submitted_at), MONTH(submitted_at)
        ORDER BY MONTH(submitted_at)
    ");
    $monthlyStmt->execute();
    $monthlyData = $monthlyStmt->fetchAll(PDO::FETCH_KEY_PAIR);

    // Get yearly statistics
    $yearlyStmt = $pdo->prepare("
        SELECT YEAR(submitted_at) as year, COUNT(*) as count 
        FROM loan_application 
        GROUP BY YEAR(submitted_at)
        ORDER BY YEAR(submitted_at)
    ");
    $yearlyStmt->execute();
    $yearlyData = $yearlyStmt->fetchAll(PDO::FETCH_KEY_PAIR);

    echo json_encode([
        'success' => true,
        'applications' => $applications,
        'statistics' => [
            'weekly' => $weeklyData,
            'monthly' => $monthlyData,
            'yearly' => $yearlyData
        ]
    ]);
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>