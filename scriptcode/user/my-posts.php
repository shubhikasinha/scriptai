<?php
require '../common/db.php';
 
if (!isset($_SESSION['user_logged_in']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

function showFlash($param, $message, $color = 'green') {
    if (isset($_GET[$param])) {
        echo "<div style='background:$color;color:white;padding:10px;margin:10px 0;border-radius:6px;'>$message</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Posts</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #1e3c72;
            color: white;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }

        .edit-btn { background-color: #3498db; }
        .delete-btn { background-color: #e74c3c; }
    </style>
</head>
<body>
    <h2>My Posts</h2>

    <?php
    showFlash('updated', 'Post updated successfully!');
    showFlash('deleted', 'Post deleted successfully!', '#c0392b');
    ?>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Created At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= htmlspecialchars($post['title']) ?></td>
                    <td><?= date('Y-m-d', strtotime($post['created_at'])) ?></td>
                    <td><?= $post['status'] ?></td>
                    <td>
                        <a class="btn edit-btn" href="edit-post.php?id=<?= $post['id'] ?>">Edit</a>
                        <a class="btn delete-btn" href="delete-post.php?id=<?= $post['id'] ?>" onclick="return confirm('Are you sure to delete this post?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
