<?php
include 'header.php'; 
require 'config.php';

$categories = ['General'];
$editing = false;
$current_testimonial = null;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM Testimonials WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $current_testimonial = $result->fetch_assoc();
    $editing = true;
    $stmt->close();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $video_url = $_POST['video_url'];
    $thumbnail_path = $_POST['thumbnail_path']; // Keep original path field
    $category = 'General';
    $id = $_POST['id'] ?? null;

    // Handle file upload if new file was provided
    if (!empty($_FILES['thumbnail_file']['name'])) {
        $target_dir = "uploads/"; // Relative to ADMIN DASHBOARD directory
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_extension = pathinfo($_FILES['thumbnail_file']['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES['thumbnail_file']['tmp_name'], $target_file)) {
            // Delete old thumbnail if it exists and was uploaded
            if (!empty($current_testimonial['thumbnail_path']) && 
                strpos($current_testimonial['thumbnail_path'], 'uploads/') === 0 &&
                file_exists($current_testimonial['thumbnail_path'])) {
                unlink($current_testimonial['thumbnail_path']);
            }
            $thumbnail_path = $target_file;
        } else {
            $error = "Sorry, there was an error uploading your file.";
        }
    }

    if (!isset($error)) {
        if ($id) {
            $stmt = $conn->prepare("UPDATE Testimonials SET title = ?, video_url = ?, thumbnail_path = ?, category = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $title, $video_url, $thumbnail_path, $category, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO Testimonials (title, video_url, thumbnail_path, category) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $title, $video_url, $thumbnail_path, $category);
        }
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Testimonial " . ($id ? "updated" : "added") . " successfully!";
            header("Location: testimonial.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
}

// Handle deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // First get the thumbnail path to delete the file if it was uploaded
    $stmt = $conn->prepare("SELECT thumbnail_path FROM Testimonials WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $testimonial = $result->fetch_assoc();
    $stmt->close();
    
    // Delete the record
    $stmt = $conn->prepare("DELETE FROM Testimonials WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Delete the thumbnail file if it was uploaded
        if (!empty($testimonial['thumbnail_path']) && 
            strpos($testimonial['thumbnail_path'], 'uploads/') === 0 &&
            file_exists($testimonial['thumbnail_path'])) {
            unlink($testimonial['thumbnail_path']);
        }
        
        $_SESSION['message'] = "Testimonial deleted successfully!";
        header("Location: testimonial.php");
        exit();
    } else {
        $error = "Error deleting testimonial: " . $stmt->error;
    }
    
    $stmt->close();
}

// Fetch all testimonials
$testimonials = $conn->query("SELECT * FROM Testimonials ORDER BY created_at DESC");
?>

<style>
/* ==================== TESTIMONIAL MANAGEMENT STYLES ==================== */
.form-container {
    background: var(--white);
    border-radius: var(--radius);
    padding: var(--spacing-lg);
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    margin-bottom: var(--spacing-lg);
}

.input-group {
    margin-bottom: var(--spacing-md);
}

.input-group label {
    display: block;
    margin-bottom: var(--spacing-sm);
    font-weight: 500;
    color: var(--black1);
}

.input-group input,
.input-group select,
.input-group textarea {
    width: 100%;
    padding: var(--spacing-md);
    border: 1px solid var(--black2);
    border-radius: var(--radius);
    font-size: var(--font-md);
    transition: all var(--transition-fast);
}

.input-group input:focus,
.input-group select:focus,
.input-group textarea:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(77, 35, 121, 0.2);
}

.upload-group {
    display: flex;
    gap: var(--spacing-sm);
}

.upload-btn {
    background: var(--gray);
    border: 1px solid var(--black2);
    border-radius: var(--radius);
    padding: 0 var(--spacing-md);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.upload-btn:hover {
    background: rgba(77, 35, 121, 0.1);
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: var(--spacing-md);
    margin-top: var(--spacing-lg);
}

.message {
    padding: var(--spacing-md);
    margin-bottom: var(--spacing-md);
    border-radius: var(--radius);
    font-weight: 500;
}

.success { 
    background: rgba(46, 204, 113, 0.2); 
    color: var(--primary);
}
.error { 
    background: rgba(231, 76, 60, 0.2); 
    color: #e74c3c;
}

/* ==================== TESTIMONIALS LIST STYLES ==================== */
.recentOrders {
    background: var(--white);
    border-radius: var(--radius);
    padding: var(--spacing-lg);  
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.cardHeader {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-lg);
}

.cardHeader h2 {
    font-size: var(--font-lg);
    margin: 0;
    color: var(--primary);
}

.testimonial-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: var(--font-md);
}

.testimonial-table th {
    background: var(--gray);
    padding: var(--spacing-md);
    text-align: left;
    font-weight: 600;
    color: var(--primary);
    position: sticky;
    top: 0;
}

.testimonial-table td {
    padding: var(--spacing-md);
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    vertical-align: middle;
}

.testimonial-table tr:hover td {
    background-color: var(--primary);
    color: var(--white);
}

.testimonial-table tr:hover td a {
    color: var(--secondary);
}

.status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: var(--font-sm);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-general { 
    background: rgba(25, 118, 210, 0.1);
    color: #1976d2;
    border: 1px solid rgba(25, 118, 210, 0.2);
}

.action-btn {
    display: inline-flex;
    align-items: center;
    padding: var(--spacing-sm) var(--spacing-md);
    border-radius: 6px;
    font-size: var(--font-sm);
    margin-right: var(--spacing-sm);
    transition: all var(--transition-fast);
}

.action-btn i {
    margin-right: 5px;
    font-size: 0.9rem;
}

.edit-btn {
    background: rgba(46, 204, 113, 0.1);
    color: var(--primary);
    border: 1px solid rgba(46, 204, 113, 0.2);
}

.edit-btn:hover {
    background: rgba(46, 204, 113, 0.2);
}

.delete-btn {
    background: rgba(231, 76, 60, 0.1);
    color: #e74c3c;
    border: 1px solid rgba(231, 76, 60, 0.2);
}

.delete-btn:hover {
    background: rgba(231, 76, 60, 0.2);
}

.empty-state {
    text-align: center;
    padding: var(--spacing-lg);
    background: var(--gray);
    border-radius: var(--radius);
    color: var(--black2);
}

.empty-state p {
    margin: 0;
    font-size: var(--font-md);
}

.thumbnail-preview {
    max-width: 120px;
    max-height: 80px;
    border-radius: 4px;
    display: block;
}

.thumbnail-input-container {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-sm);
}

@media (max-width: 768px) {
    .testimonial-table {
        display: block;
        overflow-x: auto;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .action-btn {
        margin-bottom: var(--spacing-sm);
    }
}
</style>

<div class="details">
    <!-- Form Section -->
    <div class="form-container">
        <h2><?= $editing ? 'Edit Testimonial' : 'Add New Testimonial' ?></h2>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message success"><?= $_SESSION['message'] ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="message error"><?= $error ?></div>
        <?php endif; ?>

        <form action="testimonial.php" method="POST" enctype="multipart/form-data">
            <?php if ($editing): ?>
                <input type="hidden" name="id" value="<?= $current_testimonial['id'] ?>">
            <?php endif; ?>
            
            <div class="input-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" 
                       value="<?= $editing ? htmlspecialchars($current_testimonial['title']) : '' ?>" required>
            </div>
            
            <input type="hidden" name="category" value="General">
            
            <div class="input-group">
                <label for="video_url">Video URL</label>
                <input type="url" id="video_url" name="video_url" 
                       value="<?= $editing ? htmlspecialchars($current_testimonial['video_url']) : '' ?>" required>
            </div>
            
            <div class="input-group">
                <label for="thumbnail_path">Thumbnail Path or Upload</label>
                <div class="thumbnail-input-container">
                    <input type="text" id="thumbnail_path" name="thumbnail_path" 
                           value="<?= $editing ? htmlspecialchars($current_testimonial['thumbnail_path']) : '' ?>">
                    <span>OR</span>
                    <input type="file" id="thumbnail_file" name="thumbnail_file" accept="image/*">
                </div>
                <?php if ($editing && !empty($current_testimonial['thumbnail_path'])): ?>
                    <div style="margin-top: var(--spacing-sm);">
                        <img src="<?= htmlspecialchars($current_testimonial['thumbnail_path']) ?>" class="thumbnail-preview">
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="form-actions">
                <?php if ($editing): ?>
                    <a href="testimonial.php" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> <?= $editing ? 'Update Testimonial' : 'Add Testimonial' ?>
                </button>
            </div>
        </form>
    </div>

    <!-- Testimonials List -->
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Manage Testimonials</h2>
        </div>

        <?php if ($testimonials->num_rows > 0): ?>
            <table class="testimonial-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Thumbnail</th>
                        <th>Video URL</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $testimonials->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['title']) ?></td>
                            <td>
                                <?php if (!empty($row['thumbnail_path'])): ?>
                                    <img src="<?= htmlspecialchars($row['thumbnail_path']) ?>" class="thumbnail-preview">
                                <?php else: ?>
                                    No thumbnail
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= htmlspecialchars($row['video_url']) ?>" target="_blank">
                                    View Video
                                </a>
                            </td>
                            <td><?= date('M j, Y', strtotime($row['created_at'])) ?></td>
                            <td>
                                <a href="testimonial.php?edit=<?= $row['id'] ?>" class="action-btn edit-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="testimonial.php?delete=<?= $row['id'] ?>" class="action-btn delete-btn" 
                                   onclick="return confirm('Are you sure you want to delete this testimonial?')">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <p>No testimonials found. Add your first testimonial using the form above.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>