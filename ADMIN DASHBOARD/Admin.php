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

    <!-- ==================== NAVIGATION BAR ==================== -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li class="logo">
                    <a href="dashboard.php">
                        <span class="icon"><i class="fa-solid fa-circle-user"></i></span>
                        <span class="title">QCREDIT</span>
                    </a>
                </li>
                <li>
                    <a href="dashboard.php">
                        <span class="icon"><i class="fa-regular fa-folder"></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="customer.php">
                        <span class="icon"><i class="fa-solid fa-person"></i></span>
                        <span class="title">Customer</span>
                    </a>
                </li>
                <li>
                    <a href="inventory.php">
                        <span class="icon"><i class="fa-solid fa-truck-moving"></i></span>
                        <span class="title">Inventory</span>
                    </a>
                </li>
                <li>
                    <a href="news-events.php">
                        <span class="icon"><i class="fa-regular fa-calendar-days"></i></span>
                        <span class="title">News & Events</span>
                    </a>
                </li>
                <li>
                    <a href="background.php">
                        <span class="icon"><i class="fa-regular fa-images"></i></span>
                        <span class="title">Background</span>
                    </a>
                </li>
                <li>
                    <a href="settings.php">
                        <span class="icon"><i class="fa-solid fa-cogs"></i></span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <span class="icon"><i class="fa-solid fa-sign-out-alt"></i></span>
                        <span class="title">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

</body>
</html>

    <!-- ==================== MAIN SECTION ==================== -->
    <div class="main">
        <!-- ==================== TOPBAR ==================== -->
        <div class="topbar">
            <div class="toggle">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="search">
                <label>
                    <input type="text" placeholder="Search here">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </label>
            </div>
            <div class="user">
                <img src="../Images/logo.jpg" alt="">
            </div>
        </div>

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

        <!-- ==================== DETAILS SECTION ==================== -->
        <div class="details">
<!-- ==================== ITEM ORDERS ==================== -->
<div class="itemOrders">
    <div class="cardHeader">
        <h2>Recent Items</h2>
        <button class="btn addItem">Add Item</button>
    </div>
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>Items</td>
                <td>Sales</td>
                <td>Status</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Dell laptop</td>
                <td>$150</td>
                <td>Paid</td>
                <td><span class="status delivered">Delivered</span></td>
                <td>
                    <button class="editBtn">Edit</button>
                    <button class="deleteBtn">Delete</button>
                </td>
            </tr>
            <tr>
                <td>Apple Watch</td>
                <td>$1200</td>
                <td>Paid</td>
                <td><span class="status pending">Pending</span></td>
                <td>
                    <button class="editBtn">Edit</button>
                    <button class="deleteBtn">Delete</button>
                </td>
            </tr>
            <tr>
                <td>Adidas shoes</td>
                <td>$620</td>
                <td>Due</td>
                <td><span class="status return">Return</span></td>
                <td>
                    <button class="editBtn">Edit</button>
                    <button class="deleteBtn">Delete</button>
                </td>
            </tr>
            <tr>
                <td>Good Items</td>
                <td>$5000</td>
                <td>Paid</td>
                <td><span class="status inProgress">In progress</span></td>
                <td>
                    <button class="editBtn">Edit</button>
                    <button class="deleteBtn">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

           <!-- ==================== RECENT CUSTOMERS ==================== -->
<div class="recentCustomers">
    <div class="cardHeader">
        <h2>Recent Customers</h2>
    </div>
    <table>
        <tr>
            <td width="50px">
                <div class="imgBx"><img src="../Images/Extra Rice.PNG" alt="User"></div>
            </td>
            <td>
                <h4>Ivan <br> <span>Quezon City</span></h4>
            </td>
        </tr>
        <tr>
            <td width="50px">
                <div class="imgBx"><img src="../Images/Extra Rice.PNG" alt="User"></div>
            </td>
            <td>
                <h4>Maria <br> <span>Makati</span></h4>
            </td>
        </tr>
        <tr>
            <td width="50px">
                <div class="imgBx"><img src="../Images/Extra Rice.PNG" alt="User"></div>
            </td>
            <td>
                <h4>John <br> <span>Pasig</span></h4>
            </td>
        </tr>
    </table>
</div>

    <!-- ==================== SCRIPTS ==================== -->
    <script src="dashboard.js"></script>
</body>
</html>