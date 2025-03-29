<?php 
include 'header.php'; 
include '../db.php'; // Ensure this file connects to qcredit_db

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['bg-image'])) {
    $target_dir = "uploads/"; // Ensure this directory exists and is writable
    $target_file = $target_dir . basename($_FILES["bg-image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an actual image
    $check = getimagesize($_FILES["bg-image"]["tmp_name"]);
    if ($check === false) {
        echo "<p>File is not an image.</p>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        echo "<p>Only JPG, JPEG, PNG & GIF files are allowed.</p>";
        $uploadOk = 0;
    }

    // Upload file
    if ($uploadOk && move_uploaded_file($_FILES["bg-image"]["tmp_name"], $target_file)) {
        // Store file path in database using the connection from db.php
        $sql = "UPDATE bgchanger SET bg_image = '$target_file' WHERE id = 1";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Background updated successfully!</p>";
        } else {
            echo "<p>Error updating background: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>Sorry, there was an error uploading your file.</p>";
    }
}

// Retrieve current background image
$sql = "SELECT bg_image FROM bgchanger WHERE id = 1";
$result = $conn->query($sql);
$bg_image = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $bg_image = $row["bg_image"];
}
?>

<!-- ==================== BACKGROUND SETTINGS ==================== -->
<div class="details">
    <div class="cardHeader">
        <h2>Background Settings</h2>
    </div>
    
    <?php if ($bg_image): ?>
        <p>Current Background:</p>
        <img src="<?php echo $bg_image; ?>" alt="Background Image" width="200">
    <?php endif; ?>
    
    <form method="post" enctype="multipart/form-data">
        <label>Upload Background Image:</label>
        <input type="file" name="bg-image" required>
        <button type="submit">Upload</button>
    </form>
</div>

<?php include 'footer.php'; ?>
