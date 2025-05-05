<?php include 'header.php'; ?>

<!-- ==================== DASHBOARD CONTENT ==================== -->
<div class="main-content">
    <!-- Dashboard Summary Cards -->
    <div class="cardBox">
        <div class="card">
            <div>
                <div class="numbers">1,504</div>
                <div class="cardName">Total Loans</div>
                <div class="cardProgress">
                    <span style="width: 65%; background: var(--blue);"></span>
                </div>
                <div class="cardSub">+12% from last month</div>
            </div>
            <div class="iconBx">
                <i class="fa-solid fa-hand-holding-dollar"></i>
            </div>
        </div>
        
        <div class="card">
            <div>
                <div class="numbers">₱2.8M</div>
                <div class="cardName">Total Amount</div>
                <div class="cardProgress">
                    <span style="width: 82%; background: var(--secondary);"></span>
                </div>
                <div class="cardSub">+24% from last month</div>
            </div>
            <div class="iconBx">
                <i class="fa-solid fa-peso-sign"></i>
            </div>
        </div>
        
        <div class="card">
            <div>
                <div class="numbers">324</div>
                <div class="cardName">Active Borrowers</div>
                <div class="cardProgress">
                    <span style="width: 45%; background: #8de02b;"></span>
                </div>
                <div class="cardSub">+5 new this week</div>
            </div>
            <div class="iconBx">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
        
        <div class="card">
            <div>
                <div class="numbers">42</div>
                <div class="cardName">Pending Applications</div>
                <div class="cardProgress">
                    <span style="width: 30%; background: #1795ce;"></span>
                </div>
                <div class="cardSub">3 awaiting approval</div>
            </div>
            <div class="iconBx">
                <i class="fa-solid fa-clock"></i>
            </div>
        </div>
    </div>

    <!-- Charts and Recent Activity -->
    <div class="details-grid">
        <div class="chart-card">
            <div class="cardHeader">
                <h2>Loan Analytics</h2>
                <a href="#" class="btn">View Report</a>
            </div>
            <canvas id="loanChart" height="300"></canvas>
        </div>
        
        <div class="activity-card">
            <div class="cardHeader">
                <h2>Recent Activity</h2>
                <a href="loan_dashboard.php" class="btn">View All</a>
            </div>
            <div class="table-container">
                <table>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                        </td>
                        <td>
                            <h4>New Loan <br> <span>Juan Dela Cruz</span></h4>
                        </td>
                        <td>
                            <span class="status delivered">Approved</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="imgBx"><i class="fa-solid fa-peso-sign"></i></div>
                        </td>
                        <td>
                            <h4>Payment <br> <span>Maria Santos</span></h4>
                        </td>
                        <td>
                            <span class="status delivered">Completed</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="imgBx"><i class="fa-solid fa-user-plus"></i></div>
                        </td>
                        <td>
                            <h4>Application <br> <span>Jose Reyes</span></h4>
                        </td>
                        <td>
                            <span class="status pending">Pending</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="imgBx"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        </td>
                        <td>
                            <h4>Overdue <br> <span>Ana Lopez</span></h4>
                        </td>
                        <td>
                            <span class="status return">Overdue</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="imgBx"><i class="fa-solid fa-user-check"></i></div>
                        </td>
                        <td>
                            <h4>New Borrower <br> <span>Pedro Cruz</span></h4>
                        </td>
                        <td>
                            <span class="status inProgress">Processing</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>