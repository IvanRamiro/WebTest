<?php include 'header.php'; ?>
<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOAN MANAGEMENT DASHBOARD</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .dashboard-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
        }

        .calendar-container {
            background: var(--white);
            border-radius: var(--radius);
            padding: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .calendar-header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(77, 35, 121, 0.1);
        }

        .calendar-icon {
            font-size: 1.5rem;
            color: var(--primary);
            animation: pulse 2s infinite;
        }

        .calendar-header-text {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
            position: relative;
            display: inline-block;
            animation: colorShift 3s infinite alternate;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .calendar-nav {
            display: flex;
            gap: 8px;
        }

        .calendar-nav button {
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all var(--transition-fast);
        }

        .calendar-nav button:hover {
            background: var(--secondary);
            color: var(--black1);
            transform: scale(1.1);
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .calendar-day-header {
            text-align: center;
            font-weight: 600;
            color: var(--primary);
            padding: 5px;
            font-size: 0.8rem;
        }

        .calendar-day {
            aspect-ratio: 1;
            background: var(--gray);
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 5px;
            position: relative;
            transition: all var(--transition-fast);
            font-size: 0.8rem;
            cursor: pointer;
            overflow: visible;
        }

        .calendar-day:hover {
            background: var(--secondary2);
            transform: translateY(-3px);
        }

        .calendar-day.empty {
            background: transparent;
            pointer-events: none;
        }

        .calendar-day-number {
            font-weight: 600;
            margin-bottom: 2px;
        }

        .calendar-day-today {
            background: var(--primary);
            color: var(--white);
        }

        .calendar-day-today:hover {
            background: var(--primary2);
        }
        
        .calendar-day.active-day {
            box-shadow: 0 0 0 2px var(--secondary);
            border: 2px solid var(--white);
        }
        .application-badge {
            position: absolute;
            top: -3px;
            right: -3px;
            background: var(--secondary);
            color: var(--black1);
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            font-weight: bold;
        }

        .recent-applications {
        background: var(--white);
        border-radius: var(--radius);
        padding: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .applications-title {
        color: var(--primary);
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .applications-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .application-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: rgb(241, 255, 255);
        border-radius: 6px;
        position: relative; /* For divider positioning */
    }

    .application-item:not(:last-child)::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 10px;
        right: 10px;
        height: 1px;
        background-color: rgba(0, 0, 0, 0.1);
    }

    .application-item:hover {
        background: var(--secondary2);
        transform: translateX(5px);
    }

    .applicant-name {
        font-weight: 600;
        color: var(--primary);
    }

    .application-date {
        color: var(--black2);
        font-size: 0.8rem;
    }

    .recent-loading {
        display: none;
        text-align: center;
        padding: 20px;
        color: var(--black2);
    }

        /* Statistics Section Styles */
        .statistics-container {
            grid-column: 1 / -1;
            background: var(--white);
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-top: 20px;
        }

        .statistics-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(77, 35, 121, 0.1);
        }

        .statistics-header i {
            color: var(--primary);
            margin-right: 10px;
            font-size: 1.5rem;
        }

        .statistics-header h2 {
            color: var(--primary);
            font-size: 1.3rem;
            margin: 0;
        }

        .chart-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .chart-card {
            background: var(--gray);
            border-radius: var(--radius);
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .chart-card h3 {
            color: var(--primary);
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes colorShift {
            0% { color: var(--primary); }
            25% { color: #5a189a; }
            50% { color: #7b2cbf; }
            75% { color: #9d4edd; }
            100% { color: var(--secondary); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .calendar-header-text {
                font-size: 1.1rem;
            }
            
            .calendar-icon {
                font-size: 1.2rem;
            }
            
            .calendar-day-header,
            .calendar-day {
                font-size: 0.7rem;
            }
            
            .applicant-name {
                font-size: 0.9rem;
            }
            
            .application-date {
                font-size: 0.7rem;
            }

            .chart-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        
        <div class="calendar-container">
            <div class="calendar-header-container">
                <i class="fas fa-calendar-alt calendar-icon"></i>
                <h2 class="calendar-header-text">CALENDAR</h2>
            </div>
            
            <?php
            $month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
            $year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
            $selectedDay = isset($_GET['day']) ? (int)$_GET['day'] : date('j');

            $month = max(1, min(12, $month));
            $year = max(2020, min(2100, $year));
            $selectedDay = max(1, min(31, $selectedDay));
            
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $firstDay = date('N', strtotime("$year-$month-01"));
            $today = date('j');
            $currentMonth = date('n');
            $currentYear = date('Y');
            
            try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                $stmt = $pdo->prepare("
                    SELECT DAY(submitted_at) as day, COUNT(*) as count 
                    FROM loan_application 
                    WHERE MONTH(submitted_at) = :month AND YEAR(submitted_at) = :year 
                    GROUP BY DAY(submitted_at)
                ");
                $stmt->execute([':month' => $month, ':year' => $year]);
                $applicationCounts = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

                // Get weekly data for charts
                $weeklyStmt = $pdo->prepare("
                    SELECT DAYNAME(submitted_at) as day, COUNT(*) as count 
                    FROM loan_application 
                    WHERE submitted_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                    GROUP BY DAYNAME(submitted_at)
                    ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')
                ");
                $weeklyStmt->execute();
                $weeklyData = $weeklyStmt->fetchAll(PDO::FETCH_KEY_PAIR);

                $monthlyStmt = $pdo->prepare("
                    SELECT MONTHNAME(submitted_at) as month, COUNT(*) as count 
                    FROM loan_application 
                    WHERE YEAR(submitted_at) = YEAR(CURDATE())
                    GROUP BY MONTHNAME(submitted_at), MONTH(submitted_at)
                    ORDER BY MONTH(submitted_at)
                ");
                $monthlyStmt->execute();
                $monthlyData = $monthlyStmt->fetchAll(PDO::FETCH_KEY_PAIR);

                $yearlyStmt = $pdo->prepare("
                    SELECT YEAR(submitted_at) as year, COUNT(*) as count 
                    FROM loan_application 
                    GROUP BY YEAR(submitted_at)
                    ORDER BY YEAR(submitted_at)
                ");
                $yearlyStmt->execute();
                $yearlyData = $yearlyStmt->fetchAll(PDO::FETCH_KEY_PAIR);

            } catch(PDOException $e) {
                $applicationCounts = [];
                $weeklyData = [];
                $monthlyData = [];
                $yearlyData = [];
            }
            ?>
            
            <div class="calendar-header">
                <h2 class="calendar-title"><?php echo date('F Y', strtotime("$year-$month-01")); ?></h2>
                <div class="calendar-nav">
                    <button id="prev-month" data-month="<?php echo $month == 1 ? 12 : $month - 1; ?>" data-year="<?php echo $month == 1 ? $year - 1 : $year; ?>">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="current-month" data-month="<?php echo $currentMonth; ?>" data-year="<?php echo $currentYear; ?>">
                        Today
                    </button>
                    <button id="next-month" data-month="<?php echo $month == 12 ? 1 : $month + 1; ?>" data-year="<?php echo $month == 12 ? $year + 1 : $year; ?>">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            
            <div class="calendar-grid">
                <div class="calendar-day-header">Sun</div>
                <div class="calendar-day-header">Mon</div>
                <div class="calendar-day-header">Tue</div>
                <div class="calendar-day-header">Wed</div>
                <div class="calendar-day-header">Thu</div>
                <div class="calendar-day-header">Fri</div>
                <div class="calendar-day-header">Sat</div>
                
                <?php for($i = 1; $i < $firstDay; $i++): ?>
                    <div class="calendar-day empty"></div>
                <?php endfor; ?>
                
                <?php for($day = 1; $day <= $daysInMonth; $day++): 
                    $isToday = ($day == $today && $month == $currentMonth && $year == $currentYear);
                    $isActive = ($day == $selectedDay && $month == $month && $year == $year);
                    $count = $applicationCounts[$day] ?? 0;
                ?>
                    <div class="calendar-day <?php echo $isToday ? 'calendar-day-today' : ''; ?> <?php echo $isActive ? 'active-day' : ''; ?>" 
                         data-day="<?php echo $day; ?>" 
                         data-month="<?php echo $month; ?>" 
                         data-year="<?php echo $year; ?>">
                        <div class="calendar-day-number"><?php echo $day; ?></div>
                        <?php if($count > 0): ?>
                            <div class="application-badge">
                                <span><?php echo $count; ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <div class="recent-applications">
            <h2 class="applications-title">
                <?php 
                if ($selectedDay == date('j') && $month == date('n') && $year == date('Y')) {
                    echo "Today's Applications";
                } else {
                    echo "Applications for " . date('M j, Y', strtotime("$year-$month-$selectedDay"));
                }
                ?>
            </h2>
            <div class="recent-loading" id="recentLoading">
                <i class="fas fa-spinner fa-spin"></i> Loading applications...
            </div>
            <div class="applications-list" id="applicationsList">
                <?php
                try {
                    $dateFilter = date('Y-m-d', strtotime("$year-$month-$selectedDay"));
                    $stmt = $pdo->prepare("
                        SELECT id, first_name, last_name, submitted_at 
                        FROM loan_application 
                        WHERE DATE(submitted_at) = :date
                        ORDER BY submitted_at DESC 
                        LIMIT 8
                    ");
                    $stmt->execute([':date' => $dateFilter]);
                    
                    if($stmt->rowCount() > 0) {
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $formattedDate = date('g:i A', strtotime($row['submitted_at']));
                            
                            echo '
                            <div class="application-item">
                                <div>
                                    <div class="applicant-name">' . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . '</div>
                                    <div class="application-date">' . $formattedDate . '</div>
                                </div>
                            </div>';
                        }
                    } else {
                        echo '<p>No applications found for this day.</p>';
                    }
                } catch(PDOException $e) {
                    echo '<p>Error loading applications.</p>';
                }
                ?>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="statistics-container">
            <div class="statistics-header">
                <i class="fas fa-chart-line"></i>
                <h2>LOAN APPLICATION STATISTICS</h2>
            </div>
            
            <div class="chart-container">

                <div class="chart-card">
                    <h3>Weekly Applications</h3>
                    <canvas id="weeklyChart" height="250"></canvas>
                </div>
                
                <div class="chart-card">
                    <h3>Monthly Applications</h3>
                    <canvas id="monthlyChart" height="250"></canvas>
                </div>
                
                <div class="chart-card">
                    <h3>Yearly Applications</h3>
                    <canvas id="yearlyChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarHeader = document.querySelector('.calendar-header-text');
        calendarHeader.style.animation = 'fadeIn 1s ease-in';

        // Month navigation handlers
        document.getElementById('prev-month').addEventListener('click', function() {
            const month = this.getAttribute('data-month');
            const year = this.getAttribute('data-year');
            window.location.href = `dashboard.php?month=${month}&year=${year}`;
        });

        document.getElementById('next-month').addEventListener('click', function() {
            const month = this.getAttribute('data-month');
            const year = this.getAttribute('data-year');
            window.location.href = `dashboard.php?month=${month}&year=${year}`;
        });

        document.getElementById('current-month').addEventListener('click', function() {
            const month = this.getAttribute('data-month');
            const year = this.getAttribute('data-year');
            window.location.href = `dashboard.php?month=${month}&year=${year}&day=${new Date().getDate()}`;
        });

        // Day click handler
        document.querySelectorAll('.calendar-day:not(.empty)').forEach(day => {
            day.addEventListener('click', function() {
                const dayNum = this.getAttribute('data-day');
                const month = this.getAttribute('data-month');
                const year = this.getAttribute('data-year');
                
                // Update URL without reloading
                const params = new URLSearchParams(window.location.search);
                params.set('day', dayNum);
                params.set('month', month);
                params.set('year', year);
                window.history.pushState({}, '', `?${params.toString()}`);
                
                // Update active day styling
                document.querySelectorAll('.calendar-day').forEach(d => {
                    d.classList.remove('active-day');
                });
                this.classList.add('active-day');
                
                // Update applications and charts
                updateRecentApplications(dayNum, month, year);
            });
        });

        // Function to update applications and charts
        function updateRecentApplications(day, month, year) {
            const loading = document.getElementById('recentLoading');
            const list = document.getElementById('applicationsList');
            const title = document.querySelector('.applications-title');
            
            loading.style.display = 'block';
            list.style.display = 'none';
            
            // Update title
            const date = new Date(year, month-1, day);
            const isToday = new Date().toDateString() === date.toDateString();
            title.textContent = isToday ? "Today's Applications" : 
                `Applications for ${date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}`;
            
            // Fetch data
            fetch(`get_day_applications.php?day=${day}&month=${month}&year=${year}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update applications list
                        let html = '';
                        if (data.applications.length > 0) {
                            data.applications.forEach(app => {
                                const formattedTime = new Date(app.submitted_at).toLocaleTimeString('en-US', 
                                    { hour: 'numeric', minute: '2-digit' });
                                
                                html += `
                                <div class="application-item">
                                    <div>
                                        <div class="applicant-name">${app.first_name} ${app.last_name}</div>
                                        <div class="application-date">${formattedTime}</div>
                                    </div>
                                </div>`;
                            });
                        } else {
                            html = '<p>No applications found for this day.</p>';
                        }
                        list.innerHTML = html;

                        // Update charts if they exist
                        if (window.weeklyChart && window.monthlyChart && window.yearlyChart) {
                            const weeklyDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                            const weeklyCounts = weeklyDays.map(day => data.statistics.weekly[day] || 0);
                            
                            const monthlyMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                            const monthlyCounts = monthlyMonths.map(month => data.statistics.monthly[month] || 0);
                            
                            // Update chart data
                            window.weeklyChart.data.datasets[0].data = weeklyCounts;
                            window.monthlyChart.data.datasets[0].data = monthlyCounts;
                            window.yearlyChart.data.datasets[0].data = Object.values(data.statistics.yearly);
                            window.yearlyChart.data.labels = Object.keys(data.statistics.yearly);
                            
                            // Update charts
                            window.weeklyChart.update();
                            window.monthlyChart.update();
                            window.yearlyChart.update();
                        }
                    } else {
                        list.innerHTML = '<p>Error loading applications.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    list.innerHTML = '<p>Error loading applications.</p>';
                })
                .finally(() => {
                    loading.style.display = 'none';
                    list.style.display = 'block';
                });
        }

        // Handle browser back/forward buttons
        window.addEventListener('popstate', function() {
            const params = new URLSearchParams(window.location.search);
            const day = params.get('day');
            const month = params.get('month');
            const year = params.get('year');
            
            if (day && month && year) {
                const dayElement = document.querySelector(`.calendar-day[data-day="${day}"][data-month="${month}"][data-year="${year}"]`);
                if (dayElement) {
                    dayElement.click();
                }
            }
        });

        // Load Chart.js dynamically
        const chartScript = document.createElement('script');
        chartScript.src = 'https://cdn.jsdelivr.net/npm/chart.js';
        document.head.appendChild(chartScript);

        // Initialize charts once Chart.js is loaded
        chartScript.onload = function() {
            // Prepare initial data from PHP
            const weeklyDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            const weeklyCounts = weeklyDays.map(day => <?php echo json_encode($weeklyData[$day] ?? 0); ?>);

            const monthlyMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const monthlyCounts = monthlyMonths.map(month => <?php echo json_encode($monthlyData[$month] ?? 0); ?>);

            const yearlyLabels = <?php echo json_encode(array_keys($yearlyData)); ?>;
            const yearlyCounts = <?php echo json_encode(array_values($yearlyData)); ?>;

            // Initialize Weekly Chart
            const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
            window.weeklyChart = new Chart(weeklyCtx, {
                type: 'bar',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Applications',
                        data: weeklyCounts,
                        backgroundColor: 'rgba(77, 35, 121, 0.7)',
                        borderColor: 'rgba(77, 35, 121, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Initialize Monthly Chart
            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            window.monthlyChart = new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Applications',
                        data: monthlyCounts,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Initialize Yearly Chart
            const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
            window.yearlyChart = new Chart(yearlyCtx, {
                type: 'bar',
                data: {
                    labels: yearlyLabels,
                    datasets: [{
                        label: 'Applications',
                        data: yearlyCounts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        };
    });
</script>

    <?php include 'footer.php'; ?>
</body>
</html>