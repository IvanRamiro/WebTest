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
    $thumbnail_path = $_POST['thumbnail_path'];
    $category = 'General';
    $id = $_POST['id'] ?? null;

    if ($id) {
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

.message {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
}
.success { background: #d4edda; color:rgb(3, 0, 156); }
.error { background: #f8d7da; color:rgb(255, 0, 25); }

/* ==================== TESTIMONIALS LIST STYLES ==================== */
.recentOrders {
    background: white;
    border-radius: 12px;
    padding: 30px;  
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.cardHeader {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.cardHeader h2 {
    font-size: 1.5rem;
    margin: 0;
}

.testimonial-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 0.95rem;
}

.testimonial-table th {
    background: #f8f9fa;
    padding: 15px;
    text-align: left;
    font-weight: 600;
    color: #2c3e50;
    position: sticky;
    top: 0;
}

.testimonial-table td {
    padding: 15px;
    border-bottom: 1px solid #eee;
    vertical-align: middle;
}

.testimonial-table tr:hover td {
    background-color: #f9f9f9;
}

.status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-general { 
    background: rgba(25, 118, 210, 0.1);
    color: #1976d2;
    border: 1px solid rgba(25, 118, 210, 0.2);
}

.status-premium { 
    background: rgba(255, 143, 0, 0.1);
    color: #ff8f00;
    border: 1px solid rgba(255, 143, 0, 0.2);
}

.status-vip { 
    background: rgba(194, 24, 91, 0.1);
    color:rgb(255, 0, 0);
    border: 1px solid rgba(194, 24, 91, 0.2);
}

.testimonial-table a {
    color:rgb(32, 0, 148);
    text-decoration: none;
    transition: all 0.2s;
}

.testimonial-table a:hover {
    color:rgb(32, 0, 202);
    text-decoration: underline;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 0.85rem;
    margin-right: 8px;
    transition: all 0.2s;
}

.action-btn i {
    margin-right: 5px;
    font-size: 0.9rem;
}

.edit-btn {
    background: rgba(46, 204, 113, 0.1);
    color:rgb(0, 26, 255);
    border: 1px solid rgba(46, 204, 113, 0.2);
}

.edit-btn:hover {
    background: rgba(46, 204, 113, 0.2);
}

.delete-btn {
    background: rgba(255, 25, 0, 0.1);
    color:rgb(255, 0, 0);
    border: 1px solid rgba(231, 76, 60, 0.2);
}

.delete-btn:hover {
    background: rgba(231, 76, 60, 0.2);
}

.empty-state {
    text-align: center;
    padding: 40px;
    background: #f8f9fa;
    border-radius: 8px;
    color: #7f8c8d;
}

.empty-state p {
    margin: 0;
    font-size: 1rem;
}

@media (max-width: 768px) {
    .testimonial-table {
        display: block;
        overflow-x: auto;
    }
    
    .action-btn {
        margin-bottom: 5px;
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

        <form action="testimonial.php" method="POST">
            <?php if ($editing): ?>
                <input type="hidden" name="id" value="<?= $current_testimonial['id'] ?>">
            <?php endif; ?>
            
            <div class="input-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" 
                       value="<?= $editing ? htmlspecialchars($current_testimonial['title']) : '' ?>" required>
            </div>
            
            <!-- Category field is now hidden since we only have General -->
            <input type="hidden" name="category" value="General">
            
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

<script>
    document.getElementById('upload-thumbnail').addEventListener('click', function() {
        alert('File upload functionality would be implemented here');
    });
</script>

<?php include 'footer.php'; ?>