<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare statement
    $stmt = $conn->prepare("DELETE FROM inventory WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" means integer

    if ($stmt->execute()) {
        header("Location: inventory.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
