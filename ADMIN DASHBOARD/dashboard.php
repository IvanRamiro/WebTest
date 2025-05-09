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

        /* Calendar Section */
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
            animation: textGlow 2s infinite alternate;
        }

        .calendar-header-text::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--secondary);
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.5s ease-out;
        }

        .calendar-header-container:hover .calendar-header-text::after {
            transform: scaleX(1);
            transform-origin: bottom left;
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

        .day-applications-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .day-applications-content {
            background: var(--white);
            border-radius: var(--radius);
            padding: 20px;
            width: 80%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .day-applications-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }

        .day-applications-title {
            color: var(--primary);
            font-size: 1.2rem;
            font-weight: 600;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--black2);
        }

        .day-applications-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Recent Applications Section */
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
            background: var(--gray);
            border-radius: 6px;
            transition: all var(--transition-fast);
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

        .application-status {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .status-pending {
            background: rgba(246, 194, 62, 0.2);
            color: #f6c23e;
        }

        .status-approved {
            background: rgba(28, 200, 138, 0.2);
            color: #1cc88a;
        }

        .status-rejected {
            background: rgba(231, 74, 59, 0.2);
            color: #e74a3b;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes textGlow {
            0% { text-shadow: 0 0 5px rgba(77, 35, 121, 0.3); }
            100% { text-shadow: 0 0 10px rgba(77, 35, 121, 0.6); }
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

            .day-applications-content {
                width: 90%;
                padding: 15px;
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

            $month = max(1, min(12, $month));
            $year = max(2020, min(2100, $year));
            
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
            } catch(PDOException $e) {
                $applicationCounts = [];
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
                    $count = $applicationCounts[$day] ?? 0;
                ?>
                    <div class="calendar-day <?php echo $isToday ? 'calendar-day-today' : ''; ?>" 
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
            <h2 class="applications-title">Recent Applications</h2>
            <div class="applications-list">
                <?php
                try {
                    $stmt = $pdo->query("
                        SELECT id, first_name, last_name, status, submitted_at 
                        FROM loan_application 
                        ORDER BY submitted_at DESC 
                        LIMIT 8
                    ");
                    
                    if($stmt->rowCount() > 0) {
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $statusClass = 'status-' . strtolower($row['status']);
                            $formattedDate = date('M j, Y g:i A', strtotime($row['submitted_at']));
                            
                            echo '
                            <div class="application-item">
                                <div>
                                    <div class="applicant-name">' . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . '</div>
                                    <div class="application-date">' . $formattedDate . '</div>
                                </div>
                                <div class="application-status ' . $statusClass . '">' . ucfirst($row['status']) . '</div>
                            </div>';
                        }
                    } else {
                        echo '<p>No recent applications found.</p>';
                    }
                } catch(PDOException $e) {
                    echo '<p>Error loading recent applications.</p>';
                }
                ?>
            </div>
        </div>
    </div>

    <div class="day-applications-modal" id="dayApplicationsModal">
        <div class="day-applications-content">
            <div class="day-applications-header">
                <h3 class="day-applications-title" id="modalDayTitle">Applications</h3>
                <button class="close-modal" id="closeModal">&times;</button>
            </div>
            <div class="day-applications-list" id="dayApplicationsList">
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarHeader = document.querySelector('.calendar-header-text');
            calendarHeader.style.animation = 'fadeIn 1s ease-in';

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
                window.location.href = `dashboard.php?month=${month}&year=${year}`;
            });

            document.querySelectorAll('.calendar-day:not(.empty)').forEach(day => {
                day.addEventListener('click', function() {
                    const dayNum = this.getAttribute('data-day');
                    const month = this.getAttribute('data-month');
                    const year = this.getAttribute('data-year');
                    
                    const modal = document.getElementById('dayApplicationsModal');
                    const modalTitle = document.getElementById('modalDayTitle');
                    const applicationsList = document.getElementById('dayApplicationsList');
                    
                    modalTitle.textContent = `Applications for ${month}/${dayNum}/${year}`;
                    applicationsList.innerHTML = '<p>Loading applications...</p>';
                    modal.style.display = 'flex';
                    
                    fetch(`get_day_applications.php?day=${dayNum}&month=${month}&year=${year}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success && data.applications.length > 0) {
                                let html = '';
                                data.applications.forEach(app => {
                                    const statusClass = 'status-' + app.status.toLowerCase();
                                    const formattedDate = new Date(app.submitted_at).toLocaleString();
                                    
                                    html += `
                                    <div class="application-item">
                                        <div>
                                            <div class="applicant-name">${app.first_name} ${app.last_name}</div>
                                            <div class="application-date">${formattedDate}</div>
                                        </div>
                                        <div class="application-status ${statusClass}">${app.status}</div>
                                    </div>`;
                                });
                                applicationsList.innerHTML = html;
                            } else {
                                applicationsList.innerHTML = '<p>No applications found for this day.</p>';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            applicationsList.innerHTML = '<p>Error loading applications.</p>';
                        });
                });
            });

            // Close modal
            document.getElementById('closeModal').addEventListener('click', function() {
                document.getElementById('dayApplicationsModal').style.display = 'none';
            });

            // Close modal when clicking outside
            document.getElementById('dayApplicationsModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.display = 'none';
                }
            });
        });
    </script>

    <?php include 'footer.php'; ?>
</body>
</html>