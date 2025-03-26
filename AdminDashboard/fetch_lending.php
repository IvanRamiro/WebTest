<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory_db";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT item_name, DATE_FORMAT(borrow_date, '%d %b') AS borrow_day, 
               DATE_FORMAT(return_date, '%d %b') AS return_day 
        FROM lending_items";
$result = $conn->query($sql);

$lendingData = [];
while ($row = $result->fetch_assoc()) {
    $lendingData[] = $row;
}

echo json_encode($lendingData);
$conn->close();
?>
