<?php
require '../common/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$stmt = $pdo->query("SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f7fa;
    }

    .main-content {
      margin-left: 240px;
      padding: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 12px 16px;
      border-bottom: 1px solid #eee;
      text-align: left;
    }

    th {
      background-color: #1e3c72;
      color: white;
    }

    .actions a {
      margin-right: 10px;
      text-decoration: none;
      padding: 6px 10px;
      border-radius: 5px;
      font-size: 14px;
    }

    .edit { background: #4caf50; color: white; }
    .delete { background: #f44336; color: white; }
    .reset { background: #2196f3; color: white; }
  </style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main-content">
  <h1>👥 Manage Users</h1>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Joined</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $i => $user): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= htmlspecialchars($user['username']) ?></td>
          <td><?= htmlspecialchars($user['email']) ?></td>
          <td><?= ucfirst($user['role']) ?></td>
          <td><?= date("d M Y", strtotime($user['created_at'])) ?></td>
          <td class="actions">
            <a class="edit" href="edit-user.php?id=<?= $user['id'] ?>">Edit</a>
            <a class="delete" href="delete-user.php?id=<?= $user['id'] ?>" onclick="return confirm('Delete this user?')">Delete</a>
            <a class="reset" href="reset-password.php?id=<?= $user['id'] ?>">Reset</a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

</body>
</html>
