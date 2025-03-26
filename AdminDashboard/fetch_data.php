<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = $_POST['type'];

if ($type == "inventory") {
    $result = $conn->query("SELECT COUNT(*) AS count FROM inventory");
} elseif ($type == "news_events") {
    $result = $conn->query("SELECT COUNT(*) AS count FROM news_events");
} elseif ($type == "users") {
    $result = $conn->query("SELECT COUNT(*) AS count FROM users");
}

$data = $result->fetch_assoc();
echo json_encode($data);

$conn->close();
?>
