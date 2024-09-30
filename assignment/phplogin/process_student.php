<?php
session_start();
// Database connection parameters
$servername = 'localhost';
$username = 'root';
$password = '';
$database = "phplogin";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $grade = $_POST['grade'];
    $gender = $_POST['gender'];

   
    $sql = "INSERT INTO students (name, surname, grade, gender) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $surname, $grade, $gender);
    if ($stmt->execute() === TRUE) {
        $_SESSION['message'] = "Student added successfully";
    } else {
        $_SESSION['error'] = "Error adding student: " . $conn->error;
    }

    
    header("Location: home.php");
    exit();
}
?>
