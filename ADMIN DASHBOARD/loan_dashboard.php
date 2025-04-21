<?php include 'header.php'; ?>
<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Dashboard</title>
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
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            padding: 25px;
            max-width: 1400px;
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

        .recent-customers {
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

        .customer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .customer-card {
            display: flex;
            align-items: center;
            padding: 15px;
            border-radius: 8px;
            background: #f9f9f9;
            transition: all 0.3s ease;
            position: relative;
        }

        .customer-card:hover {
            background: #f0f0f0;
            transform: translateX(5px);
        }

        .customer-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .customer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .customer-info h4 {
            margin: 0;
            font-size: 16px;
            color: var(--dark-blue);
        }

        .customer-info p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #666;
        }

        .status-dropdown {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .status-select {
            padding: 5px 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 12px;
            cursor: pointer;
            background: white;
        }

        .status-pending {
            color: var(--pending);
            border-color: var(--pending);
        }

        .status-approved {
            color: var(--approved);
            border-color: var(--approved);
        }

        .status-rejected {
            color: var(--rejected);
            border-color: var(--rejected);
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 5px;
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

        @media (max-width: 768px) {
            .card-value {
                font-size: 36px;
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

        <div class="recent-customers">
            <h2 class="section-title">Recent Applications</h2>
            <div class="customer-grid">
                <?php
                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $pdo->query("
                        SELECT id, first_name, last_name, city, province, submitted_at, status 
                        FROM loan_application 
                        ORDER BY submitted_at DESC 
                        LIMIT 6
                    ");

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // Determine status class
                        $statusClass = '';
                        $badgeClass = '';
                        switch(strtolower($row['status'])) {
                            case 'approved':
                                $statusClass = 'status-approved';
                                $badgeClass = 'badge-approved';
                                break;
                            case 'rejected':
                                $statusClass = 'status-rejected';
                                $badgeClass = 'badge-rejected';
                                break;
                            default:
                                $statusClass = 'status-pending';
                                $badgeClass = 'badge-pending';
                        }
                        
                        echo '
                        <div class="customer-card">
                            <div class="customer-avatar">
                                <img src="../Images/user_placeholder.png" alt="'.htmlspecialchars($row['first_name']).'">
                            </div>
                            <div class="customer-info">
                                <h4>'.htmlspecialchars($row['first_name'].' '.$row['last_name']).'</h4>
                                <p>'.htmlspecialchars($row['city']).', '.htmlspecialchars($row['province']).'</p>
                                <span class="status-badge '.$badgeClass.'">'.ucfirst($row['status']).'</span>
                            </div>
                            <div class="status-dropdown">
                                <select class="status-select '.$statusClass.'" data-application-id="'.$row['id'].'" onchange="updateStatus(this)">
                                    <option value="pending" '.($row['status'] == 'pending' ? 'selected' : '').'>Pending</option>
                                    <option value="approved" '.($row['status'] == 'approved' ? 'selected' : '').'>Approved</option>
                                    <option value="rejected" '.($row['status'] == 'rejected' ? 'selected' : '').'>Rejected</option>
                                </select>
                            </div>
                        </div>';
                    }
                } catch(PDOException $e) {
                    echo "<div class='error'>Error fetching customers: " . $e->getMessage() . "</div>";
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        function updateStatus(selectElement) {
            const applicationId = selectElement.getAttribute('data-application-id');
            const newStatus = selectElement.value;
            
            // Update the class to reflect new status
            selectElement.className = 'status-select status-' + newStatus;
            
            // Find the status badge in the same card and update it
            const card = selectElement.closest('.customer-card');
            const statusBadge = card.querySelector('.status-badge');
            
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
    </script>

    <?php include 'footer.php'; ?>
</body>
</html>