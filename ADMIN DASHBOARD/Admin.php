<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN DASHBOARD</title>
</head>
<body>
    <!-- ==================== STYLES ==================== -->
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- ==================== NAVIGATION BAR ==================== -->
     <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="">
                        <span class="icon">
                            <i class="fa-solid fa-circle-user"></i></span>
                        <span class="title">QCREDIT</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="icon">
                            <i class="fa-regular fa-folder"></i>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="icon">
                            <i class="fa-solid fa-person"></i>
                        </span>
                        <span class="title">Customer</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="icon">
                            <i class="fa-light fa-truck-moving"></i>
                        </span>
                        <span class="title">Inventory</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="icon">
                            <i class="fa-regular fa-calendar-days"></i>
                        </span>
                        <span class="title">News & Events</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="icon">
                            <i class="fa-regular fa-images"></i>
                        </span>
                        <span class="title">Background</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="icon">
                            <i class="fa-solid fa-cogs"></i>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="icon">
                            <i class="fa-solid fa-sign-out-alt"></i>
                        </span>
                        <span class="title">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- ==================== MAIN SECTION ==================== -->
     <div class="main">
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
            <img src="Images/DefaultCat.jpg" alt="">
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
                    <i class="fa-regular fa-money-bills"></i>
                </div>
            </div>
        </div>


        <!-- ==================== Items Details ==================== -->
         <div class="details">
            <div class="itemOrders">
                <div class="cardHeader">
                    <h2>Recent Items</h2>
                    <a href="#" class="btn">View All</a>
                </div>
                <table>
                    <thead>
                    <tr>
                        <td>Name</td>
                        <td>Items</td>
                        <td>News & Events</td>
                        <td>Status</td>
                    </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Dell laptop</td>
                            <td>$150</td>
                            <td>Paid</td>
                            <td><span class="status delivered">Delivered</span></td>
                        </tr>

                        <tr>
                            <td>Apple Watch</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>

                        <tr>
                            <td>Addidas shoes</td>
                            <td>$620</td>
                            <td>Due</td>
                            <td><span class="status return">Return</span></td>
                        </tr>

                        <tr>
                            <td>Good Items</td>
                            <td>$5000</td>
                            <td>Paid</td>
                            <td><span class="status inProgress">In progress</span></td>
                        </tr>

                        <tr>
                            <td>Dell laptop</td>
                            <td>$150</td>
                            <td>Paid</td>
                            <td><span class="status delivered">Delivered</span></td>
                        </tr>

                        <tr>
                            <td>Apple Watch</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>

                        <tr>
                            <td>Addidas shoes</td>
                            <td>$620</td>
                            <td>Due</td>
                            <td><span class="status return">Return</span></td>
                        </tr>

                        <tr>
                            <td>Good Items</td>
                            <td>$5000</td>
                            <td>Paid</td>
                            <td><span class="status inProgress">In progress</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- ==================== News Customer ==================== -->
             <div class="recentCustomers">
                <div class="cardHeader">
                    <h2>Recent Customers </h2>
                </div>

                    <table>
                        <tr>
                            <td>
                                <div class="imgBx"><img src="Images/DefaultCat.jpg" alt=""></div>
                            </td>

                            <td>
                                <h4>Ivan <br> <span>Quezon City </span></h4>
                            </td>
                        </tr>
                    </table>
             </div>
         </div>
    </div>
</div>

    <!-- ==================== SCRIPTS ==================== -->
    <script src="dashboard.js"></script>
</body>
</html>