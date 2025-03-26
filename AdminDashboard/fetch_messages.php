<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory_db";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT client_name, email, message, 
               DATE_FORMAT(request_date, '%d %b %Y %h:%i %p') AS request_time 
        FROM client_messages 
        ORDER BY request_date DESC";
$result = $conn->query($sql);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);
$conn->close();
?>
