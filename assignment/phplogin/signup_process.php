<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';


$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
   
    exit('Please fill all the required fields!');
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    
    if (strlen($password) < 6) {
        echo "Password must be at least 6 characters long.";
        exit();
    }

    
    if (preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $email)) {
        echo "Valid email address";
    } else {
        echo "Invalid email address            ";
        
    }
    
}

// Check if the username is already taken.
if ($stmt = $con->prepare('SELECT id FROM accounts WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        
        echo 'Username already exists, please choose a different one!';
    } else {
       
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Insert the user into the database
        if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
            $stmt->bind_param('sss', $_POST['username'], $hashed_password, $_POST['email']);
            $stmt->execute();
            echo 'Sign up successful! Please return to the login page.';
        } 
      
        else {
           
            echo 'Could not prepare statement!';
        }
    }
    $stmt->close();
}
?>

