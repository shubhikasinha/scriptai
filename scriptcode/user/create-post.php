<?php
require '../common/db.php';
 
if (!isset($_SESSION['user_logged_in']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $status = $_POST['status'];

    if ($title && $content && in_array($status, ['Draft', 'Published'])) {
        $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content, status, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$_SESSION['user_id'], $title, $content, $status]);
        header("Location: my-posts.php?created=1");
        exit;
    } else {
        $error = "Please fill in all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f8fc;
            padding: 40px;
        }

        .post-form {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.07);
        }

        .post-form h2 {
            color: #1e3c72;
            margin-bottom: 20px;
        }

        .post-form input, .post-form textarea, .post-form select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        .post-form button {
            background: #1e3c72;
            color: white;
            border: none;
            padding: 14px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
        }

        .post-form button:hover {
            background: #274a96;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="post-form">
    <h2>Create New Post</h2>

    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="post">
        <input type="text" name="title" placeholder="Post Title" required>
        <textarea name="content" rows="6" placeholder="Write your content here..." required></textarea>
        <select name="status" required>
            <option value="">Select Status</option>
            <option value="Draft">Draft</option>
            <option value="Published">Published</option>
        </select>
        <button type="submit">Submit Post</button>
    </form>
</div>

</body>
</html>
