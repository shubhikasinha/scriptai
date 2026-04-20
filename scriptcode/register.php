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
  <title>Register - ScriptAI Digital</title>
  <link rel="stylesheet" href="style.css?v=4">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body style="background: var(--bg-white);">
  <?php include 'header.php'; ?>
  
  <section class="ds-content-section fade-up" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="ds-container" style="width: 100%;">
      <div class="ds-form-container">
        <h2 style="text-align: center; margin-bottom: 30px; font-size: 32px;">Create Account</h2>
        <form method="POST">
          <label>Username</label>
          <input type="text" name="username" placeholder="Username" required />
          
          <label>Email Address</label>
          <input type="email" name="email" placeholder="Email Address" required />
          
          <label>Password</label>
          <input type="password" id="password" name="password" placeholder="Password" required />
          
          <!-- Strength Meter -->
          <div id="strengthMeter" style="height: 6px; width: 100%; background: var(--border-light); border-radius: 6px; margin-top: -12px; margin-bottom: 20px; overflow: hidden;">
            <div id="strengthBar" style="height: 100%; width: 0%; transition: 0.3s;"></div>
          </div>
          
          <label>Role</label>
          <select name="role" required style="width: 100%; padding: 15px; border: 1px solid var(--border-light); border-radius: 8px; margin-bottom: 20px; font-family: inherit; font-size: 15px; background: #fdfdfd; outline: none;">
            <option value="">Select Role</option>
            <option value="user">User</option>
            <option value="editor">Editor</option>
            <option value="viewer">Viewer</option>
          </select>
          
          <button type="submit" class="ds-btn primary" style="width: 100%; justify-content: center; border: none; cursor: pointer; font-family: var(--font-heading); margin-top: 10px;">
            Register
          </button>
        </form>

        <?php 
          if (isset($error)) echo "<div style='color: red; text-align: center; margin-top: 15px; font-weight: 500;'>$error</div>";
          if (isset($confirmation)) echo "<div style='color: green; text-align: center; margin-top: 15px; font-weight: 500;'>$confirmation</div>"; 
        ?>
        
        <div style="text-align: center; margin-top: 25px; color: var(--text-muted);">
          Already have an account? <a href="login.php" style="color: var(--text-purple); font-weight: 600;">Sign in</a>
        </div>
      </div>
    </div>
  </section>

  <?php include 'footer.php'; ?>

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
