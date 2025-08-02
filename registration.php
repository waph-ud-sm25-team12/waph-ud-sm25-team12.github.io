<?php
session_start();
require_once "functions.php";
$token = generateCSRFToken();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - miniFacebook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Register New User</h2>
    <form method="POST" action="addnewuser.php">
        <input type="hidden" name="csrf_token" value="<?= $token ?>">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        Phone: <input type="text" name="phone" required><br>
        <button type="submit">Register</button>
    </form>
    <p><a href="form.php">Back to Login</a></p>
</body>
</html>