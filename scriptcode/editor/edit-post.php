<?php
require '../common/db.php';
require '../common/auth.php';

if ($_SESSION['role'] !== 'editor') {
    header('Location: ../login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: manage-posts.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
$post = $stmt->fetch();

if (!$post) {
    echo "Post not found or access denied.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $status = $_POST['status'];

    $update = $pdo->prepare("UPDATE posts SET title = ?, content = ?, status = ? WHERE id = ? AND user_id = ?");
    $update->execute([$title, $content, $status, $id, $_SESSION['user_id']]);

    header('Location: manage-posts.php?msg=Post updated!');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Post</title>
  <link rel="stylesheet" href="style-editor.css">
  <style>
    .main { padding: 40px; max-width: 700px; margin: auto; }
    form {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    input, textarea, select {
      width: 100%;
      padding: 12px;
      margin-bottom: 16px;
      font-size: 1rem;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    button {
      background: #1e3c72;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
    button:hover {
      background: #2a5298;
    }
  </style>
</head>
<body>


<div class="main">
  <h2>Edit Post</h2>
  <form method="POST">
    <input name="title" value="<?= htmlspecialchars($post['title']) ?>" required />
    <textarea name="content" rows="6" required><?= htmlspecialchars($post['content']) ?></textarea>
    <select name="status">
      <option value="Draft" <?= $post['status'] === 'Draft' ? 'selected' : '' ?>>Draft</option>
      <option value="Published" <?= $post['status'] === 'Published' ? 'selected' : '' ?>>Published</option>
    </select>
    <button type="submit">Update Post</button>
  </form>
</div>

</body>
</html>
