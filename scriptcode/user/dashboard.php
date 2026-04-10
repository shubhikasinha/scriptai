<?php
require '../common/db.php';
require '../common/auth.php';
require '../common/permissions.php';
checkRole('user');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Editor Dashboard</title>
  <link rel="stylesheet" href="style-editor.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f0f2f5;
    }
    .editor-container {
      display: flex;
    }
    .sidebar {
      width: 220px;
      background: #1e3c72;
      color: white;
      height: 100vh;
      padding: 20px 0;
    }
    .sidebar h3 {
      text-align: center;
      margin-bottom: 30px;
    }
    .sidebar a {
      display: block;
      color: white;
      text-decoration: none;
      padding: 12px 20px;
      transition: background 0.2s;
    }
    .sidebar a:hover, .sidebar a.active {
      background: #274a96;
    }
    .main {
      flex: 1;
      padding: 40px;
    }
    .main h1 {
      color: #1e3c72;
    }
    footer {
      margin-top: 40px;
      padding: 10px;
      text-align: center;
      background: #fff;
      border-top: 1px solid #ddd;
    }
  </style>
</head>
<body>

<div class="editor-container">
  <aside class="sidebar">
    <h3>User Panel</h3>
    <a href="dashboard.php" class="active">Dashboard</a>
    <a href="profile.php">My Profile</a>
        <a href="my-posts.php">My Posts</a>
		<a href="create-post.php">Create A New Post</a>
		<a href="edit-post.php">Edit Post</a>
        <a href="edit-profile.php">Edit Profile</a>
        <a href="change-password.php">Change Password</a>
    <a href="../logout.php">Logout</a>
  </aside>
 
   <main class="main">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <p>You're logged in as an <strong>User</strong>. Use the sidebar to manage your content.</p>

    <footer>&copy; <?= date('Y') ?> BrightEdge Platform - User Panel</footer>
  </main>
</div>

</body>
</html>
