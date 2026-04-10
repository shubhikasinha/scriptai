<?php
require '../common/db.php';
 
if (!isset($_SESSION['user_logged_in']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username, email, role, created_at FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Profile</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f3f7fb;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .profile-card {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      width: 400px;
    }

    h2 {
      margin-top: 0;
      text-align: center;
      color: #1a3f5d;
    }

    .profile-item {
      margin-bottom: 15px;
      font-size: 16px;
    }

    .profile-item strong {
      display: inline-block;
      width: 100px;
      color: #1a3f5d;
    }

    .btn {
      display: inline-block;
      text-align: center;
      padding: 10px 20px;
      background: #1a3f5d;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      margin-top: 20px;
      width: 100%;
    }

    .btn:hover {
      background: #285577;
    }
  </style>
</head>
<body>
  <div class="profile-card">
    <h2>👤 My Profile</h2>
    <div class="profile-item"><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></div>
    <div class="profile-item"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></div>
    <div class="profile-item"><strong>Role:</strong> <?= htmlspecialchars($user['role']) ?></div>
    <div class="profile-item"><strong>Joined:</strong> <?= date('F d, Y', strtotime($user['created_at'])) ?></div>

    <a href="edit-profile.php" class="btn">Edit Profile</a>
  </div>
</body>
</html>
