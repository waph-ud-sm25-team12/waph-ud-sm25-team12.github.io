<?php
session_start();

if (checklogin_mysql($_POST['username'], $_POST['password'])) {
    ?>
    <h2>Welcome <?php echo htmlspecialchars($_POST['username']); ?> </h2>
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