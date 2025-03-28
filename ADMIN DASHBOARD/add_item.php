<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $stock = intval($_POST['stock']);
    $price = floatval($_POST['price']);

    // Prepare an SQL statement to prevent SQL injection
    $sql = "INSERT INTO inventory (name, stock, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("sid", $name, $stock, $price); // "sid" = string, integer, double
        if ($stmt->execute()) {
            header("Location: inventory.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();
?>
