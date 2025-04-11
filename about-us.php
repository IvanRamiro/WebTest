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
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo Section -->
            <div class="col-12 col-md-3 d-flex align-items-center mb-3 mb-md-0">
                <img src="Images/Logo.png" alt="FAST CASH Logo" class="logo-img me-2" height="50">
                <span class="brand-name fw-bold text-primary fs-5">FAST CASH</span>
            </div>

            <!-- Contact & Links -->
            <nav class="col-12 col-md-7 mb-3 mb-md-0" aria-label="Main Contact Links">
                <ul class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start gap-4 list-unstyled mb-0">
                    <li>
                        <p class="mb-0 text-center text-md-start"><strong>Customer Service</strong><br>
                            <a href="tel:(02)1234-5678">(02) 1234-5678</a>
                        </p>
                    </li>
                    <li>
                        <p class="mb-0 text-center text-md-start"><strong>Help & Support</strong><br>
                            <a href="mailto:support@fastcash.com">support@fastcash.com</a>
                        </p>
                    </li>
                    <li>
                        <p class="mb-0 text-center text-md-start"><strong>Careers</strong><br>
                            <a href="mailto:careers@fastcash.com">careers@fastcash.com</a>
                        </p>
                    </li>
                    <li>
                        <p class="mb-0 text-center text-md-start"><strong>Complaints</strong><br>
                            <a href="mailto:complaints@fastcash.com">complaints@fastcash.com</a>
                        </p>
                    </li>
                </ul>
            </nav>

            <!-- Loan Inquiry Button -->
            <div class="col-12 col-md-2 text-center text-md-end">
                <a href="login.php" class="btn btn-primary text-white px-3 py-1 fw-bold fs-7">Login</a>
            </div>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="hero"
    style="height: 500px; background: url('<?php echo $bg_image; ?>') no-repeat center center / cover;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark position-sticky top-0 w-100 z-3 border-bottom border-white border-opacity-50" role="navigation">
        <div class="container">
            <!-- Collapsible Navigation -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav text-center">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="help-support.php">Help & Support</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="about-us.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="careers.php">Careers</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="news-events.php">News and Events</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="contact-us.php">Contact Us</a></li>
                </ul>
            </div>
            <!-- Search Form (Responsive) -->
            <form class="d-none d-lg-flex ms-3" role="search" aria-label="Search the site">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-light" type="submit" aria-label="Submit search"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </nav>
</section>

   <!-- Main Content -->
   <main id="main-content">
        <!-- About FAST CASH Section -->
        <section class="py-5 bg-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <img src="Images/ABSOLUTE.jpg" alt="FAST CASH Team" class="img-fluid rounded shadow-lg animate__animated animate__fadeInLeft">
                    </div>
                    <div class="col-lg-6">
                        <h2 class="display-5 fw-bold text-danger mb-4">About <span class="text-dark">FAST CASH</span></h2>
                        <p class="lead">FAST CASH is a premier financial service provider in the Philippines, dedicated to delivering quick and reliable cash solutions to individuals and small businesses.</p>
                        <p>With a nationwide presence, we aim to provide immediate financial assistance when you need it most. Our mission is to offer hassle-free cash solutions with transparent terms and exceptional customer service.</p>
                        <div class="d-flex gap-3 mt-4">
                            <a href="contact-us.php" class="btn btn-danger px-4 py-2">Contact Us</a>
                            <a href="careers.php" class="btn btn-outline-danger px-4 py-2">Join Our Team</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Story Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold">Our <span class="text-danger">Story</span></h2>
                    <div class="divider mx-auto bg-danger"></div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-danger text-white mb-4 mx-auto">
                                    <i class="fas fa-rocket fa-2x"></i>
                                </div>
                                <h3 class="h4">Our Beginnings</h3>
                                <p>Founded in 2015, FAST CASH began with a simple goal: to provide quick financial solutions to Filipinos in urgent need of cash.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-danger text-white mb-4 mx-auto">
                                    <i class="fas fa-chart-line fa-2x"></i>
                                </div>
                                <h3 class="h4">Growth & Expansion</h3>
                                <p>Through our commitment to fast service and fair terms, we've expanded to serve customers across the Philippines.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-danger text-white mb-4 mx-auto">
                                    <i class="fas fa-bullseye fa-2x"></i>
                                </div>
                                <h3 class="h4">Future Vision</h3>
                                <p>We continue to innovate to provide even faster cash solutions through digital platforms while maintaining personal service.</p>
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
                    <h2 class="display-5 fw-bold">Our <span class="text-danger">Purpose</span></h2>
                    <div class="divider mx-auto bg-danger"></div>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-danger border-2 text-center">
                            <div class="card-body p-4">
                                <i class="fas fa-bullseye text-danger fa-3x mb-3"></i>
                                <h3 class="h4">Mission</h3>
                                <p>To provide immediate cash solutions with minimal requirements and maximum convenience for our customers.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-danger border-2 text-center">
                            <div class="card-body p-4">
                                <i class="fas fa-eye text-danger fa-3x mb-3"></i>
                                <h3 class="h4">Vision</h3>
                                <p>To be the most trusted quick cash provider in the Philippines, known for our speed, reliability, and customer care.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-danger border-2 text-center">
                            <div class="card-body p-4">
                                <i class="fas fa-users text-danger fa-3x mb-3"></i>
                                <h3 class="h4">Our People</h3>
                                <p>Our team is committed to providing friendly, professional service with every transaction.</p>
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
                    <h2 class="display-5 fw-bold">Our <span class="text-danger">Core Values</span></h2>
                    <div class="divider mx-auto bg-danger"></div>
                    <p class="lead mx-auto" style="max-width: 700px;">These principles guide everything we do at FAST CASH and define how we serve our customers.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm hover-shadow">
                            <div class="card-body p-4 text-center">
                                <div class="value-icon bg-danger text-white mb-3 mx-auto">
                                    <i class="fas fa-balance-scale fa-2x"></i>
                                </div>
                                <h3 class="h4">Integrity</h3>
                                <p>We conduct all transactions with honesty and transparency, ensuring fair terms for our customers.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm hover-shadow">
                            <div class="card-body p-4 text-center">
                                <div class="value-icon bg-danger text-white mb-3 mx-auto">
                                    <i class="fas fa-user-friends fa-2x"></i>
                                </div>
                                <h3 class="h4">Customer Focus</h3>
                                <p>We prioritize our customers' needs, providing solutions tailored to their specific situations.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm hover-shadow">
                            <div class="card-body p-4 text-center">
                                <div class="value-icon bg-danger text-white mb-3 mx-auto">
                                    <i class="fas fa-lightbulb fa-2x"></i>
                                </div>
                                <h3 class="h4">Speed</h3>
                                <p>We continuously streamline our processes to deliver the fastest cash solutions possible.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-5 bg-danger text-white">
            <div class="container">
                <div class="row g-4 text-center">
                    <div class="col-md-3">
                        <div class="display-4 fw-bold">250K+</div>
                        <p class="mb-0">Customers Served</p>
                    </div>
                    <div class="col-md-3">
                        <div class="display-4 fw-bold">50+</div>
                        <p class="mb-0">Branches Nationwide</p>
                    </div>
                    <div class="col-md-3">
                        <div class="display-4 fw-bold">500+</div>
                        <p class="mb-0">Employees</p>
                    </div>
                    <div class="col-md-3">
                        <div class="display-4 fw-bold">8+</div>
                        <p class="mb-0">Years of Service</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-5 bg-white">
            <div class="container text-center">
                <h2 class="display-5 fw-bold mb-4">Need Cash Fast?</h2>
                <p class="lead mb-4">Discover how FAST CASH can provide the financial solution you need.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="loans.php" class="btn btn-danger btn-lg px-4">Apply Now</a>
                    <a href="contact-us.php" class="btn btn-outline-danger btn-lg px-4">Contact Us</a>
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
                    <img src="Images/Logo.png" alt="Fast Cash Logo" height="40" class="me-2">
                    <p class="mb-0"><strong>FAST CASH</strong></p>
                </div>
                <p>SEC Reg. No. CS202300001</p>
                <p>Certificate of Authority No. 1234</p>
                <p>Please study the terms and conditions in the disclosure statement before proceeding with your loan transaction.</p>
                
                <!-- Social Media Icons -->
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-primary btn-sm"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-primary btn-sm"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="btn btn-primary btn-sm"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="btn btn-primary btn-sm"><i class="fab fa-tiktok"></i></a>
                </div>

                <img src="Images/SEAL.jpg" alt="DPO DPS Certificate" class="mt-3 img-fluid" width="150">
            </div>

            <!-- Middle Section: Menu & Quick Links -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Menu</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="footer-link">Home</a></li>
                    <li><a href="#" class="footer-link">Loans</a></li>
                    <li><a href="help-support.php" class="footer-link">Help & Support</a></li>
                    <li><a href="#" class="footer-link">Consumer Protection</a></li>
                    <li><a href="about-us.php" class="footer-link">About Us</a></li>
                    <li><a href="careers.php" class="footer-link">Careers</a></li>
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
                <p><i class="fas fa-envelope text-primary me-2"></i> <strong>Help & Support:</strong> support@fastcash.com</p>
                <p><i class="fas fa-user text-primary me-2"></i> <strong>Careers:</strong> careers@fastcash.com</p>
                <p><i class="fas fa-exclamation-circle text-primary me-2"></i> <strong>Complaints:</strong> complaints@fastcash.com</p>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="text-center mt-4 pt-3 border-top border-secondary">
            <p class="mb-0">&copy; 2025 FAST CASH. ALL RIGHTS RESERVED.</p>
            <p class="mb-0">WEBSITE BY FAST CASH TEAM</p>
        </div>
    </div>
</footer>

</body>
</html>