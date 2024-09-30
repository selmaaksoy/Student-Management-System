<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';

// Establish a connection to the MySQL database
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Check if the username and password have been submitted via POST
if ( !isset($_POST['username'], $_POST['password']) ) {
	
	exit('Please fill both the username and password fields!');
}

// Prepare an SQL statement to select the user's ID and hashed password from the database
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	
    // Bind the submitted username to the SQL statement as a string parameter
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();

	$stmt->store_result();

    // Check if the username exists in the database
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
       // Verify the submitted password against the hashed password in the database
        if (password_verify($_POST['password'], $password)) {
            
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: home.php');
        } else {
         
            echo 'Incorrect username and/or password!';
        }
    } else {

        echo 'Incorrect username and/or password!';
    }


	$stmt->close();
}
?>