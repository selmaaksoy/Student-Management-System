<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add Student</title>
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
        <h2>Add Student</h2>
         <!-- Form to add a student, sending data to process_student.php using POST method -->
        <form action="process_student.php" method="POST">
        <label for="name">Name:</label>
            <input type="text" id="name" name="name" pattern="[A-Za-z]+" title="Name should only contain letters" required>
            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" pattern="[A-Za-z]+" title="Surname should only contain letters" required>
            <label for="grade">Grade:</label>
            <select id="grade" name="grade" required>
                <option value="">Select Grade</option>
                <option value="grade1">Grade 1</option>
                <option value="grade2">Grade 2</option>
                <option value="grade1">Grade 3</option>
                <option value="grade2">Grade 4</option>
                <option value="grade1">Grade 5</option>
                <option value="grade2">Grade 6</option>
                <option value="grade1">Grade 7</option>
                <option value="grade2">Grade 8</option>
                <option value="grade1">Grade 9</option>
                <option value="grade2">Grade 10</option>
                <option value="grade1">Grade 11</option>
                <option value="grade2">Grade 12</option>
               
            </select>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <!-- Submit button to add the student -->
            <input type="submit" value="Add Student">
        </form>
    </div>
</body>
</html>
