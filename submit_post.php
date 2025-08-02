<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: form.php");
    exit();
}
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['post_csrf']) {
    die("CSRF token validation failed.");
}

$content = trim($_POST['content']);
if (empty($content)) {
    echo "<script>alert('Post cannot be empty'); window.location='create_post.php';</script>";
    exit();
}

$mysqli = new mysqli('localhost', 'team12', 'team12', 'waph_team12');
if ($mysqli->connect_error) {
    die("DB connection error: " . $mysqli->connect_error);
}

$username = $_SESSION['username'];
$stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_id = $user['id'];

$stmt = $mysqli->prepare("INSERT INTO posts (user_id, content) VALUES (?, ?)");
$stmt->bind_param("is", $user_id, $content);
if ($stmt->execute()) {
    echo "<script>alert('Post created successfully!'); window.location='view_posts.php';</script>";
} else {
    echo "<script>alert('Error creating post'); window.location='create_post.php';</script>";
}
?>