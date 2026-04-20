<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../common/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$message = '';

// DELETE
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM team_members WHERE id = ?");
    $stmt->execute([$id]);
    $message = 'Member deleted successfully.';
}

// LIST
$stmt = $pdo->query("
    SELECT id, name, role, photo, short_bio, sort_order, status 
    FROM team_members 
    ORDER BY sort_order ASC, id ASC
");
$members = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Team - Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Your Main CSS -->
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">">
</head>

<body class="admin-page">

<?php include 'sidebar.php'; ?>

<div class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="page-title">
            <i class="fas fa-users"></i> 
            Team Members (<?php echo count($members); ?>)
        </div>

        <a href="team-edit.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Member
        </a>
    </div>

    <div class="admin-card">

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (count($members) > 0): ?>
                        <?php foreach ($members as $m): ?>
                            <tr>
                                <td>
                                    <?php
                                    $photo = $m['photo'] ? '../' . htmlspecialchars($m['photo']) : '../img/default-avatar.png';
                                    ?>
                                    <img src="<?php echo $photo; ?>" alt="<?php echo htmlspecialchars($m['name']); ?>">
                                </td>

                                <td>
                                    <strong><?php echo htmlspecialchars($m['name']); ?></strong>
                                </td>

                                <td><?php echo htmlspecialchars($m['role']); ?></td>

                                <td><?php echo (int)$m['sort_order']; ?></td>

                                <td>
                                    <span class="badge <?php echo $m['status'] == 'Active' ? 'bg-success' : 'bg-secondary'; ?>">
                                        <?php echo htmlspecialchars($m['status']); ?>
                                    </span>
                                </td>

                                <td>
                                    <a href="team-edit.php?id=<?php echo $m['id']; ?>" 
                                       class="btn btn-sm btn-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="?delete=<?php echo $m['id']; ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Delete <?php echo addslashes($m['name']); ?>?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No team members found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
