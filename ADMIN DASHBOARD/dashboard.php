<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOAN MANAGEMENT DASHBOARD</title>
    
    <!-- ==================== STYLES & SCRIPTS ==================== -->
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        /* Main Dashboard Layout */
        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        /* Stat Card Styles */
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            height: 180px;
            display: flex;
            flex-direction: column;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            z-index: 2;
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
            margin: 5px 0;
            z-index: 2;
        }
        
        .card-title {
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            z-index: 2;
        }
        
        .card-footer {
            margin-top: auto;
            font-size: 12px;
            color: #888;
            display: flex;
            align-items: center;
            z-index: 2;
        }
        
        /* Chart Integration in Loans Issued Card */
        .loans-issued {
            position: relative;
            grid-column: span 2;
            height: 300px;
        }
        
        .loans-issued .chart-container {
            position: absolute;
            bottom: 15px;
            left: 15px;
            right: 15px;
            height: 150px;
            opacity: 0.8;
            transition: opacity 0.3s;
        }
        
        .loans-issued:hover .chart-container {
            opacity: 1;
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
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
            
            .loans-issued {
                grid-column: span 1;
                height: 250px;
            }
            
            .card-value {
                font-size: 24px;
            }
            
            .card-title {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <!-- ==================== DASHBOARD CONTAINER ==================== -->
    <div class="dashboard-container">
        
        <!-- Total Loans Issued (With Chart) -->
        <div class="stat-card loans-issued">
            <div class="card-header">
                <span class="card-title">Total Loans Issued</span>
                <div class="card-icon"><i class="fas fa-file-invoice"></i></div>
            </div>
            <div class="card-value">1,024</div>
            <div class="card-footer">
                <i class="fas fa-calendar-alt mr-2"></i> All time
            </div>
            <div class="chart-container">
                <canvas id="loansChart"></canvas>
            </div>
        </div>
        
        <!-- Total Amount Lent -->
        <div class="stat-card amount-lent">
            <div class="card-header">
                <span class="card-title">Total Amount Lent</span>
                <div class="card-icon"><i class="fas fa-hand-holding-usd"></i></div>
            </div>
            <div class="card-value">$248,750</div>
            <div class="card-footer">
                <i class="fas fa-chart-line mr-2"></i> 12% from last month
            </div>
        </div>
        
        <!-- Upcoming Payments -->
        <div class="stat-card upcoming">
            <div class="card-header">
                <span class="card-title">Upcoming Payments</span>
                <div class="card-icon"><i class="fas fa-calendar-week"></i></div>
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
                <div class="card-icon"><i class="fas fa-clock"></i></div>
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
                <div class="card-icon"><i class="fas fa-exclamation-triangle"></i></div>
            </div>
            <div class="card-value">23</div>
            <div class="card-footer">
                <i class="fas fa-ban mr-2"></i> Over 30 days late
            </div>
        </div>
    </div>

    <!-- ==================== CHART SCRIPT ==================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loansCtx = document.getElementById('loansChart').getContext('2d');
            const loansChart = new Chart(loansCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Loans Issued',
                        data: [85, 112, 94, 106, 128, 115, 97],
                        backgroundColor: 'rgba(78, 115, 223, 0.05)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                        pointHoverBorderColor: '#fff',
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: { size: 12 },
                            bodyFont: { size: 11 },
                            callbacks: {
                                label: function(context) {
                                    return 'Loans: ' + context.parsed.y;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { color: '#858796', font: { size: 10 } }
                        },
                        y: {
                            display: false,
                            grid: { display: false, drawBorder: false }
                        }
                    }
                }
            });

            // Animate Cards
            const cards = document.querySelectorAll('.stat-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100 * index);
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            });
        });
    </script>

    <script src="dashboard.js"></script>
</body>
</html>
<?php include 'footer.php'; ?>