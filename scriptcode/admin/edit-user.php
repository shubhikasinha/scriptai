<?php
require '../common/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid User ID.");
}

$id = (int) $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    $updateStmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
    $updateStmt->execute([$username, $email, $role, $id]);

    $_SESSION['flash'] = "User updated successfully!";
    header("Location: manage-users.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f7f9fc; padding: 40px; }
    .form-box {
      background: white;
      max-width: 500px;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    h2 { text-align: center; color: #1e3c72; margin-bottom: 20px; }
    input, select {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    button {
      background: #1e3c72;
      color: white;
      border: none;
      padding: 12px;
      width: 100%;
      border-radius: 8px;
      font-size: 16px;
    }
    button:hover { background: #2a5298; cursor: pointer; }
  </style>
</head>
<body>

<div class="form-box">
  <h2>Edit User</h2>
  <form method="POST">
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    <select name="role" required>
      <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
      <option value="editor" <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
      <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
      <option value="viewer" <?= $user['role'] === 'viewer' ? 'selected' : '' ?>>Viewer</option>
    </select>
    <button type="submit">Update User</button>
  </form>
</div>

</body>
</html>
