<?php
require '../common/db.php';
 
if (!isset($_SESSION['user_logged_in']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

$post_id = $_GET['id'] ?? null;
$user_id = $_SESSION['user_id'];

if ($post_id) {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
    $stmt->execute([$post_id, $user_id]);
}

header("Location: my-posts.php?deleted=1");
exit;
