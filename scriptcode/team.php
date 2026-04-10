<?php
require 'common/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Team - ScriptAI Digital Services</title>
<link rel="stylesheet" href="style.css?v=1">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<?php include 'header.php'; ?>

<section class="page-hero">
    <h1>Our Team</h1>
    <p>Meet the experts behind ScriptAI Digital Services Pvt. Ltd.</p>
</section>

<?php
$stmt = $pdo->query("
    SELECT id, name, role, photo, short_bio, linkedin_url, email
    FROM team_members
    WHERE status = 'Active'
    ORDER BY sort_order ASC, id ASC
");
$team = $stmt->fetchAll();
?>

<section class="team-section">
    <div class="container">
        <div class="team-grid">
            <?php if (empty($team)): ?>
                <p>No team members added yet.</p>
            <?php else: ?>
                <?php foreach ($team as $m): ?>
                    <div class="team-card">
                        <?php
                        $img = (!empty($m['photo'])) ? htmlspecialchars($m['photo']) : 'img/default-avatar.png';
                        ?>
                        <img src="<?php echo $img; ?>"
                             alt="<?php echo htmlspecialchars($m['name']); ?>"
                             class="team-photo">

                        <h3><?php echo htmlspecialchars($m['name']); ?></h3>
                        <p class="team-role"><?php echo htmlspecialchars($m['role']); ?></p>

                        <?php if (!empty($m['short_bio'])): ?>
                            <p class="team-bio">
                                <?php echo nl2br(htmlspecialchars($m['short_bio'])); ?>
                            </p>
                        <?php endif; ?>

                        <div class="team-links">
                            <?php if (!empty($m['linkedin_url'])): ?>
                                <a href="<?php echo htmlspecialchars($m['linkedin_url']); ?>" target="_blank">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($m['email'])): ?>
                                <a href="mailto:<?php echo htmlspecialchars($m['email']); ?>">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<script src="script.js"></script>
</body>
</html>
