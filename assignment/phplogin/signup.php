<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
       
        <form action="signup_process.php" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Enter your username" required>
            
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="at least 6 characters long" minlength="6" required>
            
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>
            
            <input type="submit" value="Sign Up">

        </form>
    </div>
</body>
</html>

