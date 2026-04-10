<?php
require '../common/db.php';
 
if (!isset($_SESSION['user_logged_in'])) {
    header('Location: ../login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Fetch current password hash
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($oldPassword, $user['password'])) {
        if ($newPassword === $confirmPassword) {
            $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $update->execute([$newHash, $userId]);
            $message = '<span style="color:green;">✅ Password changed successfully.</span>';
        } else {
            $message = '<span style="color:red;">❌ New passwords do not match.</span>';
        }
    } else {
        $message = '<span style="color:red;">❌ Old password is incorrect.</span>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        .message {
            text-align: center;
            margin-bottom: 15px;
        }
		.editor-container {
      display: flex;
    }
    .sidebar {
      width: 220px;
      background: #1e3c72;
      color: white;
      height: 100vh;
      padding: 20px 0;
    }
    .sidebar h3 {
      text-align: center;
      margin-bottom: 30px;
    }
    .sidebar a {
      display: block;
      color: white;
      text-decoration: none;
      padding: 12px 20px;
      transition: background 0.2s;
    }
    .sidebar a:hover, .sidebar a.active {
      background: #274a96;
    }
    .main {
      flex: 1;
      padding: 40px;
    }
    .main h1 {
      color: #1e3c72;
    }
    footer {
      margin-top: 40px;
      padding: 10px;
      text-align: center;
      background: #fff;
      border-top: 1px solid #ddd;
    }
    </style>
</head>
<body><div class="editor-container">
  <aside class="sidebar">
    <h3>User Panel</h3>
    <a href="dashboard.php" class="active">Dashboard</a>
    <a href="profile.php">My Profile</a>
        <a href="my-posts.php">My Posts</a>
		<a href="create-post.php">Create A New Post</a>
		<a href="edit-post.php">Edit Post</a>
        <a href="edit-profile.php">Edit Profile</a>
        <a href="change-password.php">Change Password</a>
    <a href="../logout.php">Logout</a>
  </aside>

    <form method="post">
        <h2>🔑 Change Password</h2>
        <div class="message"><?= $message ?></div>
        <input type="password" name="old_password" placeholder="Old Password" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
        <button type="submit">Update Password</button>
    </form>
</body>
</html>
