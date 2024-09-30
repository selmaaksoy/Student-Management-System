<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = "phplogin";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add a new student to the database
function addStudent($name, $surname, $grade, $gender) {
    global $conn;
    $sql = "INSERT INTO students (name, surname, grade, gender) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $surname, $grade, $gender);
    if ($stmt->execute() === TRUE) {
        return "New record created successfully";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to retrieve all student records from the database
function getStudents() {
    global $conn;
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
    return $students;
}

// Function to update an existing student record in the database
function updateStudent($id, $name, $surname, $grade, $gender) {
    global $conn;
    $sql = "UPDATE students SET name=?, surname=?, grade=?, gender=? WHERE student_id=?";
    // Prepare the SQL statement for updating a student record
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $surname, $grade, $gender, $id);
    if ($stmt->execute() === TRUE) {
        return "Record updated successfully";
    } else {
        return "Error updating record: " . $conn->error;
    }
}

// Function to delete a student record from the database
function deleteStudent($id) {
    global $conn;
    $sql = "DELETE FROM students WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute() === TRUE) {
        return "Record deleted successfully";
    } else {
        return "Error deleting record: " . $conn->error;
    }
}


$conn->close();
?>
