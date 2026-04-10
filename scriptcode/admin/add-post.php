<?php
require '../common/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $status = $_POST['status'];
  $stmt = $pdo->prepare("INSERT INTO posts (title, content, status, user_id) VALUES (?, ?, ?, ?)");
  $stmt->execute([$title, $content, $status, $_SESSION['user_id']]);
  $_SESSION['flash'] = "Post added!";
  header("Location: manage-post.php");
  exit;
}
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
 .form-box {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      max-width:500px;
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

<?php include 'sidebar.php'; ?>
<div class="main-content">
<h2>Add New Post</h2>
<form method="post">
  <input type="text" name="title" placeholder="Title" required><br>
  <textarea name="content" placeholder="Content" required></textarea><br>
  <select name="status">
    <option value="Draft">Draft</option>
    <option value="Published">Published</option>
  </select><br>
  <button type="submit">Publish</button>
</form>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>CKEDITOR.replace("content");</script>
</body>
</html>
