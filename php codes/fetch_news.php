<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qcredit_db";

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch news items
    $stmt = $conn->prepare("SELECT * FROM news ORDER BY date DESC LIMIT 3");
    $stmt->execute();

    // Return news items as JSON
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($news);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
