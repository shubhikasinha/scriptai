<?php
require 'common/db.php';
require 'common/auth.php';
 
$limit = 6; // Posts per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total posts count
$totalStmt = $pdo->query("SELECT COUNT(*) FROM posts WHERE status = 'Published'");
$totalPosts = $totalStmt->fetchColumn();
$totalPages = ceil($totalPosts / $limit);

// Fetch paginated posts
$stmt = $pdo->prepare("SELECT * FROM posts WHERE status = 'Published' ORDER BY created_at DESC LIMIT ? OFFSET ?");
$stmt->bindValue(1, $limit, PDO::PARAM_INT);
$stmt->bindValue(2, $offset, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Blog - ScriptAI Digital Services</title>
  <link rel="stylesheet" href="style.css?v=3">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    .pagination {
      margin-top: 60px;
      text-align: center;
    }
    .pagination a {
      margin: 0 6px;
      text-decoration: none;
      color: var(--text-navy);
      font-weight: bold;
      padding: 8px 16px;
      border-radius: 8px;
      border: 1px solid var(--border-light);
      transition: 0.3s;
    }
    .pagination a:hover {
      background: var(--border-light);
    }
    .pagination a.active {
      background: var(--btn-purple);
      color: white;
      border-color: var(--btn-purple);
    }
  </style>
</head>
<body style="background: var(--bg-white);">

<?php include 'header.php'; ?>

<section class="ds-mini-hero fade-up">
  <h1>Inside ScriptAI</h1>
  <p>Learn about our latest software architectures, digital marketing insights, and company news.</p>
</section>

<section class="ds-content-section fade-up delay-1">
  <div class="ds-container">
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px;">
      <?php foreach ($posts as $post): ?>
        <div style="border: 1px solid var(--border-light); border-radius: 12px; overflow: hidden; padding: 30px; display: flex; flex-direction: column;">
          <h3 style="margin-top: 0; font-size: 22px; margin-bottom: 15px; color: var(--text-navy);"><?= htmlspecialchars($post['title']) ?></h3>
          <p style="flex-grow: 1; font-size: 15px; color: var(--text-muted); line-height: 1.6; margin-bottom: 25px;"><?= substr(strip_tags($post['content']), 0, 150) ?>...</p>
          <a href="post.php?id=<?= $post['id'] ?>" class="ds-btn primary" style="align-self: flex-start; padding: 10px 20px; font-size: 14px;">Read More</a>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div class="pagination">
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>" class="<?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
      <?php endfor; ?>
    </div>

  </div>
</section>

<?php include 'footer.php'; ?>
<script src="script.js"></script>
</body>
</html>
