<?php
$host = "localhost";
$user = "root"; // Change if needed
$pass = "";
$dbname = "qcredit_db"; // Change to your DB name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
