<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = ''; // Replace with your actual password
$database = 'qcredit_db'; 

// Create a new connection using MySQLi
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    // If there's an error, display a message and terminate the script
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, you can set the charset to avoid character encoding issues
$conn->set_charset("utf8");

?>
