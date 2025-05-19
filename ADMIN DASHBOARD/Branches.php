<?php
include 'header.php'; 
include 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (isset($_POST['add_branch'])) {
            $branch_name = htmlspecialchars(trim($_POST['branch_name']));
            $branch_address = htmlspecialchars(trim($_POST['branch_address']));
            $map_link = trim($_POST['map_link']);

            if (empty($branch_name) || empty($branch_address) || empty($map_link)) {
                throw new Exception("All fields are required");
            }

            if (!filter_var($map_link, FILTER_VALIDATE_URL)) {
                throw new Exception("Invalid map URL format");
            }

            $stmt = $conn->prepare("INSERT INTO branch_locations (branch_name, branch_address, map_link) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $branch_name, $branch_address, $map_link);
            
            if ($stmt->execute()) {
                $success = "Branch added successfully!";
            } else {
                throw new Exception("Error adding branch: " . $stmt->error);
            }

        } elseif (isset($_POST['update_branch'])) {
            $id = intval($_POST['id']);
            $branch_name = htmlspecialchars(trim($_POST['branch_name']));
            $branch_address = htmlspecialchars(trim($_POST['branch_address']));
            $map_link = trim($_POST['map_link']);

            if (empty($branch_name) || empty($branch_address) || empty($map_link)) {
                throw new Exception("All fields are required");
            }

            if (!filter_var($map_link, FILTER_VALIDATE_URL)) {
                throw new Exception("Invalid map URL format");
            }

            $stmt = $conn->prepare("UPDATE branch_locations SET branch_name=?, branch_address=?, map_link=? WHERE id=?");
            $stmt->bind_param("sssi", $branch_name, $branch_address, $map_link, $id);
            
            if ($stmt->execute()) {
                $success = "Branch updated successfully!";
            } else {
                throw new Exception("Error updating branch: " . $stmt->error);
            }

        } elseif (isset($_POST['delete_branch'])) {
            $id = intval($_POST['id']);
            
            $stmt = $conn->prepare("DELETE FROM branch_locations WHERE id=?");
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                $success = "Branch deleted successfully!";
            } else {
                throw new Exception("Error deleting branch: " . $stmt->error);
            }
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

$branches = $conn->query("SELECT * FROM branch_locations ORDER BY id");
?>

<style>
.branch-management-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    background-color: #f8f9fa;
    min-height: 100vh;
}

.branch-management-container h2 {
    color: var(--primary);
    margin-bottom: 1.5rem;
    font-weight: 600;
    text-align: center;
}

.branch-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 2rem;
    overflow: hidden;
}

.branch-card-header {
    padding: 1.25rem;
    background-color: var(--primary);
    color: #fff;
    font-size: 1.25rem;
    font-weight: 600;
}

.branch-card-body {
    padding: 1.5rem;
}

.branch-form-group {
    margin-bottom: 1.5rem;
}

.branch-form-label {
    display: block;
    font-weight: 500;
    color: var(--black1);
    margin-bottom: 0.5rem;
}

.branch-form-control {
    width: 100%;
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 0.75rem;
    transition: all 0.3s;
    font-size: 1rem;
}

.branch-form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(77, 35, 121, 0.2);
    outline: none;
}

.branch-btn {
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s;
    cursor: pointer;
    border: none;
    font-size: 1rem;
}

.branch-btn-primary {
    background-color: var(--primary);
    color: white;
}

.branch-btn-primary:hover {
    background-color: var(--primary2);
    transform: translateY(-2px);
}

.branch-btn-danger {
    background-color: #dc3545;
    color: white;
}

.branch-btn-danger:hover {
    background-color: #c82333;
    transform: translateY(-2px);
}

.branch-btn-secondary {
    background-color: #6c757d;
    color: white;
}

.branch-btn-secondary:hover {
    background-color: #5a6268;
    transform: translateY(-2px);
}

.branch-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
    font-weight: 200;
}

.branch-table th {
    background-color: var(--primary);
    color: white;
    padding: 1rem;
    text-align: left;
}

.branch-table td {
    padding: 1rem;
    border-bottom: 1px solid #eee;
    vertical-align: middle;
}

.branch-table tr:hover {
    background-color: rgba(119, 0, 255, 0.05);
}

.branch-table tr:hover td {
    color: #000;
    font-weight: 200;
}

.branch-actions {
    display: flex;
    gap: 0.5rem;
}

.branch-text-truncate {
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.modal-overlay.active {
    opacity: 1;
    visibility: visible;
}

.modal-content {
    background-color: white;
    border-radius: 12px;
    width: 90%;
    max-width: 800px;
    max-height: 90vh;
    overflow-y: auto;
    transform: translateY(-20px);
    transition: transform 0.3s ease;
}

.modal-overlay.active .modal-content {
    transform: translateY(0);
}

.modal-header {
    padding: 1.25rem;
    background-color: var(--primary);
    color: white;
    border-radius: 12px 12px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-title {
    margin: 0;
    font-size: 1.25rem;
}

.modal-close {
    background: none;
    border: none;
    color: white;
    font-size: 1.5rem;
    cursor: pointer;
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid #eee;
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
}

.map-preview-container {
    height: 300px;
    background: #f5f5f5;
    border-radius: 8px;
    overflow: hidden;
    margin-top: 1rem;
}

.map-preview-iframe {
    width: 100%;
    height: 100%;
    border: 0;
}

@media (max-width: 768px) {
    .branch-management-container {
        padding: 1rem;
    }
    
    .branch-table {
        display: block;
        overflow-x: auto;
    }
    
    .branch-actions {
        flex-direction: column;
    }
}
</style>

<div class="branch-management-container">
    <h2>Manage Branch Locations</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    
    <div class="branch-card">
        <div class="branch-card-header">
            <h3 class="mb-0">Add New Branch</h3>
        </div>
        <div class="branch-card-body">
            <form method="POST">
                <div class="branch-form-group">
                    <label for="branch_name" class="branch-form-label">Branch Name</label>
                    <input type="text" class="branch-form-control" id="branch_name" name="branch_name" required>
                </div>
                <div class="branch-form-group">
                    <label for="branch_address" class="branch-form-label">Branch Address</label>
                    <textarea class="branch-form-control" id="branch_address" name="branch_address" rows="3" required></textarea>
                </div>
                <div class="branch-form-group">
                    <label for="map_link" class="branch-form-label">Google Maps Embed Link</label>
                    <input type="url" class="branch-form-control" id="map_link" name="map_link" 
                           placeholder="https://www.google.com/maps/embed?pb=..." required>
                    <small class="text-muted">Get the embed link from Google Maps > Share > Embed a map</small>
                </div>
                <button type="submit" name="add_branch" class="branch-btn branch-btn-primary">Add Branch</button>
            </form>
        </div>
    </div>

    <div class="branch-card">
        <div class="branch-card-header">
            <h3 class="mb-0">Existing Branches</h3>
        </div>
        <div class="branch-card-body">
            <?php if ($branches->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="branch-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Branch Name</th>
                                <th>Address</th>
                                <th>Map Link</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($branch = $branches->fetch_assoc()): ?>
                            <tr>
                                <td><?= $branch['id'] ?></td>
                                <td><?= htmlspecialchars($branch['branch_name']) ?></td>
                                <td><?= htmlspecialchars($branch['branch_address']) ?></td>
                                <td class="branch-text-truncate" title="<?= htmlspecialchars($branch['map_link']) ?>">
                                    <?= htmlspecialchars($branch['map_link']) ?>
                                </td>
                                <td class="branch-actions">
                                    <button class="branch-btn branch-btn-primary edit-btn" 
                                            data-id="<?= $branch['id'] ?>"
                                            data-name="<?= htmlspecialchars($branch['branch_name']) ?>"
                                            data-address="<?= htmlspecialchars($branch['branch_address']) ?>"
                                            data-link="<?= htmlspecialchars($branch['map_link']) ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $branch['id'] ?>">
                                        <input type="hidden" name="delete_branch" value="1">
                                        <button type="button" class="branch-btn branch-btn-danger delete-btn">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">No branches found. Add your first branch using the form above.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Edit Branch Modal -->
<div class="modal-overlay" id="editBranchModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Branch</h3>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <form method="POST">
            <div class="modal-body">
                <input type="hidden" name="id" id="editBranchId">
                <div class="branch-form-group">
                    <label for="editBranchName" class="branch-form-label">Branch Name</label>
                    <input type="text" class="branch-form-control" id="editBranchName" name="branch_name" required>
                </div>
                <div class="branch-form-group">
                    <label for="editBranchAddress" class="branch-form-label">Branch Address</label>
                    <textarea class="branch-form-control" id="editBranchAddress" name="branch_address" rows="3" required></textarea>
                </div>
                <div class="branch-form-group">
                    <label for="editMapLink" class="branch-form-label">Google Maps Embed Link</label>
                    <input type="url" class="branch-form-control" id="editMapLink" name="map_link" required>
                    <div class="map-preview-container">
                        <iframe id="mapPreviewFrame" class="map-preview-iframe" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="branch-btn branch-btn-secondary modal-close">Close</button>
                <button type="submit" name="update_branch" class="branch-btn branch-btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- Add SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal functionality
    const modal = document.getElementById('editBranchModal');
    const openModalButtons = document.querySelectorAll('.edit-btn');
    const closeModalButtons = document.querySelectorAll('.modal-close');
    
    function openModal() {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    // Open modal when edit button is clicked
    openModalButtons.forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('editBranchId').value = this.getAttribute('data-id');
            document.getElementById('editBranchName').value = this.getAttribute('data-name');
            document.getElementById('editBranchAddress').value = this.getAttribute('data-address');
            const mapLink = this.getAttribute('data-link');
            document.getElementById('editMapLink').value = mapLink;
            
            // Update map preview
            const iframe = document.getElementById('mapPreviewFrame');
            iframe.src = mapLink;
            
            openModal();
        });
    });
    
    // Close modal when close button is clicked
    closeModalButtons.forEach(button => {
        button.addEventListener('click', closeModal);
    });
    
    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    
    // Live map preview when editing the map link
    const mapLinkInput = document.getElementById('editMapLink');
    if (mapLinkInput) {
        mapLinkInput.addEventListener('input', function() {
            const iframe = document.getElementById('mapPreviewFrame');
            iframe.src = this.value;
        });
    }

    // SweetAlert2 for delete confirmation - FIXED VERSION
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

<?php include 'footer.php'; ?>