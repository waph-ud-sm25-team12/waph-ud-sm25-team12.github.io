<?php
session_start();
if (!isset($_SESSION["authenticated"])) {
    header("Location: form.php");
    exit();
}

// Generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        Old Password: <input type="password" name="old_password" required><br>
        New Password: <input type="password" name="new_password" required><br>
        Confirm Password: <input type="password" name="confirm_password" required><br>
        <button type="submit">Update Password</button>
        <a href="profile.php">Back to Profile</a>
    </form>
</body>
</html>
