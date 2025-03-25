<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCREDIT</title>
    <meta name="description" content="QCREDIT - Delivering financial access to everyone. Learn about our loans, services, and how we empower small businesses.">
    <meta name="keywords" content="QCREDIT, loans, financial access, small businesses, market vendor loan">
    <meta name="author" content="QCREDIT Corp.">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .vision_mission {
            color: black;
        }
        /* Add hover effects for buttons */
        .btn-primary, .btn-danger {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-primary:hover, .btn-danger:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Add hover effects for links */
        .footer-link:hover {
            text-decoration: underline;
            color: #ff5722;
        }

        /* Add animation to sections */
        section {
            animation: fadeInUp 1s ease-in-out;
        }

        /* Style for carousel buttons */
        .carousel button {
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
            color: white;
            font-size: 1.5rem;
            padding: 0.5rem 1rem;
            cursor: pointer;
        }
        .carousel button:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Add background gradient to footer */
        footer {
            background: linear-gradient(45deg, #333, #555);
        }

        /* Header Section */
        .top-bar {
            padding: 1rem 0;
        }
        .logo-img {
            max-height: 50px;
        }
        .brand-name {
            font-size: 1.25rem;
        }

        /* Navigation Bar */
        .navbar-nav .nav-link {
            padding: 0.5rem 1rem;
        }
        .navbar-toggler {
            border: none;
        }

        /* Hero Section */
        .carousel-inner img {
            max-height: 500px;
            object-fit: cover;
        }
        .carousel-caption {
            background: rgba(0, 0, 0, 0.5);
            padding: 1rem;
            border-radius: 0.5rem;
        }

        /* About Section */
        .about-section {
            padding: 3rem 1rem;
        }
        .about-text h2 {
            font-size: 2rem;
        }
        .about-image img {
            max-width: 100%;
            height: auto;
        }

        /* Services Section */
        .our-services-section img {
            max-width: 100%;
            height: auto;
        }
        .our-services-section h2 {
            font-size: 2rem;
        }

        /* Brochure Section */
        .brochure-section .carousel {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .brochure-section .carousel-images img {
            max-width: 100%;
            height: auto;
        }

        /* Mission & Vision Section */
        .mission-vision-section .col-lg-4 {
            margin-bottom: 1.5rem;
        }

        /* Footer Section */
        footer {
            padding: 2rem 1rem;
        }
        footer .btn-sm {
            font-size: 0.875rem;
        }
        footer ul {
            padding-left: 0;
            list-style: none;
        }
        footer ul li {
            margin-bottom: 0.5rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .about-content {
                flex-direction: column;
            }
            .about-text {
                margin-bottom: 2rem;
            }
            .navbar-nav {
                flex-direction: column;
            }
            .navbar-nav .nav-link {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    
<!-- Header Section -->
<header class="top-bar bg-light py-2 border-bottom shadow-sm" role="banner">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo Section -->
            <div class="col-12 col-md-3 d-flex align-items-center">
                <img src="Images/logo.jpg" alt="QCREDIT Logo" class="logo-img me-2">
                <span class="brand-name fw-bold text-danger">QCREDIT</span>
            </div>

            <!-- Contact & Links -->
            <nav class="col-12 col-md-7" aria-label="Main Contact Links">
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
                <a href="loan-account-inquiry.html" class="btn btn-danger text-white px-3 py-1 fw-bold fs-7">LOAN ACCOUNT INQUIRY</a>
            </div>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark position-sticky top-0 w-100 z-3 border-bottom border-white border-opacity-50" role="navigation">
        <div class="container">
            <!-- Collapsible Navigation -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav text-center">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="loans.php">Loans</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="help-support.php">Help & Support</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="consumer-protection.php">Consumer Protection</a></li>
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

<!-- About Us Main Content -->
<section class="about-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>ABOUT <strong>QCREDIT</strong></h2>
                <p>QCREDIT Corp. is a trusted lending company in the Philippines, dedicated to empowering small and medium-sized businesses through accessible financial solutions.</p>
                <p>With a strong presence nationwide, we aim to uplift the lives of Filipino entrepreneurs by providing the necessary financial support to grow their businesses.</p>
                <p>Our mission is to be a lending company with a heart, delivering exceptional service and fostering long-term relationships with our customers.</p>
                <a href="contact-us.php" class="btn btn-primary" aria-label="Contact Us">CONTACT US</a>
            </div>
            <div class="col-md-6">
                <img src="Images/about-us.jpg" alt="About QCREDIT" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- Our Services Section -->
<section class="our-services-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="Images/services.jpg" alt="Our Services" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h2>OUR <strong>SERVICES</strong></h2>
                <p>Market Vendor Loan (MVL) remains QCREDIT’s flagship service, serving over half a million customers. With MVL, QCREDIT empowers small enterprises to achieve financial freedom.</p>
                <p>In partnership with BDO Unibank Inc., QCREDIT offers BDO Cash Cards, providing customers with secure ATM access without requiring a deposit account.</p>
                <a href="loans.php" class="btn btn-primary" aria-label="Learn More About Our Services">LEARN MORE</a>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="mission-vision-section py-5 bg-light">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-4">
                <h3>MISSION</h3>
                <p>To provide speedy and accessible collateral-free loans to small and medium enterprises, improving the quality of life for every Filipino.</p>
            </div>
            <div class="col-md-4">
                <h3>VISION</h3>
                <p>To be a leading lending company in the Philippines, exemplifying a "lending company with a heart" in all business dealings.</p>
            </div>
            <div class="col-md-4">
                <h3>OUR PEOPLE</h3>
                <p>Our employees are the foundation of our success, delivering the best service with passion and energy.</p>
            </div>
        </div>
    </div>
</section>

<!-- Brochure Section -->
<section class="brochure-section py-5">
    <div class="container text-center">
        <h2>DOWNLOAD <strong>OUR BROCHURE</strong></h2>
        <p>Learn more about QCREDIT and our services by downloading our brochure.</p>
        <a href="brochure.pdf" download class="btn btn-primary" aria-label="Download Brochure">DOWNLOAD NOW</a>
    </div>
</section>

<!-- Our Values Section -->
<section class="our-values-section py-5 bg-light">
    <div class="container text-center">
        <h2>OUR <strong>VALUES</strong></h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <h5>Integrity</h5>
                <p>We uphold transparency and fairness in all our dealings.</p>
            </div>
            <div class="col-md-4">
                <h5>Customer Focus</h5>
                <p>Our customers are at the heart of everything we do.</p>
            </div>
            <div class="col-md-4">
                <h5>Innovation</h5>
                <p>We continuously improve to meet the evolving needs of our clients.</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="bg-dark text-white py-5" role="contentinfo">
    <div class="container">
        <div class="row">
            <!-- Left Section: Company Info -->
            <div class="col-md-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="Images/logo.jpg" alt="QCREDIT Logo" height="40" class="me-2">
                    <p class="mb-0"><strong>QCREDIT CORP.</strong></p>
                </div>
                <p>SEC Reg. No. CS201738217</p>
                <p>Certificate of Authority No. 2617</p>
                <p>Please study the terms and conditions in the disclosure statement before proceeding with your loan transaction.</p>
                
                <!-- Social Media Icons -->
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-danger btn-sm" aria-label="Facebook" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" aria-label="YouTube" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" aria-label="LinkedIn" rel="noopener noreferrer"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" aria-label="TikTok" rel="noopener noreferrer"><i class="fab fa-tiktok"></i></a>
                </div>

                <img src="Images/SEAL.jpg" alt="DPO DPS Certificate" class="mt-3 img-fluid" width="150">
            </div>

            <!-- Middle Section: Menu & Quick Links -->
            <div class="col-md-4">
                <h5 class="fw-bold">Menu</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">Home</a></li>
                    <li><a href="#" class="footer-link">Loans</a></li>
                    <li><a href="#" class="footer-link">Help & Support</a></li>
                    <li><a href="#" class="footer-link">Consumer Protection</a></li>
                    <li><a href="#" class="footer-link">About Us</a></li>
                    <li><a href="#" class="footer-link">Careers</a></li>
                    <li><a href="#" class="footer-link">News and Events</a></li>
                    <li><a href="#" class="footer-link">Contact Us</a></li>
                </ul>

                <h5 class="fw-bold mt-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">About MVL</a></li>
                    <li><a href="#" class="footer-link">Apply Online</a></li>
                    <li><a href="#" class="footer-link">Affordability Assessment</a></li>
                    <li><a href="#" class="footer-link">Accepted IDs</a></li>
                    <li><a href="#" class="footer-link">Loan Calculator</a></li>
                    <li><a href="#" class="footer-link">FAQs</a></li>
                    <li><a href="#" class="footer-link">Help & Support</a></li>
                    <li><a href="#" class="footer-link">Find Us</a></li>
                    <li><a href="#" class="footer-link">Data Privacy Notice</a></li>
                    <li><a href="#" class="footer-link">Site Map</a></li>
                </ul>
            </div>

            <!-- Right Section: Contact Info -->
            <div class="col-md-4">
                <h5 class="fw-bold">Contact Us</h5>
                <p><i class="fas fa-map-marker-alt text-danger"></i> <strong>Main Office:</strong> 2602 Antel 2000 Corporate Center, 121 Valero Street, Salcedo Village, Barangay Bel-air, Makati City 1227, Philippines</p>
                <p><i class="fas fa-phone text-danger"></i> <strong>Trunkline:</strong> (02) 5310-2796 loc. 5100</p>
                <p><i class="fas fa-envelope text-danger"></i> <strong>Help & Support:</strong> wecare@qcreditcorp.net</p>
                <p><i class="fas fa-user text-danger"></i> <strong>Hiring:</strong> hiring@qcreditcorp.net</p>
                <p><i class="fas fa-exclamation-circle text-danger"></i> <strong>Complaint:</strong> ireport@qcreditcorp.net</p>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="text-center mt-4">
            <p class="mb-0">&copy; 2025 QCREDIT CORP. ALL RIGHTS RESERVED.</p>
            <p class="mb-0">WEBSITE BY WEB DESIGN PHILIPPINES</p>
        </div>
    </div>
</footer>
</body>
</html>
