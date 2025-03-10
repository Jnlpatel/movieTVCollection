<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Change to your actual username
$password = ""; // Change to your actual password
$dbname = "media_collection";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>