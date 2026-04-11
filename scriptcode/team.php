<?php
require 'common/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Team - ScriptAI Digital Services</title>
    <link rel="stylesheet" href="style.css?v=3">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body style="background: var(--bg-white);">

<?php include 'header.php'; ?>

<section class="ds-mini-hero fade-up">
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

<section class="ds-content-section fade-up delay-1">
    <div class="ds-container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 40px; text-align: center;">
            <?php if (empty($team)): ?>
                <p>No team members added yet.</p>
            <?php else: ?>
                <?php foreach ($team as $m): ?>
                    <div style="background: white; border: 1px solid var(--border-light); border-radius: 12px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.03);">
                        <?php
                        $img = (!empty($m['photo'])) ? htmlspecialchars($m['photo']) : 'img/default-avatar.png';
                        ?>
                        <div style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; margin: 0 auto 20px;">
                            <img src="<?php echo $img; ?>"
                                 alt="<?php echo htmlspecialchars($m['name']); ?>"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <h3 style="margin-top: 0; margin-bottom: 5px; color: var(--text-navy);"><?php echo htmlspecialchars($m['name']); ?></h3>
                        <p style="color: var(--text-purple); font-weight: 500; font-size: 14px; margin-bottom: 20px;"><?php echo htmlspecialchars($m['role']); ?></p>

                        <?php if (!empty($m['short_bio'])): ?>
                            <p style="font-size: 14px; color: var(--text-muted); line-height: 1.6; margin-bottom: 20px;">
                                <?php echo nl2br(htmlspecialchars($m['short_bio'])); ?>
                            </p>
                        <?php endif; ?>

                        <div style="display: flex; gap: 15px; justify-content: center;">
                            <?php if (!empty($m['linkedin_url'])): ?>
                                <a href="<?php echo htmlspecialchars($m['linkedin_url']); ?>" target="_blank" style="color: var(--text-navy); font-size: 20px;">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($m['email'])): ?>
                                <a href="mailto:<?php echo htmlspecialchars($m['email']); ?>" style="color: var(--text-navy); font-size: 20px;">
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
