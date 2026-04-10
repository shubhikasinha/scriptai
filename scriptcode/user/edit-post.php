<?php
require '../common/db.php';

if (!isset($_SESSION['user_logged_in']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

$post_id = $_GET['id'] ?? null;
$user_id = $_SESSION['user_id'];

if (!$post_id) {
    die("Post ID is missing.");
}

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$post_id, $user_id]);
$post = $stmt->fetch();

if (!$post) {
    die("Post not found or you don't have permission.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title && $content) {
        $update = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?");
        $update->execute([$title, $content, $post_id, $user_id]);
        header("Location: my-posts.php?updated=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
</head>
<body>
    <h2>Edit Your Post</h2>
    <form method="POST">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br><br>
        <label>Content:</label><br>
        <textarea name="content" rows="6" required><?= htmlspecialchars($post['content']) ?></textarea><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
