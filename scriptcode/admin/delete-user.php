<?php
require '../common/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid user ID.");
}

$id = (int) $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $_SESSION['flash'] = "User deleted successfully.";
    header("Location: manage-users.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Delete User</title></head>
<body>
  <h2>Are you sure you want to delete this user?</h2>
  <form method="post">
    <button type="submit">Yes, Delete</button>
    <a href="manage-users.php">Cancel</a>
  </form>
</body>
</html>
