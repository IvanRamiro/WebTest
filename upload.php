<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];

    if ($image['error'] != 0) {
        die(json_encode(['error' => 'Error uploading the file']));
    }

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $imageName = basename($image['name']);
    $imageName = preg_replace("/[^a-zA-Z0-9\-_\.]/", "_", $imageName);
    $uniqueFileName = uniqid() . '_' . $imageName;
    $imagePath = $uploadDir . $uniqueFileName;

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));

    if (!in_array($imageFileType, $allowedTypes)) {
        die(json_encode(['error' => 'Only JPG, JPEG, PNG & GIF files are allowed']));
    }

    if ($image['size'] > 5 * 1024 * 1024) {
        die(json_encode(['error' => 'File size exceeds 5MB limit']));
    }

    if (move_uploaded_file($image['tmp_name'], $imagePath)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO images (image_path) VALUES (:image_path)");
            $stmt->bindParam(':image_path', $imagePath);
            $stmt->execute();

            echo json_encode(['success' => 'Image uploaded successfully!', 'imageUrl' => $imagePath]);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Error moving the uploaded file']);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["background-image"])) {
    $targetDir = "uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = time() . "_" . basename($_FILES["background-image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if (in_array(strtolower($fileType), $allowedTypes)) {
        if (move_uploaded_file($_FILES["background-image"]["tmp_name"], $targetFilePath)) {
            echo json_encode(["imageUrl" => $targetFilePath]);
        } else {
            echo json_encode(["error" => "File upload failed."]);
        }
    } else {
        echo json_encode(["error" => "Invalid file type."]);
    }
} else {
    echo json_encode(["error" => "No file uploaded."]);
}
?>
