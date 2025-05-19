<?php
include 'db.php';

$bg_image = "";
$bg_result = $conn->query("SELECT bg_image FROM bgchanger ORDER BY id DESC LIMIT 1");
if ($bg_result && $bg_result->num_rows > 0) {
    $bg_row = $bg_result->fetch_assoc();
    $bg_image = "ADMIN DASHBOARD/" . $bg_row['bg_image'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAST CASH</title>
    <meta name="description" content="FAST CASH - Quick and reliable financial solutions">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css?v=1.1"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="script.js" defer></script>
</head>
<body>
    
<!-- Header Section -->
<header class="top-bar bg-light py-2 border-bottom" role="banner">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <div class="d-flex align-items-center justify-content-between flex-nowrap">
            <!-- Logo Section - Fixed width with min-width -->
            <div class="d-flex align-items-center" style="min-width: 180px;">
                <img src="Images/UNLAD.PNG" alt="UNLAD PLUS LOAN" class="logo-img me-2" height="50">
                <span class="brand-name fw-bold fs-5">UNLAD PLUS LOAN</span>
            </div>

            <!-- Contact & Links - Auto width with no flex-wrap -->
            <div class="d-flex flex-nowrap gap-4">
                <div><strong>Customer Service</strong><br><a href="tel:(02)1234-5678">(02) 1234-5678</a></div>
                <div><strong>Help & Support</strong><br><a href="mailto:support@unladplusloan.com">support@unladplusloan.com</a></div>
                <div class="d-none d-lg-block"><strong>Careers</strong><br><a href="mailto:careers@unladplusloan.com">careers@unladplusloan.com</a></div>
                <div class="d-none d-xl-block"><strong>Complaints</strong><br><a href="mailto:complaints@unladplusloan.com">complaints@unladplusloan.com</a></div>
            </div>

            <!-- Login Button -->
            <div>
                <a href="login.php" class="btn btn-primary text-white px-3 py-1">Login</a>
            </div>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="hero" style="height: 500px; background: url('<?php echo $bg_image; ?>') no-repeat center center / cover;">
<nav class="navbar navbar-expand-lg navbar-light position-sticky top-0 w-100 z-3" style="background-color: var(--main-color);" role="navigation">
    <div class="container">
        <!-- Collapsible Navigation -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav text-center">
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'help-support.php' ? 'active' : ''; ?>" href="help-support.php">Help & Support</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'about-us.php' ? 'active' : ''; ?>" href="about-us.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'apply.php' ? 'active' : ''; ?>" href="apply.php">Apply</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'news-events.php' ? 'active' : ''; ?>" href="news-events.php">News and Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'contact-us.php' ? 'active' : ''; ?>" href="contact-us.php">Contact Us</a>
                </li>
            </ul>
        </div>
</nav>
</section>

 <!-- Main Content -->
<main id="main-content">
    <!-- About Unlad Plus Loan Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="Images/Unlad plus.jpg" alt="Unlad Plus Loan Team" class="img-fluid rounded shadow-lg animate__animated animate__fadeInLeft">
                </div>
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold mb-4" style="color: var(--main-color);">About <span style="color: var(--secondary-color);">Unlad Plus Loan</span></h2>
                    <p class="lead">Unlad Plus Loan is a premier financial service provider in the Philippines, dedicated to delivering sustainable loan solutions for personal and business growth.</p>
                    <p>With a nationwide presence, we aim to provide financial empowerment with flexible terms and exceptional customer service. Our mission is to help Filipinos achieve their dreams through accessible financing.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="contact-us.php" class="btn px-4 py-2" style="background-color: var(--main-color); color: white;">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Our <span style="color: var(--main-color);">Story</span></h2>
                <div class="divider mx-auto" style="background-color: var(--main-color);"></div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-4 mx-auto" style="background-color: var(--main-color); color: white;">
                                <i class="fas fa-rocket fa-2x"></i>
                            </div>
                            <h3 class="h4">Our Beginnings</h3>
                            <p>Founded in 2018, Unlad Plus Loan began with a vision to provide growth-focused financial solutions to Filipinos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-4 mx-auto" style="background-color: var(--main-color); color: white;">
                                <i class="fas fa-chart-line fa-2x"></i>
                            </div>
                            <h3 class="h4">Growth & Expansion</h3>
                            <p>Through our commitment to sustainable lending, we've expanded to serve entrepreneurs across the Philippines.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-4 mx-auto" style="background-color: var(--main-color); color: white;">
                                <i class="fas fa-bullseye fa-2x"></i>
                            </div>
                            <h3 class="h4">Future Vision</h3>
                            <p>We continue to innovate to provide more financial products that support long-term growth and stability.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Our <span style="color: var(--main-color);">Purpose</span></h2>
                <div class="divider mx-auto" style="background-color: var(--main-color);"></div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 text-center" style="border: 2px solid var(--main-color);">
                        <div class="card-body p-4">
                            <i class="fas fa-bullseye fa-3x mb-3" style="color: var(--main-color);"></i>
                            <h3 class="h4">Mission</h3>
                            <p>To provide growth-oriented loan solutions with fair terms and maximum convenience for our clients.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 text-center" style="border: 2px solid var(--main-color);">
                        <div class="card-body p-4">
                            <i class="fas fa-eye fa-3x mb-3" style="color: var(--main-color);"></i>
                            <h3 class="h4">Vision</h3>
                            <p>To be the most trusted growth partner in the Philippines, known for our reliability and customer care.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 text-center" style="border: 2px solid var(--main-color);">
                        <div class="card-body p-4">
                            <i class="fas fa-users fa-3x mb-3" style="color: var(--main-color);"></i>
                            <h3 class="h4">Our People</h3>
                            <p>Our team is committed to providing knowledgeable, professional service with every transaction.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Our <span style="color: var(--main-color);">Core Values</span></h2>
                <div class="divider mx-auto" style="background-color: var(--main-color);"></div>
                <p class="lead mx-auto" style="max-width: 700px;">These principles guide everything we do at Unlad Plus Loan and define how we serve our customers.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <div class="card-body p-4 text-center">
                            <div class="value-icon mb-3 mx-auto" style="background-color: var(--main-color); color: white;">
                                <i class="fas fa-balance-scale fa-2x"></i>
                            </div>
                            <h3 class="h4">Integrity</h3>
                            <p>We conduct all transactions with honesty and transparency, ensuring fair terms for our clients.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <div class="card-body p-4 text-center">
                            <div class="value-icon mb-3 mx-auto" style="background-color: var(--main-color); color: white;">
                                <i class="fas fa-user-friends fa-2x"></i>
                            </div>
                            <h3 class="h4">Customer Focus</h3>
                            <p>We prioritize our clients' growth needs, providing solutions tailored to their goals.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <div class="card-body p-4 text-center">
                            <div class="value-icon mb-3 mx-auto" style="background-color: var(--main-color); color: white;">
                                <i class="fas fa-lightbulb fa-2x"></i>
                            </div>
                            <h3 class="h4">Sustainability</h3>
                            <p>We promote financial solutions that support long-term growth and stability.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 text-white" style="background-color: var(--main-color);">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="display-4 fw-bold">150K+</div>
                    <p class="mb-0">Clients Empowered</p>
                </div>
                <div class="col-md-3">
                    <div class="display-4 fw-bold">40+</div>
                    <p class="mb-0">Branches Nationwide</p>
                </div>
                <div class="col-md-3">
                    <div class="display-4 fw-bold">300+</div>
                    <p class="mb-0">Financial Experts</p>
                </div>
                <div class="col-md-3">
                    <div class="display-4 fw-bold">6+</div>
                    <p class="mb-0">Years of Service</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-white">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-4">Ready to Grow?</h2>
            <p class="lead mb-4">Discover how Unlad Plus Loan can support your financial journey.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="apply.php" class="btn btn-lg px-4" style="background-color: var(--main-color); color: white;">Apply Now</a>
                <a href="contact-us.php" class="btn btn-outline-danger btn-lg px-4" style="border-color: var(--main-color); color: var(--main-color);">Contact Us</a>
            </div>
        </div>
    </section>
</main>

<!-- Footer Section -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <!-- Left Section: Company Info -->
            <div class="col-md-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="Images/UNLAD.PNG" alt="UNLAD PLUS LOAN Logo" height="40" class="me-2">
                    <p class="mb-0"><strong>UNLAD PLUS LOAN</strong></p>
                </div>
                <p>SEC Reg. No. CS202300001</p>
                <p>Certificate of Authority No. 1234</p>
                <p>Please study the terms and conditions in the disclosure statement before proceeding with your loan transaction.</p>
                
                <!-- Social Media Icons -->
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-dark"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-dark"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="btn btn-dark"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="btn btn-dark"><i class="fab fa-tiktok"></i></a>
                </div>

                <img src="Images/SEAL.jpg" alt="DPO DPS Certificate" class="mt-3 img-fluid" width="150">
            </div>

            <!-- Middle Section: Menu & Quick Links -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Menu</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="footer-link">Home</a></li>
                    <li><a href="help-support.php" class="footer-link">Help & Support</a></li>
                    <li><a href="about-us.php" class="footer-link">About Us</a></li>
                    <li><a href="apply.php" class="footer-link">Apply</a></li>
                    <li><a href="news-events.php" class="footer-link">News and Events</a></li>
                    <li><a href="contact-us.php" class="footer-link">Contact Us</a></li>
                </ul>

                <h5 class="fw-bold mt-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">About Our Loans</a></li>
                    <li><a href="#" class="footer-link">Apply Online</a></li>
                    <li><a href="#" class="footer-link">Affordability Assessment</a></li>
                    <li><a href="#" class="footer-link">Accepted IDs</a></li>
                    <li><a href="#" class="footer-link">Loan Calculator</a></li>
                    <li><a href="#" class="footer-link">FAQs</a></li>
                    <li><a href="help-support.php" class="footer-link">Help & Support</a></li>
                    <li><a href="#" class="footer-link">Find Us</a></li>
                    <li><a href="#" class="footer-link">Data Privacy Notice</a></li>
                    <li><a href="#" class="footer-link">Site Map</a></li>
                </ul>
            </div>

            <!-- Right Section: Contact Info -->
            <div class="col-md-4">
                <h5 class="fw-bold">Contact Us</h5>
                <p><i class="fas fa-map-marker-alt text-primary me-2"></i> <strong>Main Office:</strong> 123 Business Center, Makati City, Philippines</p>
                <p><i class="fas fa-phone text-primary me-2"></i> <strong>Customer Service:</strong> (02) 1234-5678</p>
                <p><i class="fas fa-envelope text-primary me-2"></i> <strong>Help & Support:</strong> support@unladplusloan.com</p>
                <p><i class="fas fa-user text-primary me-2"></i> <strong>Careers:</strong> careers@unladplusloan.com</p>
                <p><i class="fas fa-exclamation-circle text-primary me-2"></i> <strong>Complaints:</strong> complaints@unladplusloan.com</p>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="text-center mt-4 pt-3 border-top border-secondary">
            <p class="mb-0">&copy; 2025 UNLAD PLUS LOAN. ALL RIGHTS RESERVED.</p>
            <p class="mb-0">WEBSITE BY UNLAD PLUS LOAN TEAM</p>
        </div>
    </div>
</footer>

</body>
</html>