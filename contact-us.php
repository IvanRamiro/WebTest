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
    <meta name="description" content="FAST CASH - Delivering financial access to everyone...">
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
                <img src="Images/UNLAD.PNG" alt="UNLAD PLUS LOAN" class="logo-img me-2" height="50">
                <span class="brand-name fw-bold fs-5">UNLAD PLUS LOAN</span>
            </div>

            <!-- Contact & Links -->
            <nav class="col-12 col-md-7 mb-3 mb-md-0" aria-label="Main Contact Links">
                <ul class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start gap-4 list-unstyled mb-0">
                    <li>
                        <p class="mb-0 text-center text-md-start"><strong>Customer Service</strong><br>
                            <a href="tel:(02)5310-2796">(02) 1234-5678</a>
                        </p>
                    </li>
                    <li>
                        <p class="mb-0 text-center text-md-start"><strong>Help & Support</strong><br>
                            <a href="mailto:support@unladplusloan.com">support@unladplusloan.com</a>
                        </p>
                    </li>
                    <li>
                        <p class="mb-0 text-center text-md-start"><strong>Careers</strong><br>
                            <a href="mailto:careers@unladplusloan.com">careers@unladplusloan.com</a>
                        </p>
                    </li>
                    <li>
                        <p class="mb-0 text-center text-md-start"><strong>Complaints</strong><br>
                            <a href="mailto:complaints@unladplusloan.com">complaints@unladplusloan.com</a>
                        </p>
                    </li>
                </ul>
            </nav>

            <!-- Loan Inquiry Button -->
            <div class="col-12 col-md-2 text-center text-md-end">
                <a href="login.php" class="btn text-white px-3 py-1 fw-bold fs-7" style="background-color: var(--main-color);">Login</a>
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
        <!-- Search Form (Responsive) -->
        <form class="d-none d-lg-flex ms-3" role="search" aria-label="Search the site">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-light" type="submit" aria-label="Submit search"><i class="fas fa-search"></i></button>
        </form>
    </div>
</nav>
</section>

<!-- Main Content Container -->
<main class="container my-5">
    <!-- Page Header -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="fw-bold display-5">Contact <span style="color: var(--main-color);">Unlad Plus Loan</span></h1>
            <p class="lead">We're here to help you grow. Reach out through any of our channels.</p>
        </div>
    </div>

    <!-- Contact Options Section -->
    <div class="row g-4">
        <!-- Contact Form Column -->
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body p-4">
                    <h2 class="card-title fw-bold mb-4">Send Us a Message</h2>
                    <form action="send-mail.php" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <select class="form-select" id="subject" name="subject">
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="Loan Application">Loan Application</option>
                                <option value="Customer Support">Customer Support</option>
                                <option value="Complaint">Complaint</option>
                                <option value="Career Inquiry">Career Inquiry</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn w-100 py-2" style="background-color: var(--main-color); color: white;">Send Message</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Info Column -->
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body p-4">
                    <h2 class="card-title fw-bold mb-4">Our Offices</h2>
                    
                    <!-- Map -->
                    <div class="map-container mb-4 rounded overflow-hidden">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.123456789012!2d120.987654321!3d14.654321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b123456789ab%3A0x1234567890abcdef!2sGudlyf%20Property%20Corp.%2C%20Grace%20Westpark%2C%20Caloocan%20City!5e0!3m2!1sen!2sph!4v1234567890" 
                            width="100%" 
                            height="250" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            aria-label="Unlad Plus Loan Caloocan Office Location">
                        </iframe>
                    </div>
                    
                    <!-- Office Locations -->
                    <div class="office-info mb-4">
                        <h3 class="h5 fw-bold"><i class="fas fa-building me-2" style="color: var(--main-color);"></i> Caloocan Head Office</h3>
                        <p class="ms-4">
                            Gudlyf Property Corp., Grace Westpark<br>
                            Caloocan City, Metro Manila<br>
                            <strong>Tel:</strong> <a href="tel:(02)1234-5678" class="text-decoration-none">(02) 1234-5678</a>
                        </p>
                    </div>
                    
                    <div class="office-info">
                        <h3 class="h5 fw-bold"><i class="fas fa-map-marker-alt me-2" style="color: var(--main-color);"></i> CDO Sub Office</h3>
                        <p class="ms-4">
                            1267 Bolonsiri Road, Camaman-an,<br>
                            Cagayan de Oro City 9000<br>
                            <strong>Tel:</strong> <a href="tel:(088)327-9462" class="text-decoration-none">(088) 327-9462</a>
                        </p>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Quick Contacts -->
                    <div class="quick-contacts">
                        <h3 class="h5 fw-bold mb-3">Quick Contacts</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-envelope me-2" style="color: var(--main-color);"></i>
                                <strong>General:</strong> <a href="mailto:wecare@unladplusloan.com" class="text-decoration-none">wecare@unladplusloan.com</a>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-user-tie me-2" style="color: var(--main-color);"></i>
                                <strong>Hiring:</strong> <a href="mailto:hiring@unladplusloan.com" class="text-decoration-none">hiring@unladplusloan.com</a>
                            </li>
                            <li>
                                <i class="fas fa-exclamation-triangle me-2" style="color: var(--main-color);"></i>
                                <strong>Complaints:</strong> <a href="mailto:complaints@unladplusloan.com" class="text-decoration-none">complaints@unladplusloan.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Departments Section -->
    <section class="mt-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="card-title fw-bold mb-4 text-center">Our <span style="color: var(--main-color);">Departments</span></h2>
                <div class="row g-4">
                    <!-- Department Cards -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100" style="border-color: var(--main-color);">
                            <div class="card-body">
                                <h3 class="h5 fw-bold" style="color: var(--main-color);">
                                    <i class="fas fa-shield-alt me-2"></i>Consumer Protection
                                </h3>
                                <ul class="list-unstyled mt-3">
                                    <li><strong>Hotline:</strong> (02) 1234-5678</li>
                                    <li><strong>Extensions:</strong> 7019, 5557</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100" style="border-color: var(--main-color);">
                            <div class="card-body">
                                <h3 class="h5 fw-bold" style="color: var(--main-color);">
                                    <i class="fas fa-users me-2"></i>Human Resources
                                </h3>
                                <ul class="list-unstyled mt-3">
                                    <li><strong>Email:</strong> hiring@unladplusloan.com</li>
                                    <li><strong>Phone:</strong> (02) 1234-5678 loc. 5101</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100" style="border-color: var(--main-color);">
                            <div class="card-body">
                                <h3 class="h5 fw-bold" style="color: var(--main-color);">
                                    <i class="fas fa-credit-card me-2"></i>Loan Services
                                </h3>
                                <ul class="list-unstyled mt-3">
                                    <li><strong>Email:</strong> loans@unladplusloan.com</li>
                                    <li><strong>Phone:</strong> (02) 1234-5678 loc. 5102</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100" style="border-color: var(--main-color);">
                            <div class="card-body">
                                <h3 class="h5 fw-bold" style="color: var(--main-color);">
                                    <i class="fas fa-gavel me-2"></i>Legal Department
                                </h3>
                                <ul class="list-unstyled mt-3">
                                    <li><strong>Email:</strong> legal@unladplusloan.com</li>
                                    <li><strong>Phone:</strong> (02) 1234-5678 loc. 5103</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100" style="border-color: var(--main-color);">
                            <div class="card-body">
                                <h3 class="h5 fw-bold" style="color: var(--main-color);">
                                    <i class="fas fa-search-dollar me-2"></i>Audit Department
                                </h3>
                                <ul class="list-unstyled mt-3">
                                    <li><strong>Email:</strong> audit@unladplusloan.com</li>
                                    <li><strong>Phone:</strong> (02) 1234-5678 loc. 5104</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100" style="border-color: var(--main-color);">
                            <div class="card-body">
                                <h3 class="h5 fw-bold" style="color: var(--main-color);">
                                    <i class="fas fa-phone-volume me-2"></i>Customer Relations
                                </h3>
                                <ul class="list-unstyled mt-3">
                                    <li><strong>Email:</strong> customerservice@unladplusloan.com</li>
                                    <li><strong>Phone:</strong> (02) 1234-5678 loc. 5105</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
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