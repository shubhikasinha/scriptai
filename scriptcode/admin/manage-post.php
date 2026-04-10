<?php
require '../common/db.php';
 if ($_SESSION['role'] !== 'admin') {
  header('Location: ../login.php');
  exit;
}
$posts = $pdo->query("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f9;
    }
    .main-content {
      margin-left: 240px;
      padding: 30px;
    }
    h1 {
      color: #1e3c72;
    }
    .card {
      background: white;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
  </style>
</head>
<body>

<?php include 'sidebar.php'; ?>
<div class="main-content">
<h2>Manage All Posts</h2>
<table border="1">
  <tr><th>ID</th><th>Title</th><th>Author</th><th>Status</th><th>Actions</th></tr>
  <?php foreach ($posts as $post): ?>
    <tr>
      <td><?= $post['id'] ?></td>
      <td><?= htmlspecialchars($post['title']) ?></td>
      <td><?= $post['username'] ?></td>
      <td><?= $post['status'] ?></td>
      <td>
        <a href="edit-post.php?id=<?= $post['id'] ?>">Edit</a> |
        <a href="delete-post.php?id=<?= $post['id'] ?>" onclick="return confirm('Delete this post?')">Delete</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
</div>

</body>
</html>
