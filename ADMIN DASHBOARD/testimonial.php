<?php
include 'header.php'; 
require 'config.php'; // Database connection file

// Define categories
$categories = ['General', 'Premium', 'VIP'];
$editing = false;
$current_testimonial = null;

// Check if editing existing testimonial
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
        $_SESSION['message'] = "Testimonial " . ($id ? "updated" : "added") . " successfully!";
        header("Location: testimonial.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

// Handle deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM Testimonials WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
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
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.input-group {
    margin-bottom: 20px;
}

.input-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #555;
}

.input-group input,
.input-group select,
.input-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 0.95rem;
}

.upload-group {
    display: flex;
    gap: 10px;
}

.upload-btn {
    background: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 0 20px;
    cursor: pointer;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    margin-top: 25px;
}

.btn {
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
}

.btn-primary {
    background: #3498db;
    color: white;
    border: none;
}

.btn-secondary {
    background: #f8f9fa;
    color: #555;
    border: 1px solid #ddd;
}

.testimonial-table {
    width: 100%;
    border-collapse: collapse;
}

.testimonial-table th,
.testimonial-table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.status-badge {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-general { background: #e3f2fd; color: #1976d2; }
.status-premium { background: #fff8e1; color: #ff8f00; }
.status-vip { background: #fce4ec; color: #c2185b; }

.action-btn {
    padding: 8px 12px;
    border-radius: 5px;
    margin-right: 5px;
}

.edit-btn { background:rgb(3, 0, 156); color: white; }
.delete-btn { background:rgb(255, 25, 0); color: white; }

.message {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.success { background: #d4edda; color:rgb(3, 0, 156); }
.error { background: #f8d7da; color:rgb(255, 0, 25); }
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

            <form action="testimonial.php" method="POST">
                <?php if ($editing): ?>
                    <input type="hidden" name="id" value="<?= $current_testimonial['id'] ?>">
                <?php endif; ?>
                
                <div class="input-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" 
                           value="<?= $editing ? htmlspecialchars($current_testimonial['title']) : '' ?>" required>
                </div>
                
                <div class="input-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat ?>" 
                                <?= $editing && $current_testimonial['category'] == $cat ? 'selected' : '' ?>>
                                <?= $cat ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="input-group">
                    <label for="video_url">Video URL</label>
                    <input type="url" id="video_url" name="video_url" 
                           value="<?= $editing ? htmlspecialchars($current_testimonial['video_url']) : '' ?>" required>
                </div>
                
                <div class="input-group">
                    <label for="thumbnail_path">Thumbnail Path</label>
                    <div class="upload-group">
                        <input type="text" id="thumbnail_path" name="thumbnail_path" 
                               value="<?= $editing ? htmlspecialchars($current_testimonial['thumbnail_path']) : '' ?>" required>
                        <button type="button" class="upload-btn" id="upload-thumbnail">
                            <i class="fas fa-upload"></i> Upload
                        </button>
                    </div>
                </div>
                
                <div class="form-actions">
                    <?php if ($editing): ?>
                        <a href="testimonial.php" class="btn btn-secondary">Cancel</a>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary">
                        <?= $editing ? 'Update Testimonial' : 'Add Testimonial' ?>
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
                            <th>Category</th>
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
                                    <span class="status-badge status-<?= strtolower($row['category']) ?>">
                                        <?= htmlspecialchars($row['category']) ?>
                                    </span>
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
</div>

<script>
    // Thumbnail upload functionality
    document.getElementById('upload-thumbnail').addEventListener('click', function() {
        // This would be replaced with actual file upload logic
        alert('File upload functionality would be implemented here');
        // After upload, you would set the thumbnail_path input value to the uploaded file path
    });
</script>

<?php include 'footer.php'; ?>