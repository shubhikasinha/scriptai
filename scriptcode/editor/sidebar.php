<ul class="sidebar-links">
  <li><a href="dashboard.php">Dashboard</a></li>
  
  <?php if (canEditPosts()): ?>
    <li><a href="add-post.php">Add Post</a></li>
    <li><a href="my-posts.php">My Posts</a></li>
  <?php endif; ?>

  <?php if (canManageUsers()): ?>
    <li><a href="manage-users.php">Manage Users</a></li>
  <?php endif; ?>

  <li><a href="profile.php">My Profile</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
