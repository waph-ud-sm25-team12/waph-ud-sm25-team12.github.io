<?php
session_start();

// Generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login Form - WAPH Team 12</title>
  <link rel="stylesheet" href="style.css">
  <script>
    function displayTime() {
      const options = {
        month: 'short',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
      };
      const formattedTime = new Date().toLocaleString('en-US', options).replace(/,/, '');
      document.getElementById('digit-clock').innerHTML = "Current time: " + formattedTime;
    }
    setInterval(displayTime, 500);
  </script>
</head>
<body>
  <h1>Login Form - WAPH Team 12</h1>
  <h2>Team 12</h2>
  <div id="digit-clock"></div>
  <p>Visited time: <?php echo date("M-d h:i:sa"); ?></p>

  <form action="index.php" method="POST" class="form login">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <!-- ✅ CSRF token -->
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <button type="submit">Login</button>
  </form>

  <p>New User? <a href="registration.php">Register here</a></p>
</body>
</html>