<?php
require '../common/db.php';
require '../common/auth.php';

if ($_SESSION['role'] !== 'editor') {
    header('Location: ../login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: manage-posts.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);

header('Location: manage-posts.php?msg=Post deleted!');
exit;
