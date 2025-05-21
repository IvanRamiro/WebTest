<?php include 'header.php'; ?>
<?php include 'config.php';?>

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
            --dark-blue:rgb(0, 0, 0);
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
            background-color:rgb(241, 255, 255);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border-top: 6px solid transparent;
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
            background-color: var(--secondary2);
            color: white;
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
            background-color: var(--secondary2);
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
            background-color: var(--primary);
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

        .table-container {
        max-height: 500px;
        overflow-y: auto;
        border-radius: 8px;
        margin-top: 15px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .table-container::-webkit-scrollbar {
        width: 10px;
        height: 8px;
    }

    .table-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .table-container::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .table-container::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    
    @media (max-width: 768px) {
    .table-container::-webkit-scrollbar {
        width: 0.8em;
        height: 0.8em;
    }
}
    </style>
</head>
<body>
    
<div class="dashboard-container">
    <?php
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->query("SELECT status, COUNT(*) as count FROM loan_application GROUP BY status");
        $statusCounts = ['pending' => 0, 'approved' => 0, 'rejected' => 0];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $statusCounts[strtolower($row['status'])] = $row['count'];
        }

        $pendingCount = $statusCounts['pending'];
        $approvedCount = $statusCounts['approved'];
        $rejectedCount = $statusCounts['rejected'];

        $total = $pendingCount + $approvedCount + $rejectedCount;
        $approvalRate = $total > 0 ? round(($approvedCount / $total) * 100, 1) : 0;
        $rejectionRate = $total > 0 ? round(($rejectedCount / $total) * 100, 1) : 0;
    } catch(PDOException $e) {
        $pendingCount = $approvedCount = $rejectedCount = 0;
        $approvalRate = $rejectionRate = 0;
    }
    ?>

    <!-- ========== STATUS CARDS SECTION ========== -->
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

 <!-- ========== RECENT APPLICATIONS TABLE ========== -->
<div class="recent-applications">
    <h2 class="section-title">Recent Applications</h2>
    <div class="table-container">
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

<!-- ========== APPLICATION DETAIL MODAL ========== -->
<div class="application-modal" id="applicationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="applicationModalLabel">Loan Application Details</h5>
            <button type="button" class="btn-close" onclick="hideModal()" aria-label="Close">×</button>
        </div>
        <div class="modal-body">
            <!-- Personal Information Section -->
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

            <!-- Address Information Section -->
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

            <!-- Employment Information Section -->
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

            <!-- Loan Details Section -->
            <div class="form-section">
                <h4 class="section-title">Loan Details</h4>
                <div class="row">
                    <div class="col-md-6"><div class="info-label">Loan Amount (PHP)</div><div class="info-value" id="detail-loanAmount"></div></div>
                    <div class="col-md-6"><div class="info-label">Loan Purpose</div><div class="info-value" id="detail-loanPurpose"></div></div>
                    <div class="col-md-6"><div class="info-label">Preferred Loan Term</div><div class="info-value" id="detail-loanTerm"></div></div>
                    <div class="col-md-6"><div class="info-label">Preferred Payment Method</div><div class="info-value" id="detail-paymentMethod"></div></div>
                </div>
            </div>

            <!-- Document Images Section -->
            <div class="form-section">
                <h4 class="section-title">Supporting Documents</h4>
                <div class="row">
                    <!-- Valid ID 1 -->
                    <div class="col-md-6 document-block" id="valid_id_1-container" style="display: none;">
                        <div class="info-label">Valid ID 1</div>
                        <div class="document-preview">
                            <img id="valid_id_1-img" src="" alt="Valid ID 1" class="img-fluid" style="max-height: 200px;">
                        </div>
                        <div class="text-center mt-2">
                            <a id="valid_id_1-download" href="#" class="download-btn" download target="_blank">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                    </div>

                    <!-- Valid ID 2 -->
                    <div class="col-md-6 document-block" id="valid_id_2-container" style="display: none;">
                        <div class="info-label">Valid ID 2</div>
                        <div class="document-preview">
                            <img id="valid_id_2-img" src="" alt="Valid ID 2" class="img-fluid" style="max-height: 200px;">
                        </div>
                        <div class="text-center mt-2">
                            <a id="valid_id_2-download" href="#" class="download-btn" download target="_blank">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                    </div>

                    <!-- Proof of Income -->
                    <div class="col-md-6 document-block" id="proof_of_income-container" style="display: none;">
                        <div class="info-label">Proof of Income</div>
                        <div class="document-preview">
                            <img id="proof_of_income-img" src="" alt="Proof of Income" class="img-fluid" style="max-height: 200px;">
                        </div>
                        <div class="text-center mt-2">
                            <a id="proof_of_income-download" href="#" class="download-btn" download target="_blank">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                    </div>

                    <!-- Proof of Billing -->
                    <div class="col-md-6 document-block" id="proof_of_billing-container" style="display: none;">
                        <div class="info-label">Proof of Billing</div>
                        <div class="document-preview">
                            <img id="proof_of_billing-img" src="" alt="Proof of Billing" class="img-fluid" style="max-height: 200px;">
                        </div>
                        <div class="text-center mt-2">
                            <a id="proof_of_billing-download" href="#" class="download-btn" download target="_blank">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Status Section -->
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

<!-- ========== JAVASCRIPT FUNCTIONS ========== -->
<script>
    let currentApplicationId = null;

    // ========== MODAL FUNCTIONS ==========
    function showModal() {
        document.getElementById('applicationModal').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function hideModal() {
        document.getElementById('applicationModal').classList.remove('show');
        document.body.style.overflow = '';
    }

    document.getElementById('applicationModal').addEventListener('click', function(e) {
        if (e.target === this) hideModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') hideModal();
    });

    // ========== APPLICATION STATUS FUNCTIONS ==========
    function updateStatus(selectElement, event) {
        event.stopPropagation();
        const applicationId = selectElement.getAttribute('data-application-id');
        const newStatus = selectElement.value;

        selectElement.className = 'status-select ' + newStatus;
        const row = selectElement.closest('tr');
        const statusBadge = row.querySelector('.status-badge');
        statusBadge.className = 'status-badge badge-' + newStatus;
        statusBadge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);

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
                location.reload();
            } else {
                throw new Error(data.message || 'Failed to update status');
            }
        })
        .catch(error => {
            console.error('Error updating status:', error);
            alert('Error updating status: ' + error.message);
            selectElement.value = selectElement.dataset.previousValue;
        });
    }

    // ========== APPLICATION DETAILS FUNCTIONS ==========
    function showApplicationDetails(id) {
    currentApplicationId = id;
    
    fetch(`get_application_details.php?id=${id}`)
        .then(res => res.json())
        .then(response => {
            if (response.success && response.data) {
                const data = response.data;

                // Personal Information
                document.getElementById('detail-firstName').textContent = data.first_name;
                document.getElementById('detail-middleName').textContent = data.middle_name || 'N/A';
                document.getElementById('detail-lastName').textContent = data.last_name;
                document.getElementById('detail-birthDate').textContent = data.birth_date;
                document.getElementById('detail-civilStatus').textContent = data.civil_status;
                document.getElementById('detail-email').textContent = data.email;
                document.getElementById('detail-mobile').textContent = data.mobile;
                
                // Address Information
                document.getElementById('detail-currentAddress').textContent = data.current_address;
                document.getElementById('detail-permanentAddress').textContent = data.permanent_address;
                document.getElementById('detail-city').textContent = data.city;
                document.getElementById('detail-province').textContent = data.province;
                document.getElementById('detail-zipCode').textContent = data.zip_code;
                
                // Employment Information - UPDATED SECTION
                document.getElementById('detail-employmentStatus').textContent = data.employment_status_display;
                document.getElementById('detail-monthlyIncome').textContent = '₱' + data.monthly_income;
                document.getElementById('detail-employerName').textContent = data.employer_name_display;
                document.getElementById('detail-jobPosition').textContent = data.job_position || 'N/A';
                document.getElementById('detail-workDuration').textContent = data.work_duration || 'N/A';
                document.getElementById('detail-workAddress').textContent = data.work_address || 'N/A';
                
                // Loan Information
                document.getElementById('detail-loanAmount').textContent = '₱' + data.loan_amount;
                document.getElementById('detail-loanPurpose').textContent = data.loan_purpose;
                document.getElementById('detail-loanTerm').textContent = data.loan_term;
                document.getElementById('detail-paymentMethod').textContent = data.payment_method;
                document.getElementById('detail-submittedAt').textContent = data.submitted_at;
                document.getElementById('applicationStatus').value = data.status;

                // Documents
                updateDocumentDisplay('valid_id_1', data.valid_id_1_url);
                updateDocumentDisplay('valid_id_2', data.valid_id_2_url);
                updateDocumentDisplay('proof_of_income', data.proof_of_income_url);
                updateDocumentDisplay('proof_of_billing', data.proof_of_billing_url);

                showModal();
            } else {
                alert(response.message || 'Failed to load application details.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('An error occurred while fetching application details.');
        });
}

    function updateDocumentDisplay(docType, fileUrl) {
        const container = document.getElementById(`${docType}-container`);
        const imgElement = document.getElementById(`${docType}-img`);
        const downloadLink = document.getElementById(`${docType}-download`);

        if (fileUrl) {
            container.style.display = 'block';
            imgElement.src = fileUrl;
            downloadLink.href = fileUrl;
            downloadLink.download = fileUrl.split('/').pop();
            
            imgElement.onclick = function() {
                window.open(fileUrl, '_blank');
            };
        } else {
            container.style.display = 'none';
        }
    }

    // ========== STATUS UPDATE FUNCTION ==========
    function updateApplicationStatus() {
        if (!currentApplicationId) return;

        const newStatus = document.getElementById('applicationStatus').value;
        const saveBtn = document.getElementById('saveStatusBtn');
        const originalText = saveBtn.innerHTML;

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