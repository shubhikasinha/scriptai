<?php
require '../common/auth.php';
checkRole('viewer');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Viewer Access</title>
  <link rel="stylesheet" href="../common/style.css">
</head>
<body>
  <div class="dashboard-container">
    <h1>Hello Viewer, <?= $_SESSION['username'] ?>!</h1>
    <p>You can browse public posts.</p>
    <a href="../logout.php">Logout</a>
  </div>
</body>
</html>
