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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php

        include 'header.php'; 

    ?>
        <!-- ==================== CARDS ==================== -->
        <div class="cardBox">
            <div class="card">
                <div class="numbers">6969</div>
                <div class="cardName">Daily Visitors</div>
                <div class="iconBx">
                    <i class="fa-regular fa-eye"></i>
                </div>
            </div>
            <div class="card">
                <div class="numbers">420</div>
                <div class="cardName">Items</div>
                <div class="iconBx">
                    <i class="fa-light fa-cart-shopping"></i>
                </div>
            </div>
            <div class="card">
                <div class="numbers">404</div>
                <div class="cardName">Comments</div>
                <div class="iconBx">
                    <i class="fa-regular fa-comments"></i>
                </div>
            </div>
            <div class="card">
                <div class="numbers">$619</div>
                <div class="cardName">Lending</div>
                <div class="iconBx">
                    <i class="fa-solid fa-money-bills"></i>
                </div>
            </div>
        </div>

    <!-- ==================== SCRIPTS ==================== -->
    <script src="dashboard.js"></script>
</body>
</html>