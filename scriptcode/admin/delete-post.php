<?php
require_once '../common/db.php';
require '../common/auth.php';

checkRole('admin');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: manage-posts.php");
exit;
?>
