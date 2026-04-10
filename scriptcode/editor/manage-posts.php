<?php
require '../common/db.php';
require '../common/auth.php';

if ($_SESSION['role'] !== 'editor') {
    header('Location: ../login.php');
    exit;
}

// Fetch posts created by the current editor
$stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Flash message (if redirected from delete)
$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Posts</title>
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
    .main { padding: 40px; }
    .msg { color: green; margin-bottom: 20px; font-weight: bold; text-align: center; }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 8px 20px rgba(0,0,0,0.05);
      border-radius: 10px;
      overflow: hidden;
    }
    th, td {
      padding: 14px 20px;
      border-bottom: 1px solid #eee;
    }
    th {
      background: #f0f4fa;
      color: #1e3c72;
    }
    td:last-child {
      text-align: center;
    }
    a.action {
      text-decoration: none;
      padding: 6px 12px;
      margin: 0 5px;
      border-radius: 6px;
      color: white;
      font-size: 0.9rem;
    }
    .edit-btn { background: #1e88e5; }
    .delete-btn { background: #e53935; }
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
<div class="main">
  <h2>Manage My Posts</h2>

  <?php if ($msg): ?>
    <div class="msg"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>

  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Status</th>
        <th>Date Created</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post): ?>
        <tr>
          <td><?= htmlspecialchars($post['title']) ?></td>
          <td><?= $post['status'] ?></td>
          <td><?= date('M d, Y', strtotime($post['created_at'])) ?></td>
          <td>
            <a class="action edit-btn" href="edit-post.php?id=<?= $post['id'] ?>">Edit</a>
            <a class="action delete-btn" href="delete-post.php?id=<?= $post['id'] ?>" onclick="return confirm('Delete this post?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

</body>
</html>
