<?php
require_once '../common/db.php'; // Ensure this path is correct

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid post ID.");
}

$post_id = (int) $_GET['id'];

// Fetch post from database
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post) {
    die("Post not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title === '' || $content === '') {
        $error = "Both fields are required.";
    } else {
        $updateStmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
        $updateStmt->execute([$title, $content, $post_id]);

        header("Location: manage-post.php?updated=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            padding: 20px;
        }

        .container {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            background: #007bff;
            border: none;
            padding: 12px 20px;
            color: white;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .error {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
    <div class="container">
        <h2>Edit Post</h2>

        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" placeholder="Post Title" required>
            <textarea name="content" rows="8" placeholder="Post Content" required><?= htmlspecialchars($post['content']) ?></textarea>
            <button type="submit">Update Post</button>
        </form>
    </div>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>CKEDITOR.replace("content");</script>
</body>
</html>
