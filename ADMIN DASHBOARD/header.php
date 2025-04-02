<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN DASHBOARD</title>

    <!-- ==================== STYLES ==================== -->
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<!-- ==================== NAVIGATION BAR ==================== -->
<div class="container">
    <div class="navigation">
        <ul>
            <li class="logo">
                <a href="dashboard.php">
                    <span class="icon   "><i class="fa-solid fa-circle-user"></i></span>
                    <span class="title">QCREDIT</span>
                </a>
            </li>
            <li><a href="Admin.php"><span class="icon"><i class="fa-regular fa-folder"></i></span> <span class="title">Dashboard</span></a></li>
            <li><a href="customer.php"><span class="icon"><i class="fa-solid fa-person"></i></span> <span class="title">Customer</span></a></li>
            <li><a href="inventory.php"><span class="icon"><i class="fa-solid fa-truck-moving"></i></span> <span class="title">Inventory</span></a></li>
            <li><a href="news-events.php"><span class="icon"><i class="fa-regular fa-calendar-days"></i></span> <span class="title">News & Events</span></a></li>
            <li><a href="background.php"><span class="icon"><i class="fa-regular fa-images"></i></span> <span class="title">Background</span></a></li>
            <li><a href="testimonial.php"><span class="icon"><i class="fa-regular fa-images"></i></span> <span class="title">Testimonials</span></a></li>
            <li><a href="settings.php"><span class="icon"><i class="fa-solid fa-cogs"></i></span> <span class="title">Settings</span></a></li>
            <li><a href="logout.php"><span class="icon"><i class="fa-solid fa-sign-out-alt"></i></span> <span class="title">Logout</span></a></li>
        </ul>
    </div>
</div>

<!-- ==================== MAIN SECTION ==================== -->
<div class="main">
    <!-- ==================== TOPBAR ==================== -->
    <div class="topbar">
        <div class="toggle"><i class="fa-solid fa-bars"></i></div>
        <div class="search">
            <label>
                <input type="text" placeholder="Search here">
                <i class="fa-solid fa-magnifying-glass"></i>
            </label>
        </div>
        <div class="user">
            <img src="../Images/logo.jpg" alt="User">
        </div>
    </div>
