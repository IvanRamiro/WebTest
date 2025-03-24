<?php
include 'config.php';  // Include the database configuration file

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['background-image'])) {
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['background-image']['name']);
    $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Validate file type
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Invalid file type.";
        exit;
    }

    // Move uploaded file
    if (move_uploaded_file($_FILES['background-image']['tmp_name'], $uploadFile)) {
        echo "File uploaded successfully.";
    } else {
        echo "File upload failed.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];

    // Check for upload errors
    if ($image['error'] != 0) {
        echo json_encode(['error' => 'Error uploading the file']);
        exit;
    }

    // Define the upload directory and ensure it exists
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);  // Create directory if it doesn't exist
    }

    // Get the file name and sanitize it
    $imageName = basename($image['name']);
    $imageName = preg_replace("/[^a-zA-Z0-9\-_\.]/", "_", $imageName);  // Remove unsafe characters

    // Generate a unique file name using uniqid
    $uniqueFileName = uniqid() . '_' . $imageName;
    $imagePath = $uploadDir . $uniqueFileName;

    // Check if the file is an image (e.g., jpg, jpeg, png, gif)
    $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($imageFileType, $allowedTypes)) {
        // Check file size (e.g., max 5MB)
        if ($image['size'] > 5 * 1024 * 1024) {  // 5MB
            echo json_encode(['error' => 'File size exceeds the 5MB limit']);
            exit;
        }

        // Move the uploaded file to the server's uploads directory
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Insert the image path into the database (using PDO)
            try {
                $stmt = $pdo->prepare("INSERT INTO images (image_path) VALUES (:image_path)");
                $stmt->bindParam(':image_path', $imagePath);
                $stmt->execute();  // Execute the query

                // Return the image URL to be used in the frontend
                echo json_encode(['imageUrl' => $imagePath]);
            } catch (PDOException $e) {
                echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['error' => 'Error moving the uploaded file']);
        }
    } else {
        echo json_encode(['error' => 'Only JPG, JPEG, PNG & GIF files are allowed']);
    }
}
?>
