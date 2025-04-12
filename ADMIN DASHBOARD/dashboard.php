<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOAN MANAGEMENT DASHBOARD</title>

    <!-- ==================== STYLES ==================== -->
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        /* Enhanced Card Styles */
        .dashboard-container {
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
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
        }
        
        .card-value {
            font-size: 28px;
            font-weight: 700;
            margin: 10px 0;
        }
        
        .card-title {
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .card-footer {
            margin-top: 15px;
            font-size: 12px;
            color: #888;
            display: flex;
            align-items: center;
        }
        
        /* Card-specific colors */
        .loans-issued { border-left: 4px solid #4e73df; }
        .loans-issued .card-icon { background: #4e73df; }
        
        .amount-lent { border-left: 4px solid #1cc88a; }
        .amount-lent .card-icon { background: #1cc88a; }
        
        .pending { border-left: 4px solid #f6c23e; }
        .pending .card-icon { background: #f6c23e; }
        
        .approved { border-left: 4px solid #36b9cc; }
        .approved .card-icon { background: #36b9cc; }
        
        .rejected { border-left: 4px solid #e74a3b; }
        .rejected .card-icon { background: #e74a3b; }
        
        .upcoming { border-left: 4px solid #5a5c69; }
        .upcoming .card-icon { background: #5a5c69; }
        
        .due-today { border-left: 4px solid #fd7e14; }
        .due-today .card-icon { background: #fd7e14; }
        
        .delinquent { border-left: 4px solid #be2617; }
        .delinquent .card-icon { background: #be2617; }
    </style>
</head>
<body>

    <!-- ==================== ENHANCED LOAN STATS CARDS ==================== -->
    <div class="dashboard-container">
        <!-- Total Loans Issued -->
        <div class="stat-card loans-issued">
            <div class="card-header">
                <span class="card-title">Total Loans Issued</span>
                <div class="card-icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
            </div>
            <div class="card-value">1,024</div>
            <div class="card-footer">
                <i class="fas fa-calendar-alt mr-2"></i> All time
            </div>
        </div>
        
        <!-- Total Amount Lent -->
        <div class="stat-card amount-lent">
            <div class="card-header">
                <span class="card-title">Total Amount Lent</span>
                <div class="card-icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
            </div>
            <div class="card-value">$248,750</div>
            <div class="card-footer">
                <i class="fas fa-chart-line mr-2"></i> 12% from last month
            </div>
        </div>
        
        <!-- Pending Applications -->
        <div class="stat-card pending">
            <div class="card-header">
                <span class="card-title">Pending Applications</span>
                <div class="card-icon">
                    <i class="fas fa-sync-alt"></i>
                </div>
            </div>
            <div class="card-value">87</div>
            <div class="card-footer">
                <i class="fas fa-clock mr-2"></i> Awaiting review
            </div>
        </div>
        
        <!-- Approved Applications -->
        <div class="stat-card approved">
            <div class="card-header">
                <span class="card-title">Approved Applications</span>
                <div class="card-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="card-value">892</div>
            <div class="card-footer">
                <i class="fas fa-thumbs-up mr-2"></i> 85% approval rate
            </div>
        </div>
        
        <!-- Rejected Applications -->
        <div class="stat-card rejected">
            <div class="card-header">
                <span class="card-title">Rejected Applications</span>
                <div class="card-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
            <div class="card-value">132</div>
            <div class="card-footer">
                <i class="fas fa-exclamation-triangle mr-2"></i> 12.6% rejection rate
            </div>
        </div>
        
        <!-- Upcoming Payments -->
        <div class="stat-card upcoming">
            <div class="card-header">
                <span class="card-title">Upcoming Payments</span>
                <div class="card-icon">
                    <i class="fas fa-calendar-week"></i>
                </div>
            </div>
            <div class="card-value">56</div>
            <div class="card-footer">
                <i class="fas fa-arrow-up mr-2"></i> Next 7 days
            </div>
        </div>
        
        <!-- Due Today -->
        <div class="stat-card due-today">
            <div class="card-header">
                <span class="card-title">Due Today</span>
                <div class="card-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="card-value">12</div>
            <div class="card-footer">
                <i class="fas fa-bell mr-2"></i> Needs immediate attention
            </div>
        </div>
        
        <!-- Delinquent Loans -->
        <div class="stat-card delinquent">
            <div class="card-header">
                <span class="card-title">Delinquent Loans</span>
                <div class="card-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
            <div class="card-value">23</div>
            <div class="card-footer">
                <i class="fas fa-ban mr-2"></i> Over 30 days late
            </div>
        </div>
    </div>

    <!-- ==================== SCRIPTS ==================== -->
    <script src="dashboard.js"></script>
</body>
</html>