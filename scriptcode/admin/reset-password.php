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
$newPassword = bin2hex(random_bytes(4)); // e.g., "d3f84a9c"
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// Update password in DB
$stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
$stmt->execute([$hashedPassword, $id]);

// Optional: fetch email to show/send
$user = $pdo->prepare("SELECT email FROM users WHERE id = ?");
$user->execute([$id]);
$email = $user->fetchColumn();

echo "<h2>Password reset successful</h2>";
echo "<p>New password: <strong>$newPassword</strong></p>";
echo "<p>Email (for notification): $email</p>";
echo '<a href="manage-users.php">Back to Manage Users</a>';
?>
