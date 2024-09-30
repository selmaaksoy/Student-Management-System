<?php
session_start();

$servername = 'localhost';
$username = 'root';
$password = '';
$database = "phplogin";


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM students";
$result = $conn->query($sql);
// Initialize an empty array to store the student records
$students = array();
if ($result->num_rows > 0) {
    // Fetch each record as an associative array and add it to the $students array
    while($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}


$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Display Student</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .content {
            width: 80%;
            margin: 30px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center; 
        }
        </style>

</head>
<body class="loggedin">
    <nav class="navtop">
        <div>
            <h1>Student Management System </h1>
            <a href="home.php"><i class="fas fa-home"></i>Home</a>
            <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>
    <div class="content">
        <h2>Display Student</h2>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<p class='success'>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Grade</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($students as $student) {
                    echo "<tr>";
                    echo "<td>" . $student['student_id'] . "</td>";
                    echo "<td>" . $student['name'] . "</td>";
                    echo "<td>" . $student['surname'] . "</td>";
                    echo "<td>" . $student['grade'] . "</td>";
                    echo "<td>" . $student['gender'] . "</td>";
                    echo "<td><a href='edit_student.php?id=" . $student['student_id'] . "'>Edit</a> | <a href='delete_student.php?id=" . $student['student_id'] . "'>Delete</a></td>"; // Added edit and delete links
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
