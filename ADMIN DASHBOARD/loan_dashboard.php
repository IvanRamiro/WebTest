<?php include 'header.php'; ?>
<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Applications Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --pending: #f6c23e;
            --approved: #1cc88a;
            --rejected: #e74a3b;
            --card-shadow: 0 4px 8px rgba(0,0,0,0.1);
            --dark-blue: #2c3e50;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            padding: 25px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border-top: 4px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark-blue);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            background: var(--dark-blue);
        }

        .card-value {
            font-size: 42px;
            font-weight: 700;
            margin: 15px 0;
            color: var(--dark-blue);
        }

        .card-footer {
            font-size: 14px;
            color: #666;
            display: flex;
            align-items: center;
        }

        .pending { border-top-color: var(--pending); }
        .pending .card-icon { background: var(--pending); }

        .approved { border-top-color: var(--approved); }
        .approved .card-icon { background: var(--approved); }

        .rejected { border-top-color: var(--rejected); }
        .rejected .card-icon { background: var(--rejected); }

        .recent-applications {
            grid-column: 1 / -1;
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            margin-top: 20px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .applications-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .applications-table th {
            background-color: #f8f9fa;
            color: var(--dark-blue);
            font-weight: 600;
            text-align: left;
            padding: 12px 15px;
            border-bottom: 2px solid #eee;
        }

        .applications-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .applications-table tr:hover {
            background-color: #f0f8ff;
        }

        .applications-table .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            min-width: 80px;
            text-align: center;
        }

        .badge-pending {
            background-color: rgba(246, 194, 62, 0.2);
            color: var(--pending);
        }

        .badge-approved {
            background-color: rgba(28, 200, 138, 0.2);
            color: var(--approved);
        }

        .badge-rejected {
            background-color: rgba(231, 74, 59, 0.2);
            color: var(--rejected);
        }

        .applications-table .action-btn {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            border: 1px solid #ddd;
            background: white;
            transition: all 0.3s;
        }

        .applications-table .action-btn:hover {
            background: #f0f0f0;
        }

        .applications-table .status-select {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 12px;
            cursor: pointer;
            background: white;
        }

        .status-select.pending {
            border-color: var(--pending);
            color: var(--pending);
        }

        .status-select.approved {
            border-color: var(--approved);
            color: var(--approved);
        }

        .status-select.rejected {
            border-color: var(--rejected);
            color: var(--rejected);
        }

        .application-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1050;
            overflow-y: auto;
        }

        .application-modal.show {
            display: block;
        }

        .modal-content {
            border-radius: 12px;
            overflow: hidden;
            margin: 2rem auto;
            max-width: 90%;
            width: 900px;
            background: white;
        }

        .modal-header {
            background-color: #2c3e50;
            color: white;
            border-bottom: none;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-weight: 600;
            margin: 0;
        }

        .modal-body {
            padding: 2rem;
            max-height: 70vh;
            overflow-y: auto;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .info-value {
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
            margin-bottom: 1rem;
        }

        .document-preview {
            width: 100%;
            height: 200px;
            background-color: #f8f9fa;
            border: 1px dashed #ddd;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            overflow: hidden;
            position: relative;
        }

        .document-info {
            text-align: center;
            padding: 15px;
        }

        .document-name {
            margin-top: 10px;
            font-size: 14px;
            word-break: break-all;
        }

        .document-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .document-preview img:hover {
            transform: scale(1.05);
        }

        .document-preview iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .modal-footer {
            padding: 1rem;
            border-top: 1px solid #eee;
            background: #f8f9fa;
            display: flex;
            justify-content: flex-end;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            border: 1px solid transparent;
            font-size: 14px;
            transition: all 0.3s;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-primary {
            background-color: #0d6efd;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .btn-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }

        .col-md-4, .col-md-6 {
            padding: 0 15px;
            flex: 0 0 100%;
            max-width: 100%;
            margin-bottom: 1rem;
        }

        @media (min-width: 768px) {
            .col-md-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }
            .col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (max-width: 768px) {
            .card-value {
                font-size: 36px;
            }
            
            .dashboard-container {
                grid-template-columns: 1fr;
            }
            
            .applications-table {
                display: block;
                overflow-x: auto;
            }

            .modal-content {
                max-width: 95%;
                margin: 1rem auto;
            }

            .modal-body {
                padding: 15px;
                max-height: 65vh;
            }
            
            .info-label {
                font-size: 14px;
            }
            
            .info-value {
                font-size: 14px;
            }

            .document-preview {
                height: 150px;
            }
        }

        @media (max-width: 576px) {
            .modal-body {
                max-height: 60vh;
                padding: 10px;
            }
            
            .section-title {
                font-size: 18px;
                margin-bottom: 15px;
            }
        }

        .modal-body::-webkit-scrollbar {
            width: 8px;
        }

        .modal-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .modal-body::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .download-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
    </style>
</head>
<body>
    
<div class="dashboard-container">
    <?php
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Get counts for each status
        $stmt = $pdo->query("SELECT status, COUNT(*) as count FROM loan_application GROUP BY status");
        $statusCounts = ['pending' => 0, 'approved' => 0, 'rejected' => 0];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $statusCounts[$row['status']] = $row['count'];
        }

        $pendingCount = $statusCounts['pending'];
        $approvedCount = $statusCounts['approved'];
        $rejectedCount = $statusCounts['rejected'];

        // Calculate percentages
        $total = $pendingCount + $approvedCount + $rejectedCount;
        $approvalRate = $total > 0 ? round(($approvedCount / $total) * 100, 1) : 0;
        $rejectionRate = $total > 0 ? round(($rejectedCount / $total) * 100, 1) : 0;
    } catch(PDOException $e) {
        $pendingCount = $approvedCount = $rejectedCount = 0;
        $approvalRate = $rejectionRate = 0;
    }
    ?>

    <!-- Status Cards -->
    <div class="stat-card pending">
        <div class="card-header">
            <span class="card-title">Pending Applications</span>
            <div class="card-icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
        <div class="card-value"><?= $pendingCount ?></div>
        <div class="card-footer">
            <i class="fas fa-info-circle"></i> Awaiting review
        </div>
    </div>

    <div class="stat-card approved">
        <div class="card-header">
            <span class="card-title">Approved Applications</span>
            <div class="card-icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
        <div class="card-value"><?= $approvedCount ?></div>
        <div class="card-footer">
            <i class="fas fa-chart-line"></i> <?= $approvalRate ?>% approval rate
        </div>
    </div>

    <div class="stat-card rejected">
        <div class="card-header">
            <span class="card-title">Rejected Applications</span>
            <div class="card-icon">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
        <div class="card-value"><?= $rejectedCount ?></div>
        <div class="card-footer">
            <i class="fas fa-exclamation-triangle"></i> <?= $rejectionRate ?>% rejection rate
        </div>
    </div>

    <!-- Recent Applications Table -->
    <div class="recent-applications">
        <h2 class="section-title">Recent Applications</h2>
        <table class="applications-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Applicant</th>
                    <th>Loan Amount</th>
                    <th>Loan Purpose</th>
                    <th>Date Submitted</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $stmt = $pdo->query("
                        SELECT id, first_name, last_name, loan_amount, loan_purpose, 
                               DATE_FORMAT(submitted_at, '%Y-%m-%d %H:%i') as formatted_date, 
                               status 
                        FROM loan_application 
                        ORDER BY submitted_at DESC 
                        LIMIT 10
                    ");

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $statusClass = strtolower($row['status']);
                        $badgeClass = 'badge-' . $statusClass;
                        
                        echo '
                        <tr>
                            <td>#' . htmlspecialchars($row['id']) . '</td>
                            <td>' . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . '</td>
                            <td>₱' . number_format($row['loan_amount'], 2) . '</td>
                            <td>' . htmlspecialchars($row['loan_purpose']) . '</td>
                            <td>' . htmlspecialchars($row['formatted_date']) . '</td>
                            <td>
                                <span class="status-badge ' . $badgeClass . '">' . ucfirst($row['status']) . '</span>
                            </td>
                            <td>
                                <select class="status-select ' . $statusClass . '" 
                                        data-application-id="' . $row['id'] . '" 
                                        onchange="updateStatus(this, event)">
                                    <option value="pending" ' . ($row['status'] == 'pending' ? 'selected' : '') . '>Pending</option>
                                    <option value="approved" ' . ($row['status'] == 'approved' ? 'selected' : '') . '>Approved</option>
                                    <option value="rejected" ' . ($row['status'] == 'rejected' ? 'selected' : '') . '>Rejected</option>
                                </select>
                                <button class="action-btn" onclick="showApplicationDetails(' . $row['id'] . ', event)">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                        </tr>';
                    }
                } catch(PDOException $e) {
                    echo '<tr><td colspan="7" class="text-center">Error fetching applications: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Application Detail Modal -->
<div class="application-modal" id="applicationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="applicationModalLabel">Loan Application Details</h5>
            <button type="button" class="btn-close" onclick="hideModal()" aria-label="Close">×</button>
        </div>
        <div class="modal-body">
            <!-- Personal Information -->
            <div class="form-section">
                <h4 class="section-title">Personal Information</h4>
                <div class="row">
                    <div class="col-md-4"><div class="info-label">First Name</div><div class="info-value" id="detail-firstName"></div></div>
                    <div class="col-md-4"><div class="info-label">Middle Name</div><div class="info-value" id="detail-middleName"></div></div>
                    <div class="col-md-4"><div class="info-label">Last Name</div><div class="info-value" id="detail-lastName"></div></div>
                    <div class="col-md-6"><div class="info-label">Date of Birth</div><div class="info-value" id="detail-birthDate"></div></div>
                    <div class="col-md-6"><div class="info-label">Civil Status</div><div class="info-value" id="detail-civilStatus"></div></div>
                    <div class="col-md-6"><div class="info-label">Email Address</div><div class="info-value" id="detail-email"></div></div>
                    <div class="col-md-6"><div class="info-label">Mobile Number</div><div class="info-value" id="detail-mobile"></div></div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="form-section">
                <h4 class="section-title">Address Information</h4>
                <div class="row">
                    <div class="col-md-6"><div class="info-label">Current Address</div><div class="info-value" id="detail-currentAddress"></div></div>
                    <div class="col-md-6"><div class="info-label">Permanent Address</div><div class="info-value" id="detail-permanentAddress"></div></div>
                    <div class="col-md-4"><div class="info-label">City/Municipality</div><div class="info-value" id="detail-city"></div></div>
                    <div class="col-md-4"><div class="info-label">Province</div><div class="info-value" id="detail-province"></div></div>
                    <div class="col-md-4"><div class="info-label">ZIP Code</div><div class="info-value" id="detail-zipCode"></div></div>
                </div>
            </div>

            <!-- Employment Information -->
            <div class="form-section">
                <h4 class="section-title">Employment Information</h4>
                <div class="row">
                    <div class="col-md-6"><div class="info-label">Employment Status</div><div class="info-value" id="detail-employmentStatus"></div></div>
                    <div class="col-md-6"><div class="info-label">Monthly Income (PHP)</div><div class="info-value" id="detail-monthlyIncome"></div></div>
                    <div class="col-md-6"><div class="info-label">Employer/Business Name</div><div class="info-value" id="detail-employerName"></div></div>
                    <div class="col-md-6"><div class="info-label">Job Position</div><div class="info-value" id="detail-jobPosition"></div></div>
                    <div class="col-md-6"><div class="info-label">Duration of Employment/Business</div><div class="info-value" id="detail-workDuration"></div></div>
                    <div class="col-md-6"><div class="info-label">Work/Business Address</div><div class="info-value" id="detail-workAddress"></div></div>
                </div>
            </div>

            <!-- Loan Details -->
            <div class="form-section">
                <h4 class="section-title">Loan Details</h4>
                <div class="row">
                    <div class="col-md-6"><div class="info-label">Loan Amount (PHP)</div><div class="info-value" id="detail-loanAmount"></div></div>
                    <div class="col-md-6"><div class="info-label">Loan Purpose</div><div class="info-value" id="detail-loanPurpose"></div></div>
                    <div class="col-md-6"><div class="info-label">Preferred Loan Term</div><div class="info-value" id="detail-loanTerm"></div></div>
                    <div class="col-md-6"><div class="info-label">Preferred Payment Method</div><div class="info-value" id="detail-paymentMethod"></div></div>
                </div>
            </div>

            <!-- Documents Preview -->
            <div class="form-section">
                <h4 class="section-title">Submitted Documents</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-label">Primary Valid ID</div>
                        <div class="document-preview" id="document-valid_id_1">
                            <div class="document-info text-center">
                                <i class="fas fa-file-alt fa-3x text-muted"></i>
                                <div class="document-name" id="document-name-valid_id_1">No document uploaded</div>
                            </div>
                        </div>
                        <a href="#" id="download-valid_id_1" class="btn btn-primary mt-2 w-100 download-btn" target="_blank" style="display: none;">
                            <i class="fas fa-download"></i> Download Document
                        </a>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">Secondary Valid ID</div>
                        <div class="document-preview" id="document-valid_id_2">
                            <div class="document-info text-center">
                                <i class="fas fa-file-alt fa-3x text-muted"></i>
                                <div class="document-name" id="document-name-valid_id_2">No document uploaded</div>
                            </div>
                        </div>
                        <a href="#" id="download-valid_id_2" class="btn btn-primary mt-2 w-100 download-btn" target="_blank" style="display: none;">
                            <i class="fas fa-download"></i> Download Document
                        </a>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">Proof of Income</div>
                        <div class="document-preview" id="document-proof_of_income">
                            <div class="document-info text-center">
                                <i class="fas fa-file-alt fa-3x text-muted"></i>
                                <div class="document-name" id="document-name-proof_of_income">No document uploaded</div>
                            </div>
                        </div>
                        <a href="#" id="download-proof_of_income" class="btn btn-primary mt-2 w-100 download-btn" target="_blank" style="display: none;">
                            <i class="fas fa-download"></i> Download Document
                        </a>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">Proof of Billing</div>
                        <div class="document-preview" id="document-proof_of_billing">
                            <div class="document-info text-center">
                                <i class="fas fa-file-alt fa-3x text-muted"></i>
                                <div class="document-name" id="document-name-proof_of_billing">No document uploaded</div>
                            </div>
                        </div>
                        <a href="#" id="download-proof_of_billing" class="btn btn-primary mt-2 w-100 download-btn" target="_blank" style="display: none;">
                            <i class="fas fa-download"></i> Download Document
                        </a>
                    </div>
                </div>
            </div>

            <!-- Application Status -->
            <div class="form-section">
                <h4 class="section-title">Application Status</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-label">Status</div>
                        <div class="info-value">
                            <select class="status-select" id="applicationStatus">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">Submitted At</div>
                        <div class="info-value" id="detail-submittedAt"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="hideModal()">Close</button>
            <button type="button" class="btn btn-primary" id="saveStatusBtn" onclick="updateApplicationStatus()">Save Changes</button>
        </div>
    </div>
</div>

<script>
    // Global variable to store current application ID
    let currentApplicationId = null;

    // Modal functions
    function showModal() {
        document.getElementById('applicationModal').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function hideModal() {
        document.getElementById('applicationModal').classList.remove('show');
        document.body.style.overflow = '';
    }

    // Close modal when clicking outside
    document.getElementById('applicationModal').addEventListener('click', function(e) {
        if (e.target === this) hideModal();
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') hideModal();
    });

    // Update status in table row
    function updateStatus(selectElement, event) {
        event.stopPropagation();
        const applicationId = selectElement.getAttribute('data-application-id');
        const newStatus = selectElement.value;

        // Update UI immediately
        selectElement.className = 'status-select ' + newStatus;
        const row = selectElement.closest('tr');
        const statusBadge = row.querySelector('.status-badge');
        statusBadge.className = 'status-badge badge-' + newStatus;
        statusBadge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);

        // Send update to server
        fetch('update_status.php', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${encodeURIComponent(applicationId)}&status=${encodeURIComponent(newStatus)}`
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Refresh counts after successful update
                location.reload();
            } else {
                throw new Error(data.message || 'Failed to update status');
            }
        })
        .catch(error => {
            console.error('Error updating status:', error);
            alert('Error updating status: ' + error.message);
            // Revert UI changes on error
            selectElement.value = selectElement.dataset.previousValue;
        });
    }

    // Show application details in modal
    function showApplicationDetails(applicationId, event) {
        event.stopPropagation();
        currentApplicationId = applicationId;

        // Show loading state
        const modalLabel = document.getElementById('applicationModalLabel');
        modalLabel.textContent = 'Loading application details...';
        showModal();

        fetch('get_application_details.php?id=' + applicationId)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (!data || !data.success) {
                    throw new Error(data?.message || 'Invalid response format');
                }

                const application = data.data;

                // Update modal title
                modalLabel.textContent = `Loan Application #${applicationId} - ${application.first_name} ${application.last_name}`;

                // Helper function to safely display data
                function displayData(selector, value, prefix = '', suffix = '') {
                    const element = document.getElementById(selector);
                    if (element) {
                        element.textContent = value ? prefix + value + suffix : 'N/A';
                    }
                }

                // Personal Information
                displayData('detail-firstName', application.first_name);
                displayData('detail-middleName', application.middle_name);
                displayData('detail-lastName', application.last_name);
                displayData('detail-birthDate', application.birth_date);
                displayData('detail-civilStatus', application.civil_status);
                displayData('detail-email', application.email);
                displayData('detail-mobile', application.mobile);

                // Address Information
                displayData('detail-currentAddress', application.current_address);
                displayData('detail-permanentAddress', application.permanent_address);
                displayData('detail-city', application.city);
                displayData('detail-province', application.province);
                displayData('detail-zipCode', application.zip_code);

                // Employment Information
                displayData('detail-employmentStatus', application.employment_status);
                displayData('detail-monthlyIncome', application.monthly_income, '₱', application.monthly_income ? '.00' : '');
                displayData('detail-employerName', application.employer_name);
                displayData('detail-jobPosition', application.job_position);
                displayData('detail-workDuration', application.work_duration);
                displayData('detail-workAddress', application.work_address);

                // Loan Information
                displayData('detail-loanAmount', application.loan_amount, '₱', application.loan_amount ? '.00' : '');
                displayData('detail-loanPurpose', application.loan_purpose);
                displayData('detail-loanTerm', application.loan_term, '', ' months');
                displayData('detail-paymentMethod', application.payment_method);

                // Application Metadata
                if (document.getElementById('applicationStatus')) {
                    document.getElementById('applicationStatus').value = application.status || 'pending';
                }
                displayData('detail-submittedAt', application.submitted_at);

                // Handle document previews
                const documentTypes = ['valid_id_1', 'valid_id_2', 'proof_of_income', 'proof_of_billing'];
                documentTypes.forEach(type => {
                    const container = document.getElementById(`document-${type}`);
                    const nameElement = document.getElementById(`document-name-${type}`);
                    const downloadLink = document.getElementById(`download-${type}`);

                    if (application[type] && application[type].url) {
                        const fileUrl = application[type].url;
                        const fileName = application[type].name || 'Document';
                        const fileExt = (application[type].type || '').toLowerCase();

                        // Update name and download link
                        if (nameElement) nameElement.textContent = fileName;
                        if (downloadLink) {
                            downloadLink.href = fileUrl;
                            downloadLink.style.display = 'block';
                            downloadLink.setAttribute('download', fileName);
                        }

                        // Clear previous content
                        if (container) {
                            container.innerHTML = '';

                            // Handle different file types
                            if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExt)) {
                                // Image preview
                                const img = document.createElement('img');
                                img.src = fileUrl;
                                img.alt = fileName;
                                img.style.maxWidth = '100%';
                                img.style.maxHeight = '100%';
                                img.style.objectFit = 'contain';
                                img.onclick = () => window.open(fileUrl, '_blank');
                                container.appendChild(img);
                            } else if (fileExt === 'pdf') {
                                // PDF preview (using iframe)
                                const iframe = document.createElement('iframe');
                                iframe.src = `${fileUrl}#toolbar=0&navpanes=0`;
                                iframe.style.width = '100%';
                                iframe.style.height = '100%';
                                iframe.style.border = 'none';
                                container.appendChild(iframe);
                            } else {
                                // Generic file preview
                                const fileInfo = document.createElement('div');
                                fileInfo.className = 'document-info text-center';
                                fileInfo.innerHTML = `
                                    <i class="fas fa-file fa-3x text-muted"></i>
                                    <div class="document-name">${fileName}</div>
                                `;
                                container.appendChild(fileInfo);
                            }
                        }
                    } else {
                        // No document available
                        if (nameElement) nameElement.textContent = 'No document uploaded';
                        if (downloadLink) downloadLink.style.display = 'none';
                        if (container) {
                            container.innerHTML = `
                                <div class="document-info text-center">
                                    <i class="fas fa-file-alt fa-3x text-muted"></i>
                                    <div class="document-name">No document uploaded</div>
                                </div>
                            `;
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error loading application details:', error);
                modalLabel.textContent = 'Error Loading Application';
                alert('Error loading application details. Please try again.');
            });
    }

    // Update application status from modal
    function updateApplicationStatus() {
        if (!currentApplicationId) return;

        const newStatus = document.getElementById('applicationStatus').value;
        const saveBtn = document.getElementById('saveStatusBtn');
        const originalText = saveBtn.innerHTML;

        // Show loading state
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';

        fetch('update_status.php', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${currentApplicationId}&status=${newStatus}`
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Status updated successfully');
                location.reload();
            } else {
                throw new Error(data.message || 'Failed to update status');
            }
        })
        .catch(error => {
            console.error('Error updating status:', error);
            alert('Error updating status: ' + error.message);
        })
        .finally(() => {
            saveBtn.disabled = false;
            saveBtn.innerHTML = originalText;
        });
    }
</script>

<?php include 'footer.php'; ?>
</body>
</html>