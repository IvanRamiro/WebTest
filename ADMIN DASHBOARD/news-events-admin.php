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
    $external_url = $_POST['external_url'] ?? '';
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $id = $_POST['id'] ?? null;

    if (!isset($error)) {
        if ($id) {
            $stmt = $conn->prepare("UPDATE newsevents SET title=?, description=?, external_url=?, is_featured=?, updated_at=NOW() WHERE id=?");
            $stmt->bind_param("sssii", $title, $description, $external_url, $is_featured, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO newsevents (title, description, external_url, is_featured) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $title, $description, $external_url, $is_featured);
        }
        
        if ($stmt->execute()) {
            $_SESSION['swal'] = [
                'icon' => 'success',
                'title' => $id ? 'Event Updated!' : 'Event Added!',
                'text' => "Your event has been " . ($id ? "updated" : "added") . " successfully.",
                'showConfirmButton' => false,
                'timer' => 2000,
                'timerProgressBar' => true,
                'position' => 'center'
            ];
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
    
    $stmt = $conn->prepare("DELETE FROM newsevents WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $_SESSION['swal'] = [
            'icon' => 'success',
            'title' => 'Deleted!',
            'text' => "Event deleted successfully!",
            'position' => 'top-end',
            'timer' => 1500,
            'showConfirmButton' => false
        ];
        header("Location: news-events-admin.php");
        exit();
    } else {
        $error = "Error deleting event: " . $stmt->error;
    }
    
    $stmt->close();
}

$events = $conn->query("SELECT * FROM newsevents ORDER BY is_featured DESC, created_at DESC");
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

.featured {
    background-color: #fff3cd;
    color: #856404;
    padding: 3px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
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

.external-link {
    word-break: break-all;
    color: #3498db;
    text-decoration: none;
}

.external-link:hover {
    text-decoration: underline;
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

        <form action="news-events-admin.php" method="POST" id="eventForm">
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
                <label for="external_url">External URL</label>
                <input type="url" id="external_url" name="external_url" 
                       value="<?= $editing ? htmlspecialchars($current_event['external_url']) : '' ?>"
                       placeholder="https://example.com/event-link" required>
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
                <button type="submit" class="btn btn-primary" id="saveBtn">
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
                            <th>Description</th>
                            <th>External Link</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $events->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['title']) ?></td>
                                <td class="truncate"><?= htmlspecialchars($row['description']) ?></td>
                                <td>
                                    <?php if (!empty($row['external_url'])): ?>
                                        <a href="<?= htmlspecialchars($row['external_url']) ?>" target="_blank" class="external-link">
                                            <?= htmlspecialchars(parse_url($row['external_url'], PHP_URL_HOST)) ?>
                                        </a>
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('M j, Y', strtotime($row['created_at'])) ?></td>
                                <td>
                                    <?php if ($row['is_featured']): ?>
                                        <span class="featured">Featured</span>
                                    <?php else: ?>
                                        <span>Regular</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="news-events-admin.php?edit=<?= $row['id'] ?>" class="action-btn edit-btn">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="#" class="action-btn delete-btn delete-event" data-id="<?= $row['id'] ?>">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show SweetAlert notifications from PHP
    <?php if (isset($_SESSION['swal'])): ?>
        Swal.fire({
            icon: '<?= $_SESSION['swal']['icon'] ?>',
            title: '<?= $_SESSION['swal']['title'] ?>',
            text: '<?= $_SESSION['swal']['text'] ?>',
            showConfirmButton: <?= $_SESSION['swal']['showConfirmButton'] ?? 'false' ?>,
            timer: <?= $_SESSION['swal']['timer'] ?? 'null' ?>,
            timerProgressBar: <?= $_SESSION['swal']['timerProgressBar'] ?? 'false' ?>,
            position: '<?= $_SESSION['swal']['position'] ?? 'center' ?>'
        });
        <?php unset($_SESSION['swal']); ?>
    <?php endif; ?>

    // Delete confirmation
    document.querySelectorAll('.delete-event').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const eventId = this.getAttribute('data-id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                backdrop: 'rgba(0,0,0,0.4)'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `news-events-admin.php?delete=${eventId}`;
                }
            });
        });
    });

    // Form submission confirmation
    document.getElementById('eventForm').addEventListener('submit', function(e) {
        const form = this;
        const isEdit = <?= $editing ? 'true' : 'false' ?>;
        
        e.preventDefault();
        
        Swal.fire({
            title: isEdit ? 'Update Event?' : 'Add New Event?',
            text: isEdit ? 'Are you sure you want to update this event?' : 'Are you sure you want to add this new event?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: isEdit ? 'Yes, update it!' : 'Yes, add it!',
            backdrop: 'rgba(0,0,0,0.4)'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Cancel button confirmation
    const cancelBtn = document.querySelector('.btn-secondary');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Cancel Editing?',
                text: 'You have unsaved changes that will be lost.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel!',
                backdrop: 'rgba(0,0,0,0.4)'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'news-events-admin.php';
                }
            });
        });
    }
});
</script>

<?php include 'footer.php'; ?>