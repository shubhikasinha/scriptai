<?php
require 'common/db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        switch ($user['role']) {
            case 'admin': header('Location: admin/dashboard.php'); exit;
            case 'editor': header('Location: editor/dashboard.php'); exit;
            case 'user': header('Location: user/dashboard.php'); exit;
            case 'viewer': header('Location: viewer/index.php'); exit;
            default: $error = "Unknown user role."; break;
        }
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login - ScriptAI Digital</title>
  <link rel="stylesheet" href="style.css?v=3">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body style="background: var(--bg-white);">
  <?php include 'header.php'; ?>
  
  <section class="ds-content-section fade-up" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="ds-container" style="width: 100%;">
      <div class="ds-form-container">
        <h2 style="text-align: center; margin-bottom: 30px; font-size: 32px;">Welcome Back</h2>
        <form method="POST">
          <label>Username</label>
          <input type="text" name="username" placeholder="Username" required />
          <label>Password</label>
          <input type="password" name="password" placeholder="Password" required />
          
          <button type="submit" class="ds-btn primary" style="width: 100%; justify-content: center; border: none; cursor: pointer; font-family: var(--font-heading); margin-top: 10px;">
            Login
          </button>
        </form>
        <?php if (isset($error)) echo "<div style='color: red; text-align: center; margin-top: 15px; font-weight: 500;'>$error</div>"; ?>
        
        <div style="text-align: center; margin-top: 25px; color: var(--text-muted);">
          Don't have an account? <a href="register.php" style="color: var(--text-purple); font-weight: 600;">Sign up</a>
        </div>
      </div>
    </div>
  </section>

  <?php include 'footer.php'; ?>
</body>
</html>
