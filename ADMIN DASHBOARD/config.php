<?php
$host = "localhost";
$username = "root"; // changed from $user
$password = "";     // changed from $pass
$dbname = "fastcash_db"; // Change to your DB name

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
