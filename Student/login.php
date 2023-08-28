<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['fname']);
    $password = trim($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Implement login validation using database query
    // Assuming you have a 'students' table with 'username' and 'password' columns
    $sql = "SELECT * FROM user WHERE first_name = '$username'";
    $result = $conn->query($sql)->fetch_assoc();
    //var_dump($result);
    //exit;

    

    if (count($result) > 0 and password_verify($password, $result['password'])) {
        session_start();
        $_SESSION['fname'] = $username;
        header("Location: welcome.php");
        exit();
}
    else {
        echo "Invalid username or password.";
    }
}

$conn->close();
?>
