
<?php
session_start();

$servername = 'localhost';
$username = 'root';
$password = '';
$database = "phplogin";


$conn = new mysqli($servername, $username, $password, $database);



if(isset($_GET['id'])) {
   
    $student_id = $_GET['id'];
    
   
    $sql = "SELECT * FROM students WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    
    if($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        $_SESSION['error'] = "Student not found.";
        header("Location: display.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Student ID not provided.";
    header("Location: display.php");
    exit();
}


if($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $grade = $_POST['grade'];
    $gender = $_POST['gender'];
    
    
    $sql = "UPDATE students SET name=?, surname=?, grade=?, gender=? WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $surname, $grade, $gender, $student_id);
    if ($stmt->execute() === TRUE) {
        $_SESSION['message'] = "Student information updated successfully.";
    } else {
        $_SESSION['error'] = "Error updating student information: " . $conn->error;
    }
    
    
    header("Location: display.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Student</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .content {
            width: 60%;
            margin: 30px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center; 
        }

        h2 {
            text-align: center;
        }

        form {
            display: inline-block;
            text-align: left; 
            margin: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px; 
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
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
        <h2>Edit Student</h2>
        <?php
        if(isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>
     <form action="studentupdate.php" method="post">
     <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" pattern="[A-Za-z]+" title="Name should only contain letters" required>
            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($student['surname']); ?>" pattern="[A-Za-z]+" title="Surname should only contain letters" required>
            <label for="grade">Grade:</label>
            <select id="grade" name="grade" required>
                <option value="">Select Grade</option>
                <option value="1" <?php if($student['grade'] == 1) echo 'selected'; ?>>Grade 1</option>
                <option value="2" <?php if($student['grade'] == 2) echo 'selected'; ?>>Grade 2</option>
                <option value="3" <?php if($student['grade'] == 3) echo 'selected'; ?>>Grade 3</option>
                <option value="4" <?php if($student['grade'] == 4) echo 'selected'; ?>>Grade 4</option>
                <option value="5" <?php if($student['grade'] == 5) echo 'selected'; ?>>Grade 5</option>
                <option value="6" <?php if($student['grade'] == 6) echo 'selected'; ?>>Grade 6</option>
                <option value="7" <?php if($student['grade'] == 7) echo 'selected'; ?>>Grade 7</option>
                <option value="8" <?php if($student['grade'] == 8) echo 'selected'; ?>>Grade 8</option>
                <option value="9" <?php if($student['grade'] == 9) echo 'selected'; ?>>Grade 9</option>
                <option value="10" <?php if($student['grade'] == 10) echo 'selected'; ?>>Grade 10</option>
                <option value="11" <?php if($student['grade'] == 11) echo 'selected'; ?>>Grade 11</option>
                <option value="12" <?php if($student['grade'] == 12) echo 'selected'; ?>>Grade 12</option>
            </select>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="male" <?php if($student['gender'] == 'male') echo 'selected'; ?>>Male</option>
                <option value="female" <?php if($student['gender'] == 'female') echo 'selected'; ?>>Female</option>
            </select>
            <input type="submit" value="Save Changes">
            <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student['student_id']); ?>">
        </form>
    </div>
</body>
</html>
