<?php
require '../common/db.php';
 
if (!isset($_SESSION['user_logged_in']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

    if ($title && $content) {
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, user_id, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$title, $content, $user_id]);
        $message = "✅ Post added successfully!";
    } else {
        $message = "⚠️ Title and content are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Post</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f2f6fc;
      padding: 40px;
    }

    .form-box {
      background: white;
      max-width: 600px;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #1a5276;
    }

    label {
      display: block;
      margin: 12px 0 6px;
    }

    input[type="text"], textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    button {
      background: #2980b9;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 15px;
    }

    .message {
      margin-top: 15px;
      text-align: center;
      font-weight: bold;
      color: green;
    }
  </style>
</head>
<body>

<div class="form-box">
  <h2>Add New Post 📝</h2>
  <form method="POST">
    <label for="title">Title</label>
    <input type="text" name="title" required>

    <label for="content">Content</label>
    <textarea name="content" rows="6" required></textarea>

    <button type="submit">➕ Add Post</button>
  </form>

  <?php if ($message): ?>
    <p class="message"><?= $message ?></p>
  <?php endif; ?>
</div>

</body>
</html>
