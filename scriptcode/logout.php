<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logged Out</title>
  <meta http-equiv="refresh" content="3;url=login.php">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f6f9fc;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .box {
      text-align: center;
      background: #fff;
      padding: 40px 60px;
      border-radius: 10px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    .box h1 {
      color: #28a745;
      margin-bottom: 10px;
    }
    .box p {
      font-size: 1.1em;
      margin: 0;
    }
  </style>
</head>
<body>
  <div class="box">
    <h1>👋 See you again!</h1>
    <p>You have been logged out successfully.</p>
    <p>Redirecting to login page...</p>
  </div>
</body>
</html>
