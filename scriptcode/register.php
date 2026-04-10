<?php
require 'common/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!$username || !$email || !$password || !$role) {
        $error = "All fields are required.";
    } else {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetchColumn() > 0) {
            $error = "Username already exists.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $insert->execute([$username, $email, $hashedPassword, $role]);

            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            $confirmation = "Account created for <strong>$email</strong>. You may now log in.";

            header("refresh:3;url=login.php"); // Redirect with delay
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Registration</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #eef2f7;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .register-box {
      background: white;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
      max-width: 450px;
      width: 100%;
    }

    .register-box h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #1e3c72;
    }

    .register-box input, .register-box select {
      width: 100%;
      padding: 14px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
    }

    .register-box button {
      width: 100%;
      padding: 12px;
      background: #1e3c72;
      color: white;
      border: none;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
    }

    .register-box button:hover {
      background: #274a96;
    }

    .error, .confirmation {
      text-align: center;
      margin-top: 10px;
    }

    .error { color: red; }
    .confirmation { color: green; }

    #strengthMeter {
      height: 6px;
      width: 100%;
      background: #ddd;
      border-radius: 6px;
      margin-top: -12px;
      margin-bottom: 12px;
      overflow: hidden;
    }

    #strengthBar {
      height: 100%;
      width: 0%;
      transition: 0.3s;
    }
  </style>
</head>
<body>

<div class="register-box">
  <h2>Create Account</h2>
  <form method="POST">
    <input type="text" name="username" placeholder="Username" required />
    <input type="email" name="email" placeholder="Email Address" required />
    <input type="password" id="password" name="password" placeholder="Password" required />
    <div id="strengthMeter"><div id="strengthBar"></div></div>
    <select name="role" required>
      <option value="">Select Role</option>
      <option value="user">User</option>
      <option value="editor">Editor</option>
      <option value="viewer">Viewer</option>
    </select>
    <button type="submit">Register</button>
  </form>

  <?php 
    if (isset($error)) echo "<div class='error'>$error</div>";
    if (isset($confirmation)) echo "<div class='confirmation'>$confirmation</div>"; 
  ?>
</div>

<script>
const passwordInput = document.getElementById("password");
const strengthBar = document.getElementById("strengthBar");

passwordInput.addEventListener("input", () => {
  const val = passwordInput.value;
  let strength = 0;

  if (val.length > 6) strength += 1;
  if (/[A-Z]/.test(val)) strength += 1;
  if (/[0-9]/.test(val)) strength += 1;
  if (/[@$!%*?&#]/.test(val)) strength += 1;

  strengthBar.style.width = (strength * 25) + "%";
  strengthBar.style.background = ["#ccc", "#f66", "#fc3", "#6c6", "#4caf50"][strength];
});
</script>

</body>
</html>
