<?php
include 'header.php';
require 'config.php';

$editing = false;
$current_event = null;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM newsevents WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $current_event = $result->fetch_assoc();
    $editing = true;
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];
    $external_url = $_POST['external_url'] ?? '';
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $id = $_POST['id'] ?? null;

    $thumbnail = $current_event['thumbnail'] ?? '';
    
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'Images-news-events/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = uniqid() . '_' . basename($_FILES['event_image']['name']);
        $targetPath = $uploadDir . $fileName;
        
        $check = getimagesize($_FILES['event_image']['tmp_name']);
        if ($check !== false) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (in_array($check['mime'], $allowedTypes)) {
                if (move_uploaded_file($_FILES['event_image']['tmp_name'], $targetPath)) {
                    $thumbnail = $targetPath;
                    
                    if ($editing && !empty($current_event['thumbnail']) && file_exists($current_event['thumbnail'])) {
                        unlink($current_event['thumbnail']);
                    }
                } else {
                    $error = "Sorry, there was an error uploading your file.";
                }
            } else {
                $error = "Only JPG, PNG, GIF & WEBP files are allowed.";
            }
        } else {
            $error = "File is not an image.";
        }
    }

    if (!isset($error)) {
        if ($id) {
            $stmt = $conn->prepare("UPDATE newsevents SET title=?, description=?, event_date=?, location=?, thumbnail=?, external_url=?, is_featured=?, updated_at=NOW() WHERE id=?");
            $stmt->bind_param("ssssssii", $title, $description, $event_date, $location, $thumbnail, $external_url, $is_featured, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO newsevents (title, description, event_date, location, thumbnail, external_url, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssi", $title, $description, $event_date, $location, $thumbnail, $external_url, $is_featured);
        }
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Event " . ($id ? "updated" : "added") . " successfully!";
            header("Location: news-events-admin.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    $stmt = $conn->prepare("SELECT thumbnail FROM newsevents WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
    $stmt->close();
    
    $stmt = $conn->prepare("DELETE FROM newsevents WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        if (!empty($event['thumbnail']) && file_exists($event['thumbnail'])) {
            unlink($event['thumbnail']);
        }
        
        $_SESSION['message'] = "Event deleted successfully!";
        header("Location: news-events-admin.php");
        exit();
    } else {
        $error = "Error deleting event: " . $stmt->error;
    }
    
    $stmt->close();
}

$events = $conn->query("SELECT *, 
                       CASE 
                           WHEN event_date > CURDATE() THEN 'upcoming'
                           WHEN event_date = CURDATE() THEN 'current'
                           ELSE 'past'
                       END AS status
                       FROM newsevents 
                       ORDER BY is_featured DESC, event_date DESC");
?>

<style>
.form-container {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    margin-bottom: 30px;
    border: 1px solid #e0e0e0;
}

.input-group {
    margin-bottom: 20px;
}

.input-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #333;
}

.input-group input,
.input-group select,
.input-group textarea {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s;
}

.input-group input:focus,
.input-group select:focus,
.input-group textarea:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52,152,219,0.1);
    outline: none;
}

.upload-group {
    display: flex;
    gap: 10px;
}

.upload-btn {
    background: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 0 15px;
    cursor: pointer;
    transition: all 0.2s;
}

.upload-btn:hover {
    background: #e9ecef;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    margin-top: 25px;
}

.btn {
    padding: 8px 20px;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 14px;
}

.btn-primary {
    background: #3498db;
    color: white;
    border: none;
}

.btn-primary:hover {
    background: #2980b9;
}

.btn-secondary {
    background: #f8f9fa;
    color: #555;
    border: 1px solid #ddd;
}

.btn-secondary:hover {
    background: #e9ecef;
}

.recentOrders {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    border: 1px solid #e0e0e0;
}

.testimonial-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.testimonial-table th {
    background: #f5f7fa;
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    color: #333;
    border-bottom: 2px solid #e0e0e0;
}

.testimonial-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #eee;
    vertical-align: middle;
}

.testimonial-table tr:hover td {
    background-color: #f9f9f9;
}

.status-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
}

.upcoming {
    background-color: #d4edda;
    color: #155724;
}

.current {
    background-color: #cce5ff;
    color: #004085;
}

.past {
    background-color: #e2e3e5;
    color: #383d41;
}

.featured {
    background-color: #fff3cd;
    color: #856404;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 13px;
    margin-right: 5px;
    transition: all 0.2s;
    text-decoration: none;
}

.action-btn i {
    margin-right: 5px;
    font-size: 12px;
}

.edit-btn {
    background: rgba(46, 204, 113, 0.1);
    color: #2ecc71;
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
    padding: 30px;
    background: #f8f9fa;
    border-radius: 8px;
    color: #6c757d;
}

.empty-state p {
    margin: 0;
    font-size: 14px;
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

.checkbox-label {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.checkbox-label input[type="checkbox"] {
    margin-right: 10px;
    width: auto;
    height: auto;
}

.current-image {
    margin-top: 15px;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 6px;
    border: 1px solid #eee;
}

.current-image p {
    margin-bottom: 8px;
    font-size: 14px;
    color: #555;
}
</style>

<div class="details">
    <div class="form-container">
        <h2><?= $editing ? 'Edit Event' : 'Add New Event' ?></h2>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success"><?= $_SESSION['message'] ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form action="news-events-admin.php" method="POST" enctype="multipart/form-data">
            <?php if ($editing): ?>
                <input type="hidden" name="id" value="<?= $current_event['id'] ?>">
            <?php endif; ?>
            
            <div class="input-group">
                <label for="title">Event Title</label>
                <input type="text" id="title" name="title" 
                       value="<?= $editing ? htmlspecialchars($current_event['title']) : '' ?>" required>
            </div>
            
            <div class="input-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5" required><?= 
                    $editing ? htmlspecialchars($current_event['description']) : '' 
                ?></textarea>
            </div>
            
            <div class="input-group">
                <label for="event_date">Event Date</label>
                <input type="date" id="event_date" name="event_date" 
                       value="<?= $editing ? htmlspecialchars($current_event['event_date']) : '' ?>" required>
            </div>
            
            <div class="input-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" 
                       value="<?= $editing ? htmlspecialchars($current_event['location']) : '' ?>">
            </div>
            
            <div class="input-group">
                <label for="external_url">External URL (Optional)</label>
                <input type="url" id="external_url" name="external_url" 
                       value="<?= $editing ? htmlspecialchars($current_event['external_url']) : '' ?>"
                       placeholder="https://example.com/event-link">
            </div>
            
            <div class="input-group">
                <label for="event_image">Event Thumbnail (Recommended: 800x450px)</label>
                <input type="file" id="event_image" name="event_image" accept="image/*">
                <?php if ($editing && !empty($current_event['thumbnail'])): ?>
                    <div class="current-image">
                        <p>Current Thumbnail:</p>
                        <img src="<?= htmlspecialchars($current_event['thumbnail']) ?>" style="max-width: 200px; max-height: 150px; display: block;">
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="input-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="is_featured" value="1" <?= 
                        $editing && $current_event['is_featured'] ? 'checked' : '' 
                    ?>> 
                    <span>Mark as Featured Event</span>
                </label>
            </div>
            
            <div class="form-actions">
                <?php if ($editing): ?>
                    <a href="news-events-admin.php" class="btn btn-secondary">Cancel</a>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> <?= $editing ? 'Update' : 'Save' ?>
                </button>
            </div>
        </form>
    </div>

    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Manage Events</h2>
        </div>

        <?php if ($events->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="testimonial-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Thumbnail</th>
                            <th>External Link</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $events->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['title']) ?></td>
                                <td><?= date('M j, Y', strtotime($row['event_date'])) ?></td>
                                <td><?= htmlspecialchars($row['location']) ?></td>
                                <td>
                                    <?php if (!empty($row['thumbnail'])): ?>
                                        <img src="<?= htmlspecialchars($row['thumbnail']) ?>" style="max-width: 80px; max-height: 60px; border-radius: 4px;">
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($row['external_url'])): ?>
                                        <a href="<?= htmlspecialchars($row['external_url']) ?>" target="_blank" style="word-break: break-all;">
                                            View Link
                                        </a>
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="status-badge <?= $row['status'] ?>">
                                        <?= ucfirst($row['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($row['is_featured']): ?>
                                        <span class="status-badge featured">Featured</span>
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="news-events-admin.php?edit=<?= $row['id'] ?>" class="action-btn edit-btn">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="news-events-admin.php?delete=<?= $row['id'] ?>" class="action-btn delete-btn" 
                                           onclick="return confirm('Are you sure you want to delete this event?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-calendar-times fa-2x mb-3"></i>
                <p>No events found. Add your first event using the form above.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>