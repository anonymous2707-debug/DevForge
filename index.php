<?php
require_once 'db.php';
include 'header.php';

$query = $db->query("SELECT * FROM projects ORDER BY id DESC");
$projects = $query->fetchAll();
?>

<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <h2 style="margin: 0;">Explore Projects</h2>
            <p style="color: gray; margin: 5px 0 0 0; font-size: 14px;">Browse work built by students</p>
        </div>
        <a href="upload.php" class="btn">+ Add Project</a>
    </div>

    <?php if (empty($projects)): ?>
        <div class="box">
            <p>No projects submitted yet. Be the first one to add one!</p>
        </div>
    <?php else: ?>
        <div class="project-grid">
            <?php foreach ($projects as $row): ?>
                <div class="project-item">
                    <span class="badge"><?= htmlspecialchars($row['tech']); ?></span>
                    <h3 style="margin: 8px 0 4px 0;"><?= htmlspecialchars($row['title']); ?></h3>
                    <p style="font-size: 12px; color: gray; margin-bottom: 10px;">By <?= htmlspecialchars($row['author']); ?></p>
                    <p style="font-size: 13px; line-height: 1.4; margin-bottom: 14px;"><?= htmlspecialchars($row['description']); ?></p>
                    <a href="project.php?id=<?= $row['id']; ?>" class="btn">View Project</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>