<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory_db";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT item_name, borrower, 
               DATE_FORMAT(borrow_date, '%d %b') AS borrow_day, 
               DATE_FORMAT(return_date, '%d %b') AS return_day,
               CASE 
                   WHEN return_date < CURDATE() THEN 'Overdue'
                   WHEN borrow_date <= CURDATE() AND return_date >= CURDATE() THEN 'In Use'
                   ELSE 'Upcoming'
               END AS status
        FROM lending_items";
$result = $conn->query($sql);

$trackingData = [];
while ($row = $result->fetch_assoc()) {
    $trackingData[] = $row;
}

echo json_encode($trackingData);
$conn->close();
?>
