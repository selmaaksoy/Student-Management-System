<?php
session_start();


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $student_id = $_GET['id'];

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = "phplogin";

   
    $conn = new mysqli($servername, $username, $password, $database);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare an SQL statement to delete a student record with the given student ID
    $sql = "DELETE FROM students WHERE student_id=?";
    $stmt = $conn->prepare($sql);
     // Bind the student ID to the SQL statement as an integer parameter
    $stmt->bind_param("i", $student_id);

  
    if ($stmt->execute()) {
        $_SESSION['message'] = "Student deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting student: " . $conn->error;
    }

   
    $conn->close();
} else {
    $_SESSION['error'] = "Invalid student ID";
}


header("Location: display.php");
exit();
?>
