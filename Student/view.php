<?php
require_once 'db_config.php';

session_start();
$username = $_SESSION['fname'];

$sql = "SELECT course_id, course_name, course_code FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Course List</title>
</head>
    <h2>Course List</h2>
    <link rel="stylesheet" href="style.css">
    <div class="container">
    <table>
        <tr>
            <th>Course Name</th>
            <th>Course Code</th>
        </tr>
        <?php
        // Loop through the course data and create table rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['course_name'] . "</td>";
            echo "<td>" . $row['course_code'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table><br>

    <a href="welcome.php">Back</a>
    </div>
</body>
</html>
