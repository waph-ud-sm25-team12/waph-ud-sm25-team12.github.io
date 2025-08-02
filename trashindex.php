<?php
$lifetime = 15 * 60;
$path = "/";
$domain = "chengr01.waph.io";
$secure = TRUE;
$httponly = TRUE;
session_set_cookie_params($lifetime,$path,$domain,$secure,$httponly);
session_start();

if (!isset($_SESSION['authenticated']) or $_SESSION['authenticated'] != TRUE) {
    session_destroy();
    echo "<script>alert('You have not login. Please login first');</script>";
    header("Refresh: 0; url=form.php");
    die();
}
if ($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]) {
    session_destroy();
    echo "<script>alert('Session hijacking attack is detected!');</script>";
    header("Refresh: 0; url=form.php");
    die();
}

if (checklogin_mysql($_POST['username'], $_POST['password'])) {
    $_SESSION['authenticated'] = TRUE;
    $_SESSION['username'] = $_POST["username"];
    $_SESSION["browser"] = $_SERVER["HTTP_USER_AGENT"];
    ?>
    <h2>Welcome <?php echo htmlentities($_SESSION["username"]); ?> !</h2>
    <a href="logout.php">Logout</a>
    <?php
} else {
    echo "<script>alert('Invalid username or password'); window.location='form.php';</script>";
    die();
}
function checklogin_mysql($username, $password) {
    // Connect to your team database
    $mysqli = new mysqli('localhost', 'team12', 'team12', 'waph_team12');
    if ($mysqli->connect_error) {
        printf("Database connection failed: %s\n", $mysqli->connect_error);
        exit();
    }
    // Prepare SQL statement
    $prepared_sql = "SELECT * FROM users WHERE username = ? AND password = md5(?)";
    $stmt = $mysqli->prepare($prepared_sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    
    $result = $stmt->get_result();
    // If user is found, return true
    if ($result->num_rows === 1) return TRUE;
    return FALSE;
}
?>
