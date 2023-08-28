<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['fname']);
    $lastname = trim($_POST['lname']);
    $department = trim($_POST['dept']);
    $gender = trim($_POST['gender']);
    $password = trim($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);



    // Implement registration process and database insertion
    // Assuming you have a 'students' table with 'username' and 'password' columns
    $sql = "INSERT INTO user (first_name, last_name, department, gender, password) VALUES ('$username', '$lastname',  '$department', '$gender', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful
        echo "Registration successful!";
        header("Location: login.html");

        exit();
    } else {
        // Registration failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
