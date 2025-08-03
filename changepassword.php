<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: form.php");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password     = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // ❌ Passwords don't match
    if ($new_password !== $confirm_password) {
        echo "<script>
                alert('New passwords do not match!');
                window.location.href = 'changepasswordform.php';
              </script>";
        exit();
    }

    // Select correct table
    $table = ($role === 'admin') ? 'superusers' : 'users';

    // ✅ Check current password
    $stmt = $mysqli->prepare("SELECT password FROM $table WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    if (md5($current_password) !== $hashed_password) {
        echo "<script>
                alert('Current password is incorrect!');
                window.location.href = 'changepasswordform.php';
              </script>";
        exit();
    }

    // ✅ Update password
    $stmt = $mysqli->prepare("UPDATE $table SET password = md5(?) WHERE username = ?");
    $stmt->bind_param("ss", $new_password, $username);

    if ($stmt->execute()) {
        echo "<script>
                alert('Password updated successfully!');
                window.location.href = 'profile.php';
              </script>";
    } else {
        echo "<script>
                alert('Error updating password!');
                window.location.href = 'changepasswordform.php';
              </script>";
    }

    $stmt->close();
}
?>