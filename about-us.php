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
    </style>
</head>
<body>
    
<!-- Header Section -->
<header class="top-bar bg-light py-2 border-bottom shadow-sm" role="banner">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo Section -->
            <div class="col-12 col-md-3 d-flex align-items-center">
                <img src="Images/logo.jpg" alt="QCREDIT Logo" class="logo-img me-2" height="50">
                <span class="brand-name fw-bold text-danger fs-5">QCREDIT</span>
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
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark position-absolute top-0 start-0 w-100 z-3 border-bottom border-white border-opacity-50" role="navigation">
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
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Images/banner1.jpg" class="d-block w-100" alt="Empowering Small Businesses Banner">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-white">Empowering Small Businesses</h5>
                    <p>Join thousands of entrepreneurs achieving financial freedom.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="Images/banner2.jpg" class="d-block w-100" alt="Trusted Lending Partner Banner">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-white">Your Trusted Lending Partner</h5>
                    <p>Providing accessible loans nationwide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </section>

        <!-- Who We Are Section -->
    <section class="about-section py-5 bg-light">
        <div class="container">
            <div class="about-content d-flex flex-column flex-md-row align-items-center">
                <article class="about-text me-md-4 text-black">
                    <h2>WHO <strong>WE ARE</strong></h2>
                    <p class="vision_mission">QCredit Corp. is a domestic corporation organized and existing under Philippine laws. It is a lending company aiming to provide micro-finance to small and medium-sized business establishments all over the Philippines.</p>
                    <p class="vision_mission">It aims to uplift the lives of Filipino business owners by providing them with the necessary financing to continue their businesses. Aside from providing credit, QCredit cares greatly for its customers. At the core of QCredit is its vision to be a lending company with a heart.</p>
                    <p class="vision_mission">QCredit enjoys the patronage of thousands of borrowers in 79 strong branches nationwide.</p>
                    <a href="#" class="btn btn-primary" aria-label="Contact Us"> <span>➤</span> CONTACT US</a>
                </article>
                <figure class="about-image animate__animated animate__fadeInRight">
                    <img src="Images/logo.jpg" alt="QCredit Office" class="img-fluid rounded shadow" loading="lazy">
                </figure>
            </div>
        </div>
    </section>

<!-- OUR SERVICES Section -->
<section class="our-services-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center text-black">
            <!-- Image Column -->
            <div class="col-lg-6">
                <img src="Images/DefaultCat.jpg" alt="Our Services" class="img-fluid rounded shadow">
            </div>
            <!-- Text Column -->
            <div class="col-lg-6">
                <h2 class="fw-bold">OUR <span class="text-primary">SERVICES</span></h2>
                <p class="vision_mission">Market Vendor Loan (MVL) remains to be QCREDIT’s flagship service, which has served more than half a million customers over the past years. With MVL, QCREDIT aims to unleash potential in every small enterprise and help them achieve financial freedom in the near future.</p>
                <p class="vision_mission">In partnership with BDO Unibank Inc., QCREDIT offers BDO Cash Cards in all our branches nationwide. Market Vendor Loan (MVL) customers can enjoy the security of an ATM card without having to open a deposit account at a minimal fee.</p>
                <a href="#" class="btn btn-primary">KNOW HOW TO APPLY</a>
            </div>
        </div>
    </div>
</section>

<!-- Brochure Section -->
<section class="brochure-section py-5">
    <div class="container px-4 text-center text-black">
        <div class="row gx-5 align-items-center">
            <!-- Carousel (Left Side) -->
            <div class="col-lg-8 col-md-7 col-12">
                <div class="carousel">
                    <button class="prev">&#10094;</button>
                    <div class="carousel-images">
                        <img src="Images/logo.jpg" alt="Brochure Page 1" class="active">
                    </div>
                    <button class="next">&#10095;</button>
                </div>
            </div>

            <!-- Download Section (Right Side) -->
            <div class="col-lg-4 col-md-5 col-12 text-md-start text-center">
                <h2>DOWNLOAD <strong>OUR BROCHURE</strong></h2>
                <a href="brochure.pdf" download class="btn-primary">
                    <span>⬇</span> CLICK TO DOWNLOAD
                </a>
            </div>
        </div>
    </div>
</section>

<!-- MISSION & VISION Section -->
<section class="mission-vision-section py-5 bg-light">
    <div class="container text-center text-black">
        <div class="row align-items-center g-4">
            <!-- Mission Column -->
            <div class="col-lg-4 col-md-6">
                <div class="p-3 border bg-white rounded">
                    <img src="Images/DefaultCat.jpg" alt="Mission Icon" class="mb-3" height="50">
                    <h3 class="fw-bold">MISSION</h3>
                    <p class="vision_mission">QCREDIT's mission is to provide speedy and accessible collateral-free loans to small and medium enterprises. It is passionate about helping and improving the quality of life of every Filipino individual, without compromising its commitment to making its customers first in all its ventures.</p>
                </div>
            </div>
            <!-- Vision Column -->
            <div class="col-lg-4 col-md-6">
                <div class="p-3 border bg-white rounded">
                    <img src="Images/DefaultCat.jpg" alt="Vision Icon" class="mb-3" height="50">
                    <h3 class="fw-bold">VISION</h3>
                    <p class="vision_mission">QCREDIT aims to be a leading lending company in the Philippines with the best interests of its customers at heart. It is dedicated to exemplify its vision as a "lending company with a heart" in all of its business dealings and transactions.</p>
                </div>
            </div>
            <!-- Our People Column -->
            <div class="col-lg-4 col-md-12">
                <div class="p-3 border bg-white rounded">
                    <img src="Images/DefaultCat.jpg" alt="Our People Icon" class="mb-3" height="50">
                    <h3 class="fw-bold">OUR PEOPLE</h3>
                    <p class="vision_mission">QCREDIT's employees are the very foundation of its success. Passion and energy fuel every person in QCREDIT Corp. to deliver the best service it can give to its customers.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- OUR VALUES Section -->
<section class="our-values-section py-5 bg-light">
    <div class="container text-center text-black">
        <div class="row align-items-center g-4">
            <!-- Advocacy Column -->
            <div class="col-lg-4 col-md-6">
                <div class="p-3 border bg-white rounded">
                    <h3 class="fw-bold text-primary">ADVOCACY</h3>
                    <p class="vision_mission">We advocate for delivering financial access to reach unbanked members of society and to help Filipinos grow their businesses.</p>
                </div>
            </div>
            <!-- Integrity Column -->
            <div class="col-lg-4 col-md-6">
                <div class="p-3 border bg-white rounded">
                    <h3 class="fw-bold text-primary">INTEGRITY</h3>
                    <p class="vision_mission">We uphold integrity by treating consumers fairly and with respect and upholding their rights, like transparency.</p>
                </div>
            </div>
            <!-- Mutual Effort Column -->
            <div class="col-lg-4 col-md-12">
                <div class="p-3 border bg-white rounded">
                    <h3 class="fw-bold text-primary">MUTUAL EFFORT</h3>
                    <p class="vision_mission">We build strong work relationships that foster trust and accountability to achieve a common goal: the sustainability and success of QCREDIT.</p>
                </div>
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
