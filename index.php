<?php
$lifetime = 15 * 60;
session_set_cookie_params($lifetime);
session_start();
echo "🔐 Session CSRF: " . ($_SESSION['csrf_token'] ?? 'NOT SET') . "<br>";
echo "📩 POST CSRF: " . ($_POST['csrf_token'] ?? 'NOT SET') . "<br>";
session_regenerate_id(true); // For security

// CSRF check
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    session_destroy();
    echo "<script>alert('CSRF token validation failed.');</script>";
    header("Refresh: 0; url=form.php");
    exit();
}

// Prevent session hijacking
if (isset($_SESSION['browser']) && $_SESSION['browser'] !== $_SERVER["HTTP_USER_AGENT"]) {
    session_destroy();
    echo "<script>alert('Session hijacking attack detected!');</script>";
    header("Refresh: 0; url=form.php");
    exit();
}

// Validate login
if (checklogin_mysql($_POST['username'], $_POST['password'])) {
    $_SESSION['authenticated'] = true;
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['browser'] = $_SERVER["HTTP_USER_AGENT"];

    // Redirect to profile page
    header("Location: profile.php");
    exit();
} else {
    session_destroy();
    echo "<script>alert('Invalid username or password');</script>";
    header("Refresh: 0; url=form.php");
    exit();
}

// Login validation function

function checklogin_mysql($username, $password) {
    $mysqli = new mysqli('localhost', 'team12', 'team12', 'waph_team12');
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Check regular users
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ? AND password = md5(?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $_SESSION['role'] = 'user';
        return TRUE;
    }

    // Check superusers
    $stmt = $mysqli->prepare("SELECT * FROM superusers WHERE username = ? AND password = md5(?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $_SESSION['role'] = 'admin';
        return TRUE;
    }

    return FALSE;
}
?>