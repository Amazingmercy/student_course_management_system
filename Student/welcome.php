<?php
require_once 'db_config.php';

session_start();
if (!isset($_SESSION['fname'])) {
    header("Location: login.html");
    exit();
}



$username = $_SESSION['fname'];
$courseMsg2 =  "Course removed successfully";
$courseMsg1 = "Course already added!";
$courseMsg = "Course added successfully";


$sql = "SELECT * FROM courses WHERE student_name = '$username'";
$result = $conn->query($sql);
$courses = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row['course_name'];
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_course'])) {
        $courseName = $_POST['course_name'];
        $courseCode = $_POST['course_code'];

        // Check if the course is already added for the student
        if (!in_array($courseName, $courses)) {
            // Add the course to the 'courses' table
            $sql = "INSERT INTO courses (course_name, course_code, student_name) VALUES ('$courseName', '$courseCode','$username')";
            if ($conn->query($sql) === TRUE) {
                $courses[] = $courseName;
                echo "<h3>" .$courseMsg . "</h3>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }else {
            echo "<h3>" .$courseMsg1 . "</h3>";
        }
    } elseif (isset($_POST['remove_course'])) {
        // Process the removal of the course
        $courseName = $_POST['course_name'];
        if (in_array($courseName, $courses)) {
            // Remove the course from the 'courses' table
            $sql = "DELETE FROM courses WHERE course_name = '$courseName'";
            if ($conn->query($sql) === TRUE) {
                echo "<h3>" .$courseMsg2 . "</h3>";
                $courses = array_diff($courses, array($courseName));
            } else {
                // Course removal failed
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Course not found.";
        }
    }
}

$conn->close();
?>




<!DOCTYPE html>
<html>
<head>
  <title>Welcome to Student Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Welcome, <?php echo $username; ?>!</h2>
    <h3>Your Courses:</h3>
    
    <form action="welcome.php" method="POST">
      <label for="course_name">Course Name:</label>
      <input type="text" name="course_name" required>
      <label for="course_name">Course Code:</label>
      <input type="text" name="course_code" required>
      <button type="submit" name="add_course">Add Course</button><br><br>
      <button type="submit" name="remove_course">Remove Course</button><br><br>
    </form>
    <a href="view.php">View courses</a>
    <a href="logout.php">Logout</a>
  </div>
</body>
</html>