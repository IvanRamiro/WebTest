<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE inventory SET name=?, stock=?, price=? WHERE id=?");
    $stmt->bind_param("siii", $name, $stock, $price, $id);

    if ($stmt->execute()) {
        header("Location: inventory.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
