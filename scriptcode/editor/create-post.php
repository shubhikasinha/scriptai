<?php
require '../common/db.php';
require '../common/auth.php';

if ($_SESSION['role'] !== 'editor') {
    header('Location: ../login.php');
    exit;
}

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $status = $_POST['status'];

    if ($title && $content) {
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, status, user_id, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$title, $content, $status, $_SESSION['user_id']]);
        $msg = "✅ Post created successfully!";
    } else {
        $msg = "❌ Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Create Post</title>
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
      padding: 40px;
    }
    .form-box {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      max-width: 700px;
      margin: auto;
    }
    .form-box h2 {
      margin-bottom: 20px;
      color: #1e3c72;
    }
    input, textarea, select {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }
    button {
      padding: 12px 24px;
      background: #1e3c72;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
    button:hover {
      background: #274a96;
    }
    .msg {
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="editor-container">
  <aside class="sidebar">
    <h3>Editor Panel</h3>
    <a href="dashboard.php" class="active">Dashboard</a>
    <a href="create-post.php">Create Post</a>
    <a href="manage-posts.php">Manage Posts</a>
    <a href="edit-profile.php">Edit Profile</a>
    <a href="../logout.php">Logout</a>
  </aside>

  <main class="main">
    <div class="form-box">
    <h2>Create New Post</h2>
    <?php if ($msg): ?>
      <div class="msg"><?= $msg ?></div>
    <?php endif; ?>
    <form method="post">
      <input type="text" name="title" placeholder="Enter Post Title" required>
      <textarea name="content" placeholder="Write your post..." rows="8" required></textarea>
      <select name="status">
        <option value="Draft">Draft</option>
        <option value="Published">Published</option>
      </select>
      <button type="submit">Publish Post</button>
    </form>
  </div>

    <footer>&copy; <?= date('Y') ?> BrightEdge Platform - Editor Panel</footer>
  </main>
</div>

 
</body>
</html>
