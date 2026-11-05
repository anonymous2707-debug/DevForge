<?php
require_once 'db.php';
include 'header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->execute([$id]);
$project = $stmt->fetch();

if (!$project) {
    echo "<div class='container'><div class='box'><p>Project not found. <a href='index.php'>Back to Home</a></p></div></div>";
    exit;
}
?>

<div class="container">
    <div class="box">
        <a href="index.php" style="color: royalblue; text-decoration: none; font-size: 13px;">&larr; Back to all projects</a>
        
        <h2 style="margin: 15px 0 5px 0;"><?= htmlspecialchars($project['title']); ?></h2>
        <span class="badge"><?= htmlspecialchars($project['tech']); ?></span>
        
        <p style="color: gray; font-size: 13px; margin: 8px 0 16px 0;">
            Uploaded by <b><?= htmlspecialchars($project['author']); ?></b> on <?= substr($project['created_at'], 0, 10); ?>
        </p>

        <hr style="border: 0; border-top: 1px solid lightgray; margin-bottom: 16px;">

        <h4>Overview:</h4>
        <p style="font-size: 14px; line-height: 1.6;"><?= nl2br(htmlspecialchars($project['description'])); ?></p>

        <?php if (!empty($project['link'])): ?>
            <p style="margin-top: 20px;">
                <b>Project Link:</b> 
                <a href="<?= htmlspecialchars($project['link']); ?>" target="_blank" style="color: royalblue;">
                    <?= htmlspecialchars($project['link']); ?>
                </a>
            </p>
        <?php endif; ?>
    </div>
    <div style="margin-top: 25px; border-top: 1px solid lightgray; padding-top: 15px;">
    <a href="edit.php?id=<?= $project['id']; ?>" class="btn" style="background-color: darkslategray;">Edit Project</a>
    <a href="delete.php?id=<?= $project['id']; ?>" class="btn" style="background-color: firebrick; margin-left: 8px;" onclick="return confirm('Are you sure you want to delete this project?');">Delete</a>
</div>
</div>

</body>
</html>