<?php
include 'config.php';

try {
    $stmt = $pdo->query("SELECT image_path FROM images");
    echo "<h2>Uploaded Images</h2>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<img src='" . $row['image_path'] . "' width='200' height='200' style='margin:10px;'>";
    }
} catch (PDOException $e) {
    echo "Error fetching images: " . $e->getMessage();
}
?>
