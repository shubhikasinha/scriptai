<?php
require '../common/db.php';
require '../common/auth.php';
require '../common/permissions.php';
checkRole('viewer');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Viewer Dashboard</title>
  <link rel="stylesheet" href="../common/style.css" />
  <style>
    .dashboard-container {
      padding: 40px;
      max-width: 800px;
      margin: auto;
    }
    .welcome {
      font-size: 1.5rem;
      color: #1e3c72;
      margin-bottom: 20px;
    }
    .dashboard-links ul {
      list-style: none;
      padding: 0;
    }
    .dashboard-links li {
      margin-bottom: 12px;
    }
    .dashboard-links a {
      text-decoration: none;
      color: #1e3c72;
      font-weight: 600;
    }
    .dashboard-links a:hover {
      color: #2a5298;
    }
  </style>
</head>
<body>

  <?php include 'sidebar.php'; ?>

  <div class="dashboard-container">
    <div class="welcome">
      👁️ Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>!
    </div>
    <div class="dashboard-links">
      <ul>
        <li><a href="../blog.php">📚 Browse Blog</a></li>
        <li><a href="../contact.html">✉️ Contact Admin</a></li>
      </ul>
    </div>
  </div>

</body>
</html>
