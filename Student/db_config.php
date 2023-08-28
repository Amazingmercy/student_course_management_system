<?php
// Replace these values with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "Jerule@499";
$dbname = "student";

// Create the database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    echo "";
}
?>
