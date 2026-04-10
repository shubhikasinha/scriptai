<?php
$current = basename($_SERVER['PHP_SELF']);
?>

<style>
  .sidebar {
    width: 220px;
    height: 100vh;
    background-color: #1e3c72;
    color: white;
    padding: 20px;
    position: fixed;
  }
  .sidebar h2 {
    color: #fff;
    margin-bottom: 30px;
    font-size: 20px;
    text-align: center;
  }
  .sidebar a {
    display: block;
    padding: 12px;
    margin-bottom: 8px;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 500;
  }
  .sidebar a.active, .sidebar a:hover {
    background-color: #2a5298;
  }
</style>

<div class="sidebar">
  <h2>🔧 Admin Panel</h2>
  <a href="dashboard.php" class="<?= ($current == 'dashboard.php') ? 'active' : '' ?>">📊 Dashboard</a>
  <a href="team.php" class="<?= ($current == 'team.php') ? 'active' : '' ?>">👥 Team Members</a> <!-- NEW -->
  <a href="add-post.php" class="<?= ($current == 'add-post.php') ? 'active' : '' ?>">➕ Add Post</a>
  <a href="manage-post.php" class="<?= ($current == 'manage-post.php') ? 'active' : '' ?>">🗃 Manage Posts</a>
  <a href="manage-users.php" class="<?= ($current == 'manage-users.php') ? 'active' : '' ?>">👥 Manage Users</a>
  <a href="my-profile.php" class="<?= ($current == 'my-profile.php') ? 'active' : '' ?>">🙍 My Profile</a>
  <a href="../logout.php">🚪 Logout</a>
</div>
