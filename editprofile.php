<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: form.php");
    exit();
}

$mysqli = new mysqli('localhost', 'team12', 'team12', 'waph_team12');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];
$name = $email = $phone = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if ($role === 'admin') {
        $stmt = $mysqli->prepare("UPDATE superusers SET name=?, email=?, phone=? WHERE username=?");
    } else {
        $stmt = $mysqli->prepare("UPDATE users SET name=?, email=?, phone=? WHERE username=?");
    }
    $stmt->bind_param("ssss", $name, $email, $phone, $username);
    $stmt->execute();

    echo "<script>alert('Profile updated successfully'); window.location='profile.php';</script>";
    exit();
} else {
    if ($role === 'admin') {
        $stmt = $mysqli->prepare("SELECT name, email, phone FROM superusers WHERE username=?");
    } else {
        $stmt = $mysqli->prepare("SELECT name, email, phone FROM users WHERE username=?");
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $name = $user['name'];
    $email = $user['email'];
    $phone = $user['phone'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Profile - <?php echo htmlentities($username); ?></h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlentities($name); ?>"><br><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlentities($email); ?>"><br><br>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlentities($phone); ?>"><br><br>

        <input type="submit" value="Update Profile">
    </form>
    <br>
    <a href="profile.php">Back to Profile</a>
</body>
</html>