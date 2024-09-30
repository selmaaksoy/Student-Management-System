<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = 'localhost';
$username = 'root';
$password = '';
$database = "phplogin";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['student_id'], $_POST['name'], $_POST['surname'], $_POST['grade'], $_POST['gender'])) {
        $student_id = $_POST['student_id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $grade = $_POST['grade'];
        $gender = $_POST['gender'];

        // Sanitize inputs
        $name = $conn->real_escape_string($name);
        $surname = $conn->real_escape_string($surname);
        $grade = $conn->real_escape_string($grade);
        $gender = $conn->real_escape_string($gender);

        $sql = "UPDATE students SET name=?, surname=?, grade=?, gender=? WHERE student_id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("ssssi", $name, $surname, $grade, $gender, $student_id);
        if ($stmt->execute() === false) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        } else {
            $_SESSION['message'] = "Student information updated successfully!";
            header("Location: display.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Missing form data.";
        header("Location: edit_student.php?id=$student_id");
        exit();
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: display.php");
    exit();
}
?>
