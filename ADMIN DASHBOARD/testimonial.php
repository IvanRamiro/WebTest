<?php
require 'config.php'; // Database connection file

// Define categories
$categories = ['General', 'Premium', 'VIP'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $video_url = $_POST['video_url'];
    $thumbnail_path = $_POST['thumbnail_path'];
    $category = $_POST['category'];
    $id = $_POST['id'] ?? null;

    if ($id) {
        // Update existing testimonial
        $stmt = $conn->prepare("UPDATE Testimonials SET title = ?, video_url = ?, thumbnail_path = ?, category = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $title, $video_url, $thumbnail_path, $category, $id);
    } else {
        // Insert new testimonial
        $stmt = $conn->prepare("INSERT INTO Testimonials (title, video_url, thumbnail_path, category) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $video_url, $thumbnail_path, $category);
    }
    
    if ($stmt->execute()) {
        echo "Testimonial saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}

// Fetch existing testimonials for editing
$testimonials = $conn->query("SELECT * FROM Testimonials ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Testimonials</title>
</head>
<body>
    <h2>Manage Testimonials</h2>
    <form action="Testimonial.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" required><br>
        
        <label for="video_url">Video URL:</label>
        <input type="url" name="video_url" required><br>
        
        <label for="thumbnail_path">Thumbnail Path:</label>
        <input type="text" name="thumbnail_path" required><br>
        
        <label for="category">Category:</label>
        <select name="category" required>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat; ?>"><?= $cat; ?></option>
            <?php endforeach; ?>
        </select><br>
        
        <button type="submit">Submit</button>
    </form>

    <h3>Existing Testimonials</h3>
    <ul>
        <?php while ($row = $testimonials->fetch_assoc()): ?>
            <li>
                <?= htmlspecialchars($row['title']); ?> - 
                <a href="<?= htmlspecialchars($row['video_url']); ?>" target="_blank">View</a>
                (<a href="Testimonial.php?edit=<?= $row['id']; ?>">Edit</a>)
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
