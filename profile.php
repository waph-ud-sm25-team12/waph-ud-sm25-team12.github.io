<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: form.php");
    exit();
}

$mysqli = new mysqli('localhost', 'team12', 'team12', 'waph_team12');
if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

$name = $email = $phone = '';

if ($role === 'admin') {
    $stmt = $mysqli->prepare("SELECT name, email, phone FROM superusers WHERE username = ?");
} else {
    $stmt = $mysqli->prepare("SELECT name, email, phone FROM users WHERE username = ?");
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Welcome <?php echo htmlentities($username); ?>!</h2>

    <p><strong>Name:</strong> <?php echo htmlentities($name); ?></p>
    <p><strong>Email:</strong> <?php echo htmlentities($email); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlentities($phone); ?></p>

    <a href="editprofile.php">Edit Profile</a> |
    <a href="changepasswordform.php">Change Password</a> |
    <a href="view_posts.php">View All Posts</a> |
    <?php if ($role === 'admin'): ?>
        <a href="superuser_dashboard.php">Superuser Dashboard</a> |
    <?php endif; ?>
    <a href="logout.php">Logout</a>
</body>
</html>