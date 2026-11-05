<?php
require_once 'db.php';
include 'header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->execute([$id]);
$project = $stmt->fetch();

if (!$project) {
    echo "<div class='container'><p>Project not found.</p></div>";
    exit;
}

$message = "";

if (isset($_POST['update'])) {
    $title = trim($_POST['title']);
    $tech = $_POST['tech'];
    $link = trim($_POST['link']);
    $description = trim($_POST['description']);

    if (!empty($title) && !empty($description)) {
        $updateStmt = $db->prepare("UPDATE projects SET title = ?, tech = ?, link = ?, description = ? WHERE id = ?");
        $updateStmt->execute([$title, $tech, $link, $description, $id]);
        $message = "Project updated successfully!";
        // Refresh updated data
        $project['title'] = $title;
        $project['tech'] = $tech;
        $project['link'] = $link;
        $project['description'] = $description;
    }
}
?>

<div class="container" style="max-width: 600px;">
    <div class="box">
        <h2>Edit Project</h2>
        <?php if ($message != ""): ?>
            <p style="color: green; font-weight: bold;"><?= $message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Project Title</label>
                <input type="text" name="title" value="<?= htmlspecialchars($project['title']); ?>" required>
            </div>

            <div class="form-group">
                <label>Technology Used</label>
                <select name="tech">
                    <option value="PHP / MySQL" <?= $project['tech'] == 'PHP / MySQL' ? 'selected' : ''; ?>>PHP / MySQL</option>
                    <option value="Python" <?= $project['tech'] == 'Python' ? 'selected' : ''; ?>>Python</option>
                    <option value="Java" <?= $project['tech'] == 'Java' ? 'selected' : ''; ?>>Java</option>
                    <option value="C / C++" <?= $project['tech'] == 'C / C++' ? 'selected' : ''; ?>>C / C++</option>
                    <option value="Web (HTML/JS)" <?= $project['tech'] == 'Web (HTML/JS)' ? 'selected' : ''; ?>>Web (HTML/JS)</option>
                </select>
            </div>

            <div class="form-group">
                <label>GitHub / Drive Link</label>
                <input type="text" name="link" value="<?= htmlspecialchars($project['link']); ?>">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4" required><?= htmlspecialchars($project['description']); ?></textarea>
            </div>

            <button type="submit" name="update" class="btn">Save Changes</button>
            <a href="project.php?id=<?= $id; ?>" style="margin-left: 10px; color: gray; font-size: 13px;">Cancel</a>
        </form>
    </div>
</div>

</body>
</html>