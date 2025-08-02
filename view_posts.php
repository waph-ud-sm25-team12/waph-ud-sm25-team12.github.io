<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: form.php");
    exit();
}

// Connect to DB
$mysqli = new mysqli('localhost', 'team12', 'team12', 'waph_team12');
if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

// Fetch posts with username
$sql = "SELECT posts.content, posts.created_at, users.username 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        ORDER BY posts.created_at DESC";
$result = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <title>All Posts</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .post {
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 8px;
      box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
    }
    .post strong {
      color: #0073e6;
    }
    a {
      color: #0073e6;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h2>All Posts</h2>

  <!-- Links to create and go back -->
  <a href="create_post.php">+ New Post</a><br>
  <a href="profile.php">Back to Profile</a><br><br>

  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()) : ?>
      <div class="post">
        <p><strong><?php echo htmlentities($row['username']); ?></strong> wrote:</p>
        <p><?php echo nl2br(htmlentities($row['content'])); ?></p>
        <small>Posted on <?php echo $row['created_at']; ?></small>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No posts found. <a href="create_post.php">Be the first to post!</a></p>
  <?php endif; ?>
</body>
</html>