<?php 
include 'header.php'; 
include '../db.php';

$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Initialize message variable
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle delete operations first
    if (isset($_POST['remove-bg'])) {
        $conn->query("DELETE FROM bgchanger");
        $message = "Background image removed successfully!";
    }
    
    if (isset($_POST['remove-mvl'])) {
        $conn->query("DELETE FROM website_images WHERE image_type = 'mvl'");
        $message = "MVL image removed successfully!";
    }
    
    foreach (['adult', 'market', 'house', 'responsibility'] as $type) {
        if (isset($_POST["remove-loan-$type"])) {
            $conn->query("DELETE FROM website_images 
                         WHERE image_type = 'loan_requirement' 
                         AND image_subtype = '$type'");
            $message = "Loan requirement image for $type removed successfully!";
            continue;
        }
    }

    // Handle file uploads
    if (isset($_FILES['bg-image']) && !empty($_FILES['bg-image']['tmp_name'])) {
        $filename = 'bg_' . uniqid() . '.' . pathinfo($_FILES['bg-image']['name'], PATHINFO_EXTENSION);
        $target_file = $target_dir . $filename;
        
        if (uploadImage($_FILES['bg-image'], $target_file)) {
            $conn->query("INSERT INTO bgchanger (bg_image) VALUES ('$target_file')");
        }
    }
    
    if (isset($_FILES['mvl-image']) && !empty($_FILES['mvl-image']['tmp_name'])) {
        $filename = 'mvl_' . uniqid() . '.' . pathinfo($_FILES['mvl-image']['name'], PATHINFO_EXTENSION);
        $target_file = $target_dir . $filename;
        
        if (uploadImage($_FILES['mvl-image'], $target_file)) {
            $conn->query("INSERT INTO website_images (image_type, image_path) VALUES ('mvl', '$target_file')");
        }
    }
    
    foreach (['adult', 'market', 'house', 'responsibility'] as $type) {
        $fieldName = "loan-$type-image";
        if (isset($_FILES[$fieldName]) && !empty($_FILES[$fieldName]['tmp_name'])) {
            $filename = 'loan_' . $type . '_' . uniqid() . '.' . 
                        pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
            $target_file = $target_dir . $filename;
            
            if (uploadImage($_FILES[$fieldName], $target_file)) {
                $conn->query("INSERT INTO website_images 
                            (image_type, image_subtype, image_path) 
                            VALUES ('loan_requirement', '$type', '$target_file')");
            }
        }
    }

    // Handle text updates
    if (isset($_POST['update_texts'])) {
        foreach (['adult', 'market', 'house', 'responsibility'] as $type) {
            $line1 = $conn->real_escape_string($_POST[$type.'_line1']);
            $line2 = $conn->real_escape_string($_POST[$type.'_line2']);
            
            $check = $conn->query("SELECT 1 FROM loan_requirement_texts WHERE requirement_type = '$type'");
            
            if ($check->num_rows > 0) {
                $conn->query("UPDATE loan_requirement_texts 
                            SET line1 = '$line1', line2 = '$line2' 
                            WHERE requirement_type = '$type'");
            } else {
                $conn->query("INSERT INTO loan_requirement_texts 
                            (requirement_type, line1, line2) 
                            VALUES ('$type', '$line1', '$line2')");
            }
        }
        $message = "Texts updated successfully!";
    }
}

function uploadImage($file, $target_file) {
    global $message;
    
    if (empty($file['tmp_name'])) {
        $message = "No file was uploaded.";
        return false;
    }
    
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
$bg_image = fetchLatestImage("bgchanger", "bg_image");
$mvl_image = fetchLatestWebsiteImage("mvl");
$loan_images = [
    'adult' => fetchLatestWebsiteImage("loan_requirement", "adult"),
    'market' => fetchLatestWebsiteImage("loan_requirement", "market"),
    'house' => fetchLatestWebsiteImage("loan_requirement", "house"),
    'responsibility' => fetchLatestWebsiteImage("loan_requirement", "responsibility")
];

// Fetch loan requirement texts
$loan_texts = [];
$result = $conn->query("SELECT * FROM loan_requirement_texts");
while ($row = $result->fetch_assoc()) {
    $loan_texts[$row['requirement_type']] = $row;
}

// Default values
$default_texts = [
    'adult' => ['line1' => '18 to 75', 'line2' => 'Years of Age'],
    'market' => ['line1' => 'A Store or', 'line2' => 'Market Stall Owner'],
    'house' => ['line1' => 'A Permanent', 'line2' => 'Resident'],
    'responsibility' => ['line1' => 'A Responsible', 'line2' => 'Borrower']
];

// Merge with defaults
foreach ($default_texts as $type => $text) {
    if (!isset($loan_texts[$type])) {
        $loan_texts[$type] = $text;
    }
}

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
        $sql .= " AND image_subtype = '$identifier'";
    }
    $sql .= " ORDER BY upload_time DESC LIMIT 1";
    $result = $conn->query($sql);
    return ($result && $result->num_rows > 0) ? $result->fetch_assoc()['image_path'] : "";
}
?>

<style>
.main-content-wrapper {
    height: calc(100vh - 120px);
    overflow-y: auto;
    padding: 20px;
    width: calc(100% - 100px);
    margin-left: 50px;
    box-sizing: border-box;
    background-color: #f5f5f5;
}

.settings-container {
    max-width: 1200px;
    margin: 0 auto;
    min-height: 100%;
    box-sizing: border-box;
}

.top-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.settings-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
    transition: transform 0.3s ease;
    overflow: hidden;
    height: 100%;
    box-sizing: border-box;
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

.image-preview-container {
    margin-bottom: 1.5rem;
    text-align: center;
}

.image-preview {
    max-width: 100%;
    height: auto;
    max-height: 200px;
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
    margin: auto 0;
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

.loan-icons-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.loan-icon-card {
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 1rem;
}

.text-preview {
    background: #f8f9fa;
    padding: 0.5rem;
    border-radius: 5px;
    margin-bottom: 1rem;
    text-align: center;
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

@media (max-width: 992px) {
    .main-content-wrapper {
        width: 100%;
        margin-left: 0;
        padding: 15px;
    }
    
    .top-row {
        grid-template-columns: 1fr;
    }
    
    .loan-icons-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .loan-icons-grid {
        grid-template-columns: 1fr;
    }
    
    .settings-card {
        padding: 1rem;
    }
    
    .btn-group {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
    }
}
</style>

<div class="main-content-wrapper">
    <div class="settings-container">
        <div class="settings-header">
            <h1>Website Image Management</h1>
        </div>

        <?php if (!empty($message)): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <!-- Top Row - BG and MVL Cards -->
        <div class="top-row">
            <!-- Background Image Card -->
            <div class="settings-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-image"></i> Background Image
                    </h2>
                </div>
                
                <div class="image-preview-container">
                    <p class="current-image-label">Current Background:</p>
                    <?php if ($bg_image): ?>
                        <img src="<?php echo htmlspecialchars($bg_image); ?>" alt="Current Background" class="image-preview">
                    <?php else: ?>
                        <div class="no-image">
                            No background image set
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="upload-form">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="bg-upload" class="form-label">Upload New Background:</label>
                        <input type="file" id="bg-upload" name="bg-image" class="form-control" accept="image/*">
                        
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

            <!-- MVL Promo Image Card -->
            <div class="settings-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-store"></i> MVL Promo Image
                    </h2>
                </div>
                
                <div class="image-preview-container">
                    <p class="current-image-label">Current MVL Image:</p>
                    <?php if ($mvl_image): ?>
                        <img src="<?php echo htmlspecialchars($mvl_image); ?>" alt="Current MVL Image" class="image-preview">
                    <?php else: ?>
                        <div class="no-image">
                            No MVL image set
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="upload-form">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="mvl-upload" class="form-label">Upload New MVL Image:</label>
                        <input type="file" id="mvl-upload" name="mvl-image" class="form-control" accept="image/*">
                        
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
        </div>

        <!-- Loan Requirements Section -->
        <div class="settings-card mt-4">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-list-check"></i> Loan Requirement Icons & Text
                </h2>
            </div>
            
            <form method="POST" enctype="multipart/form-data">
                <div class="loan-icons-grid">
                    <?php foreach (['adult', 'market', 'house', 'responsibility'] as $type): ?>
                        <div class="loan-icon-card">
                            <div class="image-preview-container">
                                <div class="form-group">
                                    <label for="<?php echo $type; ?>_line1">Title:</label>
                                    <input type="text" id="<?php echo $type; ?>_line1" 
                                           name="<?php echo $type; ?>_line1" 
                                           class="form-control mb-2" 
                                           value="<?php echo htmlspecialchars($loan_texts[$type]['line1']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="<?php echo $type; ?>_line2">Description:</label>
                                    <input type="text" id="<?php echo $type; ?>_line2" 
                                           name="<?php echo $type; ?>_line2" 
                                           class="form-control" 
                                           value="<?php echo htmlspecialchars($loan_texts[$type]['line2']); ?>">
                                </div>
                                
                                <?php if ($loan_images[$type]): ?>
                                    <img src="<?php echo htmlspecialchars($loan_images[$type]); ?>" 
                                         alt="<?php echo htmlspecialchars($loan_texts[$type]['line1'].' '.$loan_texts[$type]['line2']); ?>" 
                                         class="image-preview mt-2" style="max-height: 100px;">
                                <?php else: ?>
                                    <div class="no-image mt-2" style="padding: 1rem; height: 100px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image fa-2x text-muted"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="upload-form mt-3">
                                <label for="loan-<?php echo $type; ?>-upload" class="form-label">Upload/Replace Icon:</label>
                                <input type="file" id="loan-<?php echo $type; ?>-upload" 
                                       name="loan-<?php echo $type; ?>-image" 
                                       class="form-control mb-2" 
                                       accept="image/*">
                                
                                <div class="btn-group">
                                    <button type="submit" name="update_texts" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Save Changes
                                    </button>
                                    
                                    <?php if ($loan_images[$type]): ?>
                                        <button type="submit" name="remove-loan-<?php echo $type; ?>" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Remove Icon
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>