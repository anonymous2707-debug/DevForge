<?php
require_once 'db.php';
include 'header.php';

$message = "";

if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $tech = $_POST['tech'];
    $link = trim($_POST['link']);
    $description = trim($_POST['description']);

    if (!empty($title) && !empty($author) && !empty($description)) {
        $stmt = $db->prepare("INSERT INTO projects (title, author, tech, link, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $author, $tech, $link, $description]);
        $message = "Project submitted successfully!";
    } else {
        $message = "Please fill in all mandatory fields.";
    }
}
?>

<div class="container" style="max-width: 600px;">
    <div class="box">
        <h2>Submit Project</h2>
        <p style="color: gray; font-size: 13px; margin-bottom: 15px;">Add details about your working application.</p>

        <?php if ($message != ""): ?>
            <div style="background-color: honeydew; color: darkgreen; border: 1px solid palegreen; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px;">
                <?= $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="upload.php">
            <div class="form-group">
                <label>Project Title *</label>
                <input type="text" name="title" placeholder="e.g. Attendance System" required>
            </div>

            <div class="form-group">
                <label>Your Name *</label>
                <input type="text" name="author" placeholder="e.g. Riya Tiwari" required>
            </div>

            <div class="form-group">
                <label>Technology Used</label>
                <select name="tech">
                    <option value="PHP / MySQL">PHP / MySQL</option>
                    <option value="Python">Python</option>
                    <option value="Java">Java</option>
                    <option value="C / C++">C / C++</option>
                    <option value="Web (HTML/JS)">Web (HTML/JS)</option>
                </select>
            </div>

            <div class="form-group">
                <label>GitHub / Drive Link</label>
                <input type="text" name="link" placeholder="https://github.com/...">
            </div>

            <div class="form-group">
                <label>Description *</label>
                <textarea name="description" rows="4" placeholder="Explain what the project does..." required></textarea>
            </div>

            <button type="submit" name="submit" class="btn" style="width: 100%;">Upload Project</button>
        </form>
    </div>
</div>

</body>
</html>