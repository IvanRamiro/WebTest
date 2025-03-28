<?php
// Start the session
session_start();

// Prevent browser caching for this page
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include the header
include 'header.php'; 
?>

<!-- ==================== DASHBOARD CONTENT ==================== -->
<div class="cardBox">
    <div class="card">
        <div class="numbers">6969</div>
        <div class="cardName">Daily Visitors</div>
        <div class="iconBx"><i class="fa-regular fa-eye"></i></div>
    </div>
    <div class="card">
        <div class="numbers">420</div>
        <div class="cardName">Items</div>
        <div class="iconBx"><i class="fa-light fa-cart-shopping"></i></div>
    </div>
</div>

<!-- Include footer -->
<?php include 'footer.php'; ?>

