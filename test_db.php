<?php
include 'config.php';

try {
    $stmt = $pdo->query("SHOW TABLES");
    echo "Database connection successful. Tables in database:<br>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row["Tables_in_qcredit_db"] . "<br>";
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
