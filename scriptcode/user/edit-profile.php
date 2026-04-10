<?php
require '../common/db.php';

if (!isset($_SESSION['user_logged_in']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$success = '';
$error = '';

// Fetch current data
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $new_password = $_POST['password'];

    if (!$username || !$email) {
        $error = "Username and Email are required.";
    } else {
        try {
            if (!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                $update = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
                $update->execute([$username, $email, $hashed_password, $user_id]);
            } else {
                $update = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
                $update->execute([$username, $email, $user_id]);
            }

            $_SESSION['username'] = $username;
            $success = "Profile updated successfully.";
        } catch (PDOException $e) {
            $error = "Error updating profile: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Profile</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #eef3f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .edit-form {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      width: 400px;
    }

    h2 {
      text-align: center;
      color: #1a3f5d;
      margin-bottom: 20px;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }

    button {
      width: 100%;
      padding: 12px;
      background: #1a3f5d;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    .message {
      text-align: center;
      margin-top: 10px;
      font-weight: bold;
    }

    .success { color: green; }
    .error { color: red; }
  </style>
</head>
<body>

<div class="edit-form">
  <h2>✏️ Edit Profile</h2>
  <form method="POST">
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" placeholder="Username" required />
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="Email" required />
    <input type="password" name="password" placeholder="New Password (optional)" />
    <button type="submit">Update Profile</button>
  </form>

  <?php if ($success): ?>
    <div class="message success"><?= $success ?></div>
  <?php elseif ($error): ?>
    <div class="message error"><?= $error ?></div>
  <?php endif; ?>
</div>

</body>
</html>
