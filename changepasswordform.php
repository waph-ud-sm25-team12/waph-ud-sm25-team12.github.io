<?php
session_start();
if (!isset($_SESSION["authenticated"])) {
    header("Location: form.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Change Your Password</h2>
    <form action="changepassword.php" method="POST">
        Old Password: <input type="password" name="old_password" required><br>
        New Password: <input type="password" name="new_password" required><br>
        Confirm Password: <input type="password" name="confirm_password" required><br>
        <button type="submit">Update Password</button>
    </form>
</body>
</html>