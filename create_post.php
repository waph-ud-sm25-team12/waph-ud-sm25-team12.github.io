<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: form.php");
    exit();
}
if (!isset($_SESSION['post_csrf'])) {
    $_SESSION['post_csrf'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Create New Post</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Create a New Post</h2>
  <form action="submit_post.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['post_csrf']; ?>">
    <textarea name="content" rows="5" cols="50" placeholder="What's on your mind?" required></textarea><br>
    <button type="submit">Post</button>
  </form>
  <br>
  <a href="view_posts.php">Back to Posts</a>
</body>
</html>