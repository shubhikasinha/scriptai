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
  <link rel="stylesheet" href="style.css?v=1">
  <style>
    .blog-section {
      padding: 60px 40px;
      background: #f9f9f9;
    }
    .blog-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      justify-content: center;
    }
    .blog-card {
      background: white;
      border-radius: 15px;
      padding: 20px;
      flex: 1 1 calc(33.333% - 30px);
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
      max-width: calc(33.333% - 30px);
    }
    .blog-card h3 {
      margin-bottom: 10px;
      color: #1e3c72;
    }
    .btn-read {
      display: inline-block;
      margin-top: 10px;
      background: #1e3c72;
      color: white;
      padding: 8px 14px;
      border-radius: 6px;
      text-decoration: none;
    }
    .pagination {
      margin-top: 40px;
      text-align: center;
    }
    .pagination a {
      margin: 0 6px;
      text-decoration: none;
      color: #1e3c72;
      font-weight: bold;
    }
    .pagination a.active {
      background: #1e3c72;
      color: white;
      padding: 4px 10px;
      border-radius: 5px;
    }

    @media (max-width: 768px) {
      .blog-card {
        flex: 1 1 100%;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

<?php include 'header.php'; ?>

<section class="blog-section">
  <div class="container">
    <h2>Latest Blog Posts</h2>
    <div class="blog-grid">
      <?php foreach ($posts as $post): ?>
        <div class="blog-card">
          <h3><?= htmlspecialchars($post['title']) ?></h3>
          <p><?= substr(strip_tags($post['content']), 0, 150) ?>...</p>
          <a href="post.php?id=<?= $post['id'] ?>" class="btn-read">Read More</a>
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
