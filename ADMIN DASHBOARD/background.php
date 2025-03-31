<?php 
include 'header.php'; 
include '../db.php'; // Connect to database

// Ensure uploads directory exists
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Handle background upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['bg-image'])) {
    $target_file = $target_dir . basename($_FILES["bg-image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate image file
    $check = getimagesize($_FILES["bg-image"]["tmp_name"]);
    if ($check === false) {
        $uploadOk = 0;
        $message = "File is not an image.";
    }

    // Allow only image formats
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        $uploadOk = 0;
        $message = "Only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // Upload and update database
    if ($uploadOk && move_uploaded_file($_FILES["bg-image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO bgchanger (bg_image) VALUES ('$target_file')";
        if ($conn->query($sql) === TRUE) {
            $message = "Background updated successfully!";
        } else {
            $message = "Error updating background: " . $conn->error;
        }
    } else {
        $message = "Sorry, there was an error uploading your file.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove-bg'])) {
    $sql = "DELETE FROM bgchanger";
    if ($conn->query($sql) === TRUE) {
        $message = "Background removed successfully!";
    } else {
        $message = "Error removing background: " . $conn->error;
    }
}

// Fetch the latest background image
$sql = "SELECT bg_image FROM bgchanger ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$bg_image = "";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $bg_image = $row["bg_image"];
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Background Settings</h2>
            <div class="bg-white p-4 rounded shadow-sm">
                <?php if ($bg_image): ?>
                    <p class="text-center">Current Background:</p>
                    <img src="<?php echo $bg_image; ?>" alt="Background Image" class="img-fluid rounded border">
                <?php endif; ?>

                <form method="post" enctype="multipart/form-data" class="mt-4 text-center">
                    <label class="form-label">Upload Background Image:</label>
                    <input type="file" name="bg-image" class="form-control mb-3" required>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>

                <?php if ($bg_image): ?>
                    <form method="post" class="mt-3 text-center">
                        <button type="submit" name="remove-bg" class="btn btn-danger">
                            Remove Background
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
