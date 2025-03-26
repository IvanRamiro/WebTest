<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    
    <div class="sidebar">
        <ul>
            <li class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</li>
            <li><i class="fas fa-boxes"></i> Inventory</li>
            <li><i class="fas fa-shopping-cart"></i> Orders</li>
            <li><i class="fas fa-users"></i> Customers</li>
            <li><i class="fas fa-chart-line"></i> Reports</li>
            <li><i class="fas fa-cogs"></i> Settings</li>
            <li class="logout"><i class="fas fa-sign-out-alt"></i> Logout</li>
        </ul>
    </div>

    <div class="main-content">
        <section class="main-section">
            <!-- Main content goes here -->
            <header class="dashboard-header">
    <div class="header-left">
        <h2>Inventory Dashboard</h2>
        <i class="fas fa-bars menu-icon"></i>
    </div>
    <div class="header-center">
        <input type="text" class="search-bar" placeholder="Search...">
    </div>
    <div class="header-right">
        <i class="fas fa-bell"></i>
        <i class="fas fa-envelope"></i>
        <i class="fas fa-cog"></i>
        <div class="profile">
            <img src="Images/Extra Rice.PNG" alt="Profile">
        </div>
    </div>
</header>

<div class="main-grid">
    <div class="container overview">
        <h3>Overview</h3>
        <div class="cards">
            <div class="card" id="inventory">
                <i class="fas fa-boxes"></i>
                <h4>Inventory</h4>
                <p id="inventory-count">Loading...</p>
            </div>
            <div class="card" id="bg-changer">
                <i class="fas fa-palette"></i>
                <h4>Background Changer</h4>
            </div>
            <div class="card" id="news-events">
                <i class="fas fa-newspaper"></i>
                <h4>News & Events</h4>
                <p id="news-count">Loading...</p>
            </div>
            <div class="card" id="users">
                <i class="fas fa-users"></i>
                <h4>User Data</h4>
                <p id="user-count">Loading...</p>
            </div>
        </div>
    </div>
    <div class="container"> <div class="lending-container">
    <h3>Lending Items Records</h3>
    <div class="lending-grid" id="lending-data">
        <!-- Data will be loaded dynamically -->
    </div>
</div>
 </div>
    <div class="container">
    <div class="tracking-container">
    <h3>Tracking Records</h3>
    <div class="tracking-grid" id="tracking-data">
        <!-- Data will be loaded dynamically -->
    </div>
</div>
 </div>
    <div class="container">
    <div class="message-container">
    <h3>Client Requests & Reports</h3>
    <div class="message-grid" id="message-data">
        <!-- Data will be loaded dynamically -->
    </div>
</div>

    </div>
</div>




<script>src="admin.js"></script>
        </section>
    </div>
</body>
</html>
