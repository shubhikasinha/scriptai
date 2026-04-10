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

// Get existing member for edit
$member = null;
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM team_members WHERE id = ?");
    $stmt->execute([$id]);
    $member = $stmt->fetch();
    if (!$member) {
        header('Location: team.php');
        exit;
    }
}

// SAVE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $role = trim($_POST['role']);
    $short_bio = trim($_POST['short_bio']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $linkedin_url = trim($_POST['linkedin_url']);
    $sort_order = (int)$_POST['sort_order'];
    $status = $_POST['status'];

    $photo_path = $member['photo'] ?? '';

    // Photo upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../img/team/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        
        $file_name = uniqid() . '_' . basename($_FILES['photo']['name']);
        $target = $upload_dir . $file_name;
        
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            $photo_path = 'img/team/' . $file_name;
        }
    }

    if ($id > 0) {
        // UPDATE
        $stmt = $pdo->prepare("
            UPDATE team_members SET name=?, role=?, photo=?, short_bio=?, 
            email=?, phone=?, linkedin_url=?, sort_order=?, status=? WHERE id=?
        ");
        $stmt->execute([$name, $role, $photo_path, $short_bio, $email, $phone, $linkedin_url, $sort_order, $status, $id]);
    } else {
        // INSERT
        $stmt = $pdo->prepare("
            INSERT INTO team_members (name, role, photo, short_bio, email, phone, linkedin_url, sort_order, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$name, $role, $photo_path, $short_bio, $email, $phone, $linkedin_url, $sort_order, $status]);
    }

    header('Location: team.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Team - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>"> <!-- YOUR CSS -->
</head>
<body class="admin-page">

<?php include 'sidebar.php'; ?>

<div class="main-content">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="page-title">
            <i class="fas fa-user-plus"></i>
            <?php echo $member ? 'Edit' : 'Add'; ?> Team Member
        </div>

        <a href="team.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="admin-card">

        <form method="POST" enctype="multipart/form-data">
            <div class="row g-4">

                <!-- LEFT COLUMN -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Name *</label>
                        <input type="text" name="name" class="form-control" required
                               value="<?php echo htmlspecialchars($member['name'] ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Role *</label>
                        <input type="text" name="role" class="form-control" required
                               value="<?php echo htmlspecialchars($member['role'] ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                               value="<?php echo htmlspecialchars($member['email'] ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="tel" name="phone" class="form-control"
                               value="<?php echo htmlspecialchars($member['phone'] ?? ''); ?>">
                    </div>

                </div>

                <!-- RIGHT COLUMN -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Photo</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">

                        <?php if ($member && $member['photo']): ?>
                            <img src="../<?php echo htmlspecialchars($member['photo']); ?>"
                                 class="mt-3 rounded-circle"
                                 style="width:90px;height:90px;object-fit:cover;">
                            <small class="d-block text-muted mt-1">
                                Leave empty to keep current photo
                            </small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" class="form-control"
                               value="<?php echo htmlspecialchars($member['linkedin_url'] ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control"
                               value="<?php echo (int)($member['sort_order'] ?? 0); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="Active"
                                <?php echo ($member['status'] ?? 'Active') == 'Active' ? 'selected' : ''; ?>>
                                Active
                            </option>
                            <option value="Inactive"
                                <?php echo ($member['status'] ?? '') == 'Inactive' ? 'selected' : ''; ?>>
                                Inactive
                            </option>
                        </select>
                    </div>

                </div>

            </div>

            <div class="mt-4">
                <label class="form-label fw-bold">Short Bio</label>
                <textarea name="short_bio" rows="4" class="form-control"><?php
                    echo htmlspecialchars($member['short_bio'] ?? '');
                ?></textarea>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-5">
                    <i class="fas fa-save"></i>
                    <?php echo $member ? 'Update Member' : 'Add Member'; ?>
                </button>
            </div>

        </form>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
