<?php
require_once 'common/db.php';

// Get post ID
$post_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch post + author
$stmt = $pdo->prepare("
    SELECT posts.*, users.username AS author
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    WHERE posts.id = ?
");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post) {
    echo "<div class='alert alert-danger'>Post not found.</div>";
    exit;
}

// Fetch comments
$comments = [];
$commentStmt = $pdo->prepare("
    SELECT comments.*, users.username 
    FROM comments 
    JOIN users ON comments.user_id = users.id 
    WHERE comments.post_id = ?
    ORDER BY comments.created_at DESC
");
$commentStmt->execute([$post_id]);
$comments = $commentStmt->fetchAll();
$commentCount = count($comments);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($post['title']) ?> | My Blog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f0f2f5;
    }
    .container {
      max-width: 800px;
    }
    .post-box {
      background: #fff;
      padding: 2rem;
      border-radius: 8px;
      margin-top: 2rem;
      box-shadow: 0 0 8px rgba(0,0,0,0.05);
    }
    .comment {
      padding: 1rem;
      background: #f8f9fa;
      border-radius: 5px;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="post-box">
    <h2><?= htmlspecialchars($post['title']) ?></h2>
    <p class="text-muted">
      Posted on <?= date('F j, Y', strtotime($post['created_at'])) ?> by 
      <strong><?= htmlspecialchars($post['author'] ?? 'Unknown') ?></strong>
    </p>
    <hr>
    <div><?= $post['content'] ?></div>

    <hr>
    <h5 class="mt-4">
      <i class="bi bi-chat-dots"></i> Comments (<?= $commentCount ?>)
    </h5>

    <?php if ($commentCount > 0): ?>
      <?php foreach ($comments as $comment): ?>
        <div class="comment">
          <strong><?= htmlspecialchars($comment['username']) ?></strong>
          <small class="text-muted">on <?= date('M j, Y', strtotime($comment['created_at'])) ?></small>
          <p class="mb-0"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No comments yet.</p>
    <?php endif; ?>

    <hr>
    <?php if (isset($_SESSION['user'])): ?>
      <form method="POST" action="add-comment.php">
        <input type="hidden" name="post_id" value="<?= $post_id ?>">
        <div class="mb-3">
          <textarea name="comment" class="form-control" rows="3" placeholder="Add your comment..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Post Comment</button>
      </form>
    <?php else: ?>
      <p class="text-muted">🔒 <a href="login.php">Login</a> to add a comment.</p>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
