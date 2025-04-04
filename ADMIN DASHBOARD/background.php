<?php 
include 'header.php'; 
include '../db.php';

$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['bg-image'])) {
        $filename = 'bg_' . uniqid() . '.' . pathinfo($_FILES['bg-image']['name'], PATHINFO_EXTENSION);
        $target_file = $target_dir . $filename;
        
        if (uploadImage($_FILES['bg-image'], $target_file)) {
            $conn->query("INSERT INTO bgchanger (bg_image) VALUES ('$target_file')");
        }
    }
    
    if (isset($_FILES['mvl-image'])) {
        $filename = 'mvl_' . uniqid() . '.' . pathinfo($_FILES['mvl-image']['name'], PATHINFO_EXTENSION);
        $target_file = $target_dir . $filename;
        
        if (uploadImage($_FILES['mvl-image'], $target_file)) {
            $conn->query("INSERT INTO website_images (image_type, image_path) VALUES ('mvl', '$target_file')");
        }
    }
    
    foreach (['adult', 'market', 'house', 'responsibility'] as $type) {
        if (isset($_FILES["loan-$type-image"])) {
            $filename = 'loan_' . $type . '_' . uniqid() . '.' . 
                        pathinfo($_FILES["loan-$type-image"]['name'], PATHINFO_EXTENSION);
            $target_file = $target_dir . $filename;
            
            if (uploadImage($_FILES["loan-$type-image"], $target_file)) {
                $conn->query("INSERT INTO website_images (image_type, image_path) VALUES ('loan_requirement', '$target_file')");
            }
        }
    }

    if (isset($_POST['remove-bg'])) {
        $conn->query("DELETE FROM bgchanger");
    }
    
    if (isset($_POST['remove-mvl'])) {
        $conn->query("DELETE FROM website_images WHERE image_type = 'mvl'");
    }
    
    foreach (['adult', 'market', 'house', 'responsibility'] as $type) {
        if (isset($_POST["remove-loan-$type"])) {
            $conn->query("DELETE FROM website_images WHERE image_type = 'loan_requirement' AND image_path LIKE '%$type%'");
        }
    }
}

function uploadImage($file, $target_file) {
    global $message;
    
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        $message = "File is not an image.";
        return false;
    }

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        $message = "Only JPG, JPEG, PNG & GIF files are allowed.";
        return false;
    }

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $message = "Image uploaded successfully!";
        return true;
    } else {
        $message = "Sorry, there was an error uploading your file.";
        return false;
    }
}

// Fetch the latest images
function fetchLatestImage($table, $column) {
    global $conn;
    $sql = "SELECT $column FROM $table ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    return ($result && $result->num_rows > 0) ? $result->fetch_assoc()[$column] : "";
}

function fetchLatestWebsiteImage($type, $identifier = null) {
    global $conn;
    $sql = "SELECT image_path FROM website_images WHERE image_type = '$type'";
    if ($identifier) {
        $sql .= " AND image_path LIKE '%$identifier%'";
    }
    $sql .= " ORDER BY upload_time DESC LIMIT 1";
    $result = $conn->query($sql);
    return ($result && $result->num_rows > 0) ? $result->fetch_assoc()['image_path'] : "";
}

$bg_image = fetchLatestImage("bgchanger", "bg_image");
$mvl_image = fetchLatestWebsiteImage("mvl");
$loan_images = [
    'adult' => fetchLatestWebsiteImage("loan_requirement", "adult"),
    'market' => fetchLatestWebsiteImage("loan_requirement", "market"),
    'house' => fetchLatestWebsiteImage("loan_requirement", "house"),
    'responsibility' => fetchLatestWebsiteImage("loan_requirement", "responsibility")
];
?>

<style>
    /* Base styles for all devices */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }
    
    .settings-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 15px;
        min-height: 100vh;
    }
    
    .settings-header {
        text-align: center;
        margin-bottom: 2rem;
        padding: 0 15px;
    }
    
    .settings-header h1 {
        font-size: 2rem;
        color: #333;
        margin-bottom: 0.5rem;
    }
    
    .settings-header p {
        color: #666;
        font-size: 1rem;
    }
    
    .settings-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        padding-bottom: 2rem;
    }
    
    .settings-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        transition: transform 0.3s ease;
        overflow: hidden;
    }
    
    .settings-card:hover {
        transform: translateY(-5px);
    }
    
    .card-header {
        border-bottom: 1px solid #eee;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .card-title {
        font-size: 1.25rem;
        color: #333;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .card-title i {
        color: #dc3545;
    }
    
    .image-preview-container {
        margin-bottom: 1.5rem;
        text-align: center;
    }
    
    .current-image-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #555;
    }
    
    .image-preview {
        max-width: 100%;
        height: auto;
        max-height: 300px;
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        object-fit: contain;
    }
    
    .no-image {
        padding: 2rem;
        background: #f8f9fa;
        border-radius: 8px;
        color: #6c757d;
        text-align: center;
    }
    
    .upload-form {
        margin-top: 1.5rem;
    }
    
    .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
        color: #444;
    }
    
    .form-control {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 1rem;
        font-size: 1rem;
    }
    
    .btn-group {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 0.6rem 1.2rem;
        border-radius: 5px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        flex: 1;
        text-align: center;
        min-width: 120px;
        font-size: 0.9rem;
    }
    
    .btn-primary {
        background-color: #dc3545;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #c82333;
    }
    
    .btn-danger {
        background-color: #6c757d;
        color: white;
    }
    
    .btn-danger:hover {
        background-color: #5a6268;
    }
    
    .alert {
        padding: 1rem;
        border-radius: 5px;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    
    .alert-info {
        background-color: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }
    
    .loan-icons-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        margin-top: 1.5rem;
    }
    
    .loan-icon-card {
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
    }
    
    /* Tablet styles (768px and up) */
    @media (min-width: 768px) {
        .settings-header h1 {
            font-size: 2.5rem;
        }
        
        .settings-grid {
            grid-template-columns: 1fr 1fr;
        }
        
        .loan-icons-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .settings-card[style*="grid-column: span 2"] {
            grid-column: span 2;
        }
    }
    
    /* Desktop styles (992px and up) */
    @media (min-width: 992px) {
        .loan-icons-grid {
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }
        
        .settings-container {
            padding: 0 30px;
        }
    }
    
    /* Mobile-specific adjustments */
    @media (max-width: 767px) {
        .settings-container {
            margin: 1rem auto;
        }
        
        .settings-header h1 {
            font-size: 1.8rem;
        }
        
        .settings-header p {
            font-size: 0.9rem;
        }
        
        .settings-card {
            padding: 1rem;
        }
        
        .card-title {
            font-size: 1.1rem;
        }
        
        .btn-group {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .btn {
            width: 100%;
            padding: 0.75rem;
        }
        
        .image-preview {
            max-height: 200px;
        }
        
        .no-image {
            padding: 1.5rem;
        }
    }
    
    /* Very small mobile devices (under 400px) */
    @media (max-width: 400px) {
        .settings-header h1 {
            font-size: 1.5rem;
        }
        
        .card-title {
            font-size: 1rem;
        }
        
        .current-image-label {
            font-size: 0.9rem;
        }
        
        .form-label {
            font-size: 0.9rem;
        }
        
        .image-preview {
            max-height: 150px;
        }
    }
</style>
   
<div class="settings-container">
    <div class="settings-header">
        <h1>Website Image Management</h1>
        <p class="text-muted">Upload and manage images for your website</p>
    </div>
    
    <div class="settings-grid">
        <div class="settings-card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-image"></i> Background Image
                </h2>
            </div>
            
            <div class="image-preview-container">
                <p class="current-image-label">Current Background:</p>
                <?php if ($bg_image): ?>
                    <img src="<?php echo $bg_image; ?>" alt="Current Background" class="image-preview">
                <?php else: ?>
                    <div class="no-image">
                        No background image set
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="upload-form">
                <form method="POST" enctype="multipart/form-data">
                    <label for="bg-upload" class="form-label">Upload New Background:</label>
                    <input type="file" id="bg-upload" name="bg-image" class="form-control" accept="image/*" required>
                    
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload
                        </button>
                        
                        <?php if ($bg_image): ?>
                            <button type="submit" name="remove-bg" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="settings-card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-store"></i> MVL Promo Image
                </h2>
            </div>
            
            <div class="image-preview-container">
                <p class="current-image-label">Current MVL Image:</p>
                <?php if ($mvl_image): ?>
                    <img src="<?php echo $mvl_image; ?>" alt="Current MVL Image" class="image-preview">
                <?php else: ?>
                    <div class="no-image">
                        No MVL image set
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="upload-form">
                <form method="POST" enctype="multipart/form-data">
                    <label for="mvl-upload" class="form-label">Upload New MVL Image:</label>
                    <input type="file" id="mvl-upload" name="mvl-image" class="form-control" accept="image/*" required>
                    
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload
                        </button>
                        
                        <?php if ($mvl_image): ?>
                            <button type="submit" name="remove-mvl" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="settings-card" style="grid-column: span 2;">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-list-check"></i> Loan Requirement Icons
                </h2>
            </div>
            
            <div class="loan-icons-grid">
                <?php foreach (['adult' => '18 to 75 Years', 'market' => 'Store Owner', 'house' => 'Permanent Resident', 'responsibility' => 'Responsible Borrower'] as $type => $label): ?>
                    <div class="loan-icon-card">
                        <div class="image-preview-container">
                            <p class="current-image-label"><?php echo $label; ?></p>
                            <?php if ($loan_images[$type]): ?>
                                <img src="<?php echo $loan_images[$type]; ?>" alt="<?php echo $label; ?>" class="image-preview" style="max-height: 100px;">
                            <?php else: ?>
                                <div class="no-image" style="padding: 1rem;">
                                    No image set
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="upload-form">
                            <form method="POST" enctype="multipart/form-data">
                                <label for="loan-<?php echo $type; ?>-upload" class="form-label">Upload New Icon:</label>
                                <input type="file" id="loan-<?php echo $type; ?>-upload" name="loan-<?php echo $type; ?>-image" class="form-control" accept="image/*">
                                
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-upload"></i> Upload
                                    </button>
                                    
                                    <?php if ($loan_images[$type]): ?>
                                        <button type="submit" name="remove-loan-<?php echo $type; ?>" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>