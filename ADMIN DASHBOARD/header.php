<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard | UNLAD PLUS LOAN</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .navigation ul li .icon {
            min-width: 30px;
            display: inline-flex;
            justify-content: center;
        }
    </style>
</head>
<!-- ==================== NAVIGATION BAR ==================== -->
<div class="container">
    <div class="navigation">
        <!-- Admin Profile Section -->
        <div class="admin-profile">
            <img src="../Images/UNLAD.PNG" alt="Admin Profile">
            <h3>Admin</h3>
            <p>Administrator</p>
        </div>
        
        <!-- Navigation Menu -->
        <div class="nav-menu">
            <ul>
                <li><a href="dashboard.php"><span class="icon"><i class="fa-solid fa-gauge-high"></i></span> <span class="title">Dashboard</span></a></li>
                <li><a href="loan_dashboard.php"><span class="icon"><i class="fa-solid fa-users"></i></span> <span class="title">Loan Customer</span></a></li>
                <li><a href="Borrowers.php"><span class="icon"><i class="fa-solid fa-boxes-stacked"></i></span> <span class="title">Borrowers</span></a></li>
                <li><a href="news-events-admin.php"><span class="icon"><i class="fa-solid fa-newspaper"></i></span> <span class="title">News & Events</span></a></li>
                <li><a href="background.php"><span class="icon"><i class="fa-solid fa-photo-film"></i></span> <span class="title">Background</span></a></li>
                <li><a href="testimonial.php"><span class="icon"><i class="fa-solid fa-comment-dots"></i></span> <span class="title">Testimonials</span></a></li>
                <li><a href="Branches.php"><span class="icon"><i class="fa-solid fa-location-dot"></i></span> <span class="title">Branches Map</span></a></li>
                <li><a href="settings.php"><span class="icon"><i class="fa-solid fa-sliders"></i></span> <span class="title">Settings</span></a></li>
            </ul>
        </div>
        
        <!-- Logout Section -->
        <div class="logout-section">
            <a href="logout.php"><span class="icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></span> <span class="title">Logout</span></a>
        </div>
    </div>
</div>

<!-- ==================== MAIN SECTION ==================== -->
<div class="main">
    <div class="topbar">
        <div class="toggle"><i class="fa-solid fa-bars"></i></div>
        <div class="search">
            <label>
                <input type="text" placeholder="Search here">
                <i class="fa-solid fa-magnifying-glass"></i>
            </label>
        </div>
        <div class="user">
            <img src="../Images/UNLAD.PNG" alt="User"> 
        </div>
    </div>