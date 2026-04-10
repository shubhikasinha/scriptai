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
  <title>Login - Multi Role System</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #1e3c72, #2a5298);
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      background: #fff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
      max-width: 400px;
      width: 100%;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #1e3c72;
    }

    .login-container input {
      width: 100%;
      padding: 14px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
    }

    .login-container button {
      width: 100%;
      padding: 12px;
      background: #1e3c72;
      color: #fff;
      border: none;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
    }

    .login-container button:hover {
      background: #2a5298;
    }

    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?> <br/><br/>
	If not registered <a href='register.php'>Please sign up</a>
  </div>
  
</body>
</html>
