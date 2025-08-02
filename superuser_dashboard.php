<?php
session_start();
require_once 'session_auth.php';

// Allow only superuser
if ($_SESSION['username'] !== 'admin') { // change 'admin' if needed
    echo "Access Denied.";
    exit();
}

$mysqli = new mysqli("localhost", "team12", "team12", "waph_team12");

// Delete user if requested
if (isset($_GET['delete_user'])) {
    $username = $_GET['delete_user'];
    $stmt = $mysqli->prepare("DELETE FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->close();
    header("Location: superuser_dashboard.php");
    exit();
}

// Show all users
$result = $mysqli->query("SELECT username FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Superuser Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Superuser Dashboard</h1>
<h3>Registered Users</h3>
<table border="1" cellpadding="5">
    <tr><th>Username</th><th>Action</th></tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><a href="?delete_user=<?= urlencode($row['username']) ?>" onclick="return confirm('Delete user?')">Delete</a></td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>