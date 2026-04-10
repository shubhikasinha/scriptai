<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit;
}
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
  <h1>Welcome Admin <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
  <div class="card">
    <p>You can manage users, posts, and view system metrics here.</p>
  </div>
</div>

</body>
</html>
