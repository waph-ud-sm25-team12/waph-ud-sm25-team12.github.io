<?php
session_start();
require_once "db.php";
require_once "functions.php";

if (!validateCSRFToken($_POST['csrf_token'])) {
    die("CSRF token mismatch.");
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);

if (empty($username) || empty($password) || empty($name) || empty($email)) {
    die("All fields are required.");
}

$hashed = md5($password); // for now, to match your DB entries

$stmt = $mysqli->prepare("INSERT INTO users (username, password, name, email, phone) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $username, $hashed, $name, $email, $phone);

if ($stmt->execute()) {
    echo "<script>alert('Registration successful! Please login.'); window.location='form.php';</script>";
} else {
    echo "<script>alert('Error: Username might already exist.'); window.location='registration.php';</script>";
}
?>