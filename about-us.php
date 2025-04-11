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
    <title>QCREDIT</title>
    <meta name="description" content="QCREDIT - Delivering financial access to everyone...">
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
                <img src="Images/logo.jpg" alt="QCREDIT Logo" class="logo-img me-2" height="50">
                <span class="brand-name fw-bold text-danger fs-5">QCREDIT</span>
            </div>

            <!-- Contact & Links -->
            <nav class="col-12 col-md-7 mb-3 mb-md-0" aria-label="Main Contact Links">
                <ul class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start gap-4 list-unstyled mb-0">
                    <li>
                        <p class="mb-0 text-center text-md-start"><strong>Trunkline</strong><br>
                            <a href="tel:(02)5310-2796">(02) 5310-2796 loc. 5100</a>
                        </p>
                    </li>
                    <li>
                        <p class="mb-0 text-center text-md-start"><strong>Help & Support</strong><br>
                            <a href="mailto:wecare@qcreditcorp.net">wecare@qcreditcorp.net</a>
                        </p>
                    </li>
                    <li>
                        <p class="mb-0 text-center text-md-start"><strong>Hiring</strong><br>
                            <a href="mailto:hiring@qcreditcorp.net">hiring@qcreditcorp.net</a>
                        </p>
                    </li>
                    <li>
                        <p class="mb-0 text-center text-md-start"><strong>Complaints</strong><br>
                            <a href="mailto:ireport@qcreditcorp.net">ireport@qcreditcorp.net</a>
                        </p>
                    </li>
                </ul>
            </nav>

            <!-- Loan Inquiry Button -->
            <div class="col-12 col-md-2 text-center text-md-end">
                <a href="login.php" class="btn btn-danger text-white px-3 py-1 fw-bold fs-7">Login</a>
            </div>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="hero"
    style="height: 500px; background: url('<?php echo $bg_image; ?>') no-repeat center center / cover;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark position-sticky top-0 w-100 z-3 border-bottom border-white border-opacity-50" role="navigation">
        <!-- Your existing navbar content remains exactly the same -->
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
        <!-- About QCREDIT Section -->
        <section class="py-5 bg-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <img src="Images/ABSOLUTE.jpg" alt="QCREDIT Team" class="img-fluid rounded shadow-lg animate__animated animate__fadeInLeft">
                    </div>
                    <div class="col-lg-6">
                        <h2 class="display-5 fw-bold text-danger mb-4">About <span class="text-dark">QCREDIT</span></h2>
                        <p class="lead">QCREDIT Corp. is a trusted lending company in the Philippines, dedicated to empowering small and medium-sized businesses through accessible financial solutions.</p>
                        <p>With a strong presence nationwide, we aim to uplift the lives of Filipino entrepreneurs by providing the necessary financial support to grow their businesses. Our mission is to be a lending company with a heart, delivering exceptional service and fostering long-term relationships with our customers.</p>
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
                                <p>Founded in [Year], QCREDIT started with a vision to provide financial access to underserved market vendors and small business owners.</p>
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
                                <p>Through strategic partnerships and customer-focused services, we've expanded our reach to serve communities across the Philippines.</p>
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
                                <p>We continue to innovate our services to meet the evolving needs of Filipino entrepreneurs in the digital economy.</p>
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
                                <p>To provide speedy and accessible collateral-free loans to small and medium enterprises, improving the quality of life for every Filipino.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-danger border-2 text-center">
                            <div class="card-body p-4">
                                <i class="fas fa-eye text-danger fa-3x mb-3"></i>
                                <h3 class="h4">Vision</h3>
                                <p>To be a leading lending company in the Philippines, exemplifying a "lending company with a heart" in all business dealings.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-danger border-2 text-center">
                            <div class="card-body p-4">
                                <i class="fas fa-users text-danger fa-3x mb-3"></i>
                                <h3 class="h4">Our People</h3>
                                <p>Our employees are the foundation of our success, delivering the best service with passion and energy.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Services Section
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                        <img src="Images/services-image.jpg" alt="QCREDIT Services" class="img-fluid rounded shadow-lg animate__animated animate__fadeInRight">
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <h2 class="display-5 fw-bold text-danger mb-4">Our <span class="text-dark">Services</span></h2>
                        <div class="service-item mb-4">
                            <h3 class="h4"><i class="fas fa-store text-danger me-2"></i> Market Vendor Loan (MVL)</h3>
                            <p>Our flagship service, serving over half a million customers. With MVL, QCREDIT empowers small enterprises to achieve financial freedom.</p>
                        </div>
                        <div class="service-item mb-4">
                            <h3 class="h4"><i class="fas fa-credit-card text-danger me-2"></i> BDO Cash Cards</h3>
                            <p>In partnership with BDO Unibank Inc., we offer BDO Cash Cards, providing customers with secure ATM access without requiring a deposit account.</p>
                        </div>
                        <a href="loans.php" class="btn btn-danger px-4 py-2 mt-2">Explore Our Services</a>
                    </div>
                </div>
            </div>
        </section> //-->

          <!-- Our Values Section -->
        <section class="py-5 bg-white">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold">Our <span class="text-danger">Core Values</span></h2>
                    <div class="divider mx-auto bg-danger"></div>
                    <p class="lead mx-auto" style="max-width: 700px;">These principles guide everything we do at QCREDIT and define how we serve our customers and communities.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm hover-shadow">
                            <div class="card-body p-4 text-center">
                                <div class="value-icon bg-danger text-white mb-3 mx-auto">
                                    <i class="fas fa-balance-scale fa-2x"></i>
                                </div>
                                <h3 class="h4">Integrity</h3>
                                <p>We uphold transparency and fairness in all our dealings, building trust with every transaction.</p>
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
                                <p>Our customers are at the heart of everything we do. We listen, understand, and deliver solutions that meet their needs.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm hover-shadow">
                            <div class="card-body p-4 text-center">
                                <div class="value-icon bg-danger text-white mb-3 mx-auto">
                                    <i class="fas fa-lightbulb fa-2x"></i>
                                </div>
                                <h3 class="h4">Innovation</h3>
                                <p>We continuously improve our services and processes to meet the evolving needs of our clients in a changing world.</p>
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
                        <div class="display-4 fw-bold">500K+</div>
                        <p class="mb-0">Customers Served</p>
                    </div>
                    <div class="col-md-3">
                        <div class="display-4 fw-bold">100+</div>
                        <p class="mb-0">Branches Nationwide</p>
                    </div>
                    <div class="col-md-3">
                        <div class="display-4 fw-bold">1K+</div>
                        <p class="mb-0">Employees</p>
                    </div>
                    <div class="col-md-3">
                        <div class="display-4 fw-bold">10+</div>
                        <p class="mb-0">Years of Service</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-5 bg-white">
            <div class="container text-center">
                <h2 class="display-5 fw-bold mb-4">Ready to Grow Your Business?</h2>
                <p class="lead mb-4">Discover how QCREDIT can help you achieve your entrepreneurial dreams.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="loans.php" class="btn btn-danger btn-lg px-4">Apply for a Loan</a>
                    <a href="contact-us.php" class="btn btn-outline-danger btn-lg px-4">Contact Us</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="bg-dark text-white pt-5">
        <div class="container">
            <div class="row g-4">
                <!-- Company Info -->
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="Images/logo.jpg" alt="QCREDIT Logo" height="40" class="me-2">
                        <span class="fs-5 fw-bold">QCREDIT CORP.</span>
                    </div>
                    <p>SEC Reg. No. CS201738217</p>
                    <p>Certificate of Authority No. 2617</p>
                    <p>Please study the terms and conditions in the disclosure statement before proceeding with your loan transaction.</p>
                    
                    <div class="social-icons mt-3">
                        <a href="#" class="text-white me-2" aria-label="Facebook"><i class="fab fa-facebook-f fa-lg"></i></a>
                        <a href="#" class="text-white me-2" aria-label="YouTube"><i class="fab fa-youtube fa-lg"></i></a>
                        <a href="#" class="text-white me-2" aria-label="LinkedIn"><i class="fab fa-linkedin-in fa-lg"></i></a>
                        <a href="#" class="text-white" aria-label="TikTok"><i class="fab fa-tiktok fa-lg"></i></a>
                    </div>

                    <img src="Images/SEAL.jpg" alt="DPO DPS Certificate" class="mt-3 img-fluid" width="150">
                </div>

                <!-- Quick Links -->
                <div class="col-lg-4">
                    <h3 class="h5 mb-3">Quick Links</h3>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="index.php" class="text-white-50">Home</a></li>
                                <li class="mb-2"><a href="loans.php" class="text-white-50">Loans</a></li>
                                <li class="mb-2"><a href="help-support.php" class="text-white-50">Help & Support</a></li>
                                <li class="mb-2"><a href="#" class="text-white-50">Consumer Protection</a></li>
                                <li class="mb-2"><a href="about-us.php" class="text-white-50">About Us</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="careers.php" class="text-white-50">Careers</a></li>
                                <li class="mb-2"><a href="news-events.php" class="text-white-50">News & Events</a></li>
                                <li class="mb-2"><a href="contact-us.php" class="text-white-50">Contact Us</a></li>
                                <li class="mb-2"><a href="#" class="text-white-50">FAQs</a></li>
                                <li class="mb-2"><a href="#" class="text-white-50">Site Map</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-4">
                    <h3 class="h5 mb-3">Contact Us</h3>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                            <strong>Main Office:</strong> 2602 Antel 2000 Corporate Center, 121 Valero Street, Salcedo Village, Barangay Bel-air, Makati City 1227, Philippines
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone text-danger me-2"></i>
                            <strong>Trunkline:</strong> <a href="tel:(02)5310-2796" class="text-white-50">(02) 5310-2796 loc. 5100</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope text-danger me-2"></i>
                            <strong>Help & Support:</strong> <a href="mailto:wecare@qcreditcorp.net" class="text-white-50">wecare@qcreditcorp.net</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-user text-danger me-2"></i>
                            <strong>Hiring:</strong> <a href="mailto:hiring@qcreditcorp.net" class="text-white-50">hiring@qcreditcorp.net</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-exclamation-circle text-danger me-2"></i>
                            <strong>Complaint:</strong> <a href="mailto:ireport@qcreditcorp.net" class="text-white-50">ireport@qcreditcorp.net</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-top border-secondary mt-4 pt-3 text-center text-white-50">
                <p class="mb-1">&copy; 2025 QCREDIT CORP. ALL RIGHTS RESERVED.</p>
                <p class="mb-0">WEBSITE BY WEB DESIGN PHILIPPINES</p>
            </div>
        </div>
    </footer>
</body>
</html>
