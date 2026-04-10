<?php
require '../common/db.php';
 $user_id = $_SESSION['user_id'];
$user = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$user->execute([$user_id]);
$data = $user->fetch();
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
<h2>My Profile</h2>
<p><strong>Username:</strong> <?= htmlspecialchars($data['username']) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($data['email']) ?></p>
<p><strong>Role:</strong> <?= htmlspecialchars($data['role']) ?></p>
<a href="edit-profile.php">Edit Profile</a>
</div>

</body>
</html>
