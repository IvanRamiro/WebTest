<?php include 'header.php'; ?>
<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan</title>
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
            background-color:rgb(147, 201, 255);
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

        /* Application Detail Modal */
        .application-modal .modal-content {
            border-radius: 12px;
            overflow: hidden;
        }

        .application-modal .modal-header {
            background-color: #dc3545;
            color: white;
            border-bottom: none;
            padding: 1.5rem;
        }

        .application-modal .modal-title {
            font-weight: 600;
        }

        .application-modal .modal-body {
            padding: 2rem;
        }

        .application-modal .form-section {
            margin-bottom: 2rem;
        }

        .application-modal .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #eee;
        }

        .application-modal .info-label {
            font-weight: 600;
            color: #555;
        }

        .application-modal .info-value {
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
            margin-bottom: 1rem;
        }

        .application-modal .document-preview {
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
        }

        .application-modal .document-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
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
        }

            .application-modal .modal-body {
                max-height: 70vh;
                overflow-y: auto;
                padding: 20px;
        }

        @media (max-width: 992px) {
            .application-modal .modal-dialog {
                max-width: 95%;
                margin: 10px auto;
        }
        
            .application-modal .modal-body {
            max-height: 65vh;
        }
        }

            @media (max-width: 768px) {
            .application-modal .modal-body {
            padding: 15px;
        }
        
        .application-modal .row > div {
            margin-bottom: 10px;
        }
        
        .application-modal .info-label {
            font-size: 14px;
        }
        
        .application-modal .info-value {
            font-size: 14px;
        }
    }

    @media (max-width: 576px) {
        .application-modal .modal-body {
            max-height: 60vh;
            padding: 10px;
        }
        
        .application-modal .section-title {
            font-size: 18px;
            margin-bottom: 15px;
        }
        
        .document-preview {
            height: 150px;
        }
    }

    .application-modal .modal-body::-webkit-scrollbar {
        width: 8px;
    }

    .application-modal .modal-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .application-modal .modal-body::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .application-modal .modal-body::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    @media (max-width: 768px) {
        .document-preview {
            height: 120px;
            margin-bottom: 10px;
        }
    }
    </style>
</head>
<body>
    
<div class="dashboard-container">
    <?php
    // Get counts for each status
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Pending count
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM loan_application WHERE status = 'pending'");
        $pendingCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

        // Approved count
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM loan_application WHERE status = 'approved'");
        $approvedCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

        // Rejected count
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM loan_application WHERE status = 'rejected'");
        $rejectedCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

        // Calculate percentages
        $total = $pendingCount + $approvedCount + $rejectedCount;
        $approvalRate = $total > 0 ? round(($approvedCount / $total) * 100, 1) : 0;
        $rejectionRate = $total > 0 ? round(($rejectedCount / $total) * 100, 1) : 0;
    } catch(PDOException $e) {
        $pendingCount = 0;
        $approvedCount = 0;
        $rejectedCount = 0;
        $approvalRate = 0;
        $rejectionRate = 0;
    }
    ?>

    <div class="stat-card pending">
        <div class="card-header">
            <span class="card-title">Pending Applications</span>
            <div class="card-icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
        <div class="card-value"><?php echo $pendingCount; ?></div>
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
        <div class="card-value"><?php echo $approvedCount; ?></div>
        <div class="card-footer">
            <i class="fas fa-chart-line"></i> <?php echo $approvalRate; ?>% approval rate
        </div>
    </div>

    <div class="stat-card rejected">
        <div class="card-header">
            <span class="card-title">Rejected Applications</span>
            <div class="card-icon">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
        <div class="card-value"><?php echo $rejectedCount; ?></div>
        <div class="card-footer">
            <i class="fas fa-exclamation-triangle"></i> <?php echo $rejectionRate; ?>% rejection rate
        </div>
    </div>

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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $pdo->query("
                        SELECT id, first_name, last_name, loan_amount, loan_purpose, submitted_at, status 
                        FROM loan_application 
                        ORDER BY submitted_at DESC 
                        LIMIT 10
                    ");

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // Determine status class
                        $statusClass = strtolower($row['status']);
                        $badgeClass = 'badge-' . $statusClass;
                        
                        echo '
                        <tr>
                            <td>#' . htmlspecialchars($row['id']) . '</td>
                            <td>' . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . '</td>
                            <td>₱' . number_format($row['loan_amount'], 2) . '</td>
                            <td>' . htmlspecialchars($row['loan_purpose']) . '</td>
                            <td>' . htmlspecialchars($row['submitted_at']) . '</td>
                            <td>
                                <span class="status-badge ' . $badgeClass . '">' . ucfirst($row['status']) . '</span>
                            </td>
                            <td>
                                <select class="status-select ' . $statusClass . '" data-application-id="' . $row['id'] . '" onchange="updateStatus(this, event)">
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
                    echo '<tr><td colspan="7" class="text-center">Error fetching applications: ' . $e->getMessage() . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Application Detail Modal -->
<div class="modal fade application-modal" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="applicationModalLabel">Loan Application Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-section">
                    <h4 class="section-title">Personal Information</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info-label">First Name</div>
                            <div class="info-value" id="detail-firstName"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">Middle Name</div>
                            <div class="info-value" id="detail-middleName"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">Last Name</div>
                            <div class="info-value" id="detail-lastName"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Date of Birth</div>
                            <div class="info-value" id="detail-birthDate"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Civil Status</div>
                            <div class="info-value" id="detail-civilStatus"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Email Address</div>
                            <div class="info-value" id="detail-email"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Mobile Number</div>
                            <div class="info-value" id="detail-mobile"></div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4 class="section-title">Address Information</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Current Address</div>
                            <div class="info-value" id="detail-currentAddress"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Permanent Address</div>
                            <div class="info-value" id="detail-permanentAddress"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">City/Municipality</div>
                            <div class="info-value" id="detail-city"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">Province</div>
                            <div class="info-value" id="detail-province"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">ZIP Code</div>
                            <div class="info-value" id="detail-zipCode"></div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4 class="section-title">Employment Information</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Employment Status</div>
                            <div class="info-value" id="detail-employmentStatus"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Monthly Income (PHP)</div>
                            <div class="info-value" id="detail-monthlyIncome"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Employer/Business Name</div>
                            <div class="info-value" id="detail-employerName"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Job Position</div>
                            <div class="info-value" id="detail-jobPosition"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Duration of Employment/Business</div>
                            <div class="info-value" id="detail-workDuration"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Work/Business Address</div>
                            <div class="info-value" id="detail-workAddress"></div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4 class="section-title">Loan Details</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Loan Amount (PHP)</div>
                            <div class="info-value" id="detail-loanAmount"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Loan Purpose</div>
                            <div class="info-value" id="detail-loanPurpose"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Preferred Loan Term</div>
                            <div class="info-value" id="detail-loanTerm"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Preferred Payment Method</div>
                            <div class="info-value" id="detail-paymentMethod"></div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4 class="section-title">Documents</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Primary Valid ID</div>
                            <div class="document-preview" id="document-validId1">
                                <i class="fas fa-file-alt fa-3x text-muted"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Secondary Valid ID</div>
                            <div class="document-preview" id="document-validId2">
                                <i class="fas fa-file-alt fa-3x text-muted"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Proof of Income</div>
                            <div class="document-preview" id="document-proofOfIncome">
                                <i class="fas fa-file-alt fa-3x text-muted"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Proof of Billing</div>
                            <div class="document-preview" id="document-proofOfBilling">
                                <i class="fas fa-file-alt fa-3x text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4 class="section-title">Application Status</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Status</div>
                            <div class="info-value">
                                <select class="form-select" id="applicationStatus" onchange="updateApplicationStatus()">
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveStatusBtn" onclick="updateApplicationStatus()">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function updateStatus(selectElement, event) {
        event.stopPropagation();
        const applicationId = selectElement.getAttribute('data-application-id');
        const newStatus = selectElement.value;
        
        // Update the class to reflect new status
        selectElement.className = 'status-select ' + newStatus;
        
        // Find the status badge in the same row and update it
        const row = selectElement.closest('tr');
        const statusBadge = row.querySelector('.status-badge');
        
        // Remove all badge classes and add the new one
        statusBadge.className = 'status-badge badge-' + newStatus;
        statusBadge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
        
        // Send AJAX request to update status in database
        fetch('update_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id=' + encodeURIComponent(applicationId) + '&status=' + encodeURIComponent(newStatus)
        })
        .then(response => response.text())
        .then(data => {
            console.log('Status updated:', data);
            // Reload the page to update the counts
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function showApplicationDetails(applicationId, event) {
        event.stopPropagation();
        
        // Create a hidden button to trigger the modal
        const button = document.createElement('button');
        button.setAttribute('data-application-id', applicationId);
        button.setAttribute('data-bs-toggle', 'modal');
        button.setAttribute('data-bs-target', '#applicationModal');
        button.style.display = 'none';
        
        // Add it to the body and click it
        document.body.appendChild(button);
        button.click();
        document.body.removeChild(button);
    }

    // When modal is shown, fetch the application details
    document.getElementById('applicationModal').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const applicationId = button.getAttribute('data-application-id');
        
        // Fetch application details via AJAX
        fetch('get_application_details.php?id=' + applicationId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Populate the modal with data
                    document.getElementById('applicationModalLabel').textContent = 
                        `Loan Application #${applicationId} - ${data.data.first_name} ${data.data.last_name}`;
                    
                    // Personal Information
                    document.getElementById('detail-firstName').textContent = data.data.first_name;
                    document.getElementById('detail-middleName').textContent = data.data.middle_name || 'N/A';
                    document.getElementById('detail-lastName').textContent = data.data.last_name;
                    document.getElementById('detail-birthDate').textContent = data.data.birth_date || 'N/A';
                    document.getElementById('detail-civilStatus').textContent = data.data.civil_status || 'N/A';
                    document.getElementById('detail-email').textContent = data.data.email || 'N/A';
                    document.getElementById('detail-mobile').textContent = data.data.mobile || 'N/A';
                    
                    // Address Information
                    document.getElementById('detail-currentAddress').textContent = data.data.current_address || 'N/A';
                    document.getElementById('detail-permanentAddress').textContent = data.data.permanent_address || 'N/A';
                    document.getElementById('detail-city').textContent = data.data.city || 'N/A';
                    document.getElementById('detail-province').textContent = data.data.province || 'N/A';
                    document.getElementById('detail-zipCode').textContent = data.data.zip_code || 'N/A';
                    
                    // Employment Information
                    document.getElementById('detail-employmentStatus').textContent = data.data.employment_status || 'N/A';
                    document.getElementById('detail-monthlyIncome').textContent = data.data.monthly_income ? '₱' + parseFloat(data.data.monthly_income).toLocaleString() : 'N/A';
                    document.getElementById('detail-employerName').textContent = data.data.employer_name || 'N/A';
                    document.getElementById('detail-jobPosition').textContent = data.data.job_position || 'N/A';
                    document.getElementById('detail-workDuration').textContent = data.data.work_duration || 'N/A';
                    document.getElementById('detail-workAddress').textContent = data.data.work_address || 'N/A';
                    
                    // Loan Details
                    document.getElementById('detail-loanAmount').textContent = data.data.loan_amount ? '₱' + parseFloat(data.data.loan_amount).toLocaleString() : 'N/A';
                    document.getElementById('detail-loanPurpose').textContent = data.data.loan_purpose || 'N/A';
                    document.getElementById('detail-loanTerm').textContent = data.data.loan_term || 'N/A';
                    document.getElementById('detail-paymentMethod').textContent = data.data.payment_method || 'N/A';
                    
                    // Application Info
                    document.getElementById('applicationStatus').value = data.data.status || 'pending';
                    document.getElementById('detail-submittedAt').textContent = data.data.submitted_at || 'N/A';
                    
                    // Load documents if available
                    loadDocumentPreview('validId1', data.data.valid_id1);
                    loadDocumentPreview('validId2', data.data.valid_id2);
                    loadDocumentPreview('proofOfIncome', data.data.proof_of_income);
                    loadDocumentPreview('proofOfBilling', data.data.proof_of_billing);
                    
                    // Store the current application ID
                    document.getElementById('saveStatusBtn').setAttribute('data-application-id', applicationId);
                } else {
                    alert('Error loading application details: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error loading application details');
            });
    });
    
    function loadDocumentPreview(fieldName, filePath) {
        const container = document.getElementById('document-' + fieldName);
        if (filePath) {
            // Check if it's an image
            const imageExtensions = ['.jpg', '.jpeg', '.png', '.gif'];
            const isImage = imageExtensions.some(ext => filePath.toLowerCase().endsWith(ext));
            
            if (isImage) {
                container.innerHTML = `<img src="uploads/${filePath}" alt="${fieldName}">`;
            } else {
                // It's a PDF or other document
                container.innerHTML = `
                    <div class="text-center">
                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                        <p class="mt-2">PDF Document</p>
                        <a href="uploads/${filePath}" target="_blank" class="btn btn-sm btn-primary">View</a>
                    </div>
                `;
            }
        } else {
            container.innerHTML = '<i class="fas fa-file-alt fa-3x text-muted"></i>';
        }
    }
    
    function updateApplicationStatus() {
        const applicationId = document.getElementById('saveStatusBtn').getAttribute('data-application-id');
        const newStatus = document.getElementById('applicationStatus').value;
        
        fetch('update_application_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${applicationId}&status=${newStatus}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Status updated successfully');
                location.reload();
            } else {
                alert('Error updating status: ' + data.message);
            }      
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating status');
        });
    }
</script>

<?php include 'footer.php'; ?>
</body>
</html>