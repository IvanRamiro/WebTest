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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    
<!-- Header Section -->
<header>
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

    
<!-- Careers Section -->
<section class="careers-section py-5">
    <div class="container">
        <div class="row">
            <!-- Job Listings -->
            <div class="col-md-6">
                <h2 class="fw-bold mb-4">Job Openings</h2>
                <div class="accordion" id="jobAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Audit Staff
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#jobAccordion">
                            <div class="accordion-body">
                                <p><strong>Work Location:</strong> Field Work</p>
                                <p><strong>Education:</strong> Graduate of any 4-year course</p>
                                <p><strong>Job Summary:</strong> Responsible for the performance of audit work programs to ensure compliance of policies and other internal control systems.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Legal Clerk
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#jobAccordion">
                            <div class="accordion-body">
                                <!-- Add job details here -->
                                <p>Details for Legal Clerk...</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Training and Development Officer
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#jobAccordion">
                            <div class="accordion-body">
                                <!-- Add job details here -->
                                <p>Details for Training and Development Officer...</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Risk and Data Analyst
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#jobAccordion">
                            <div class="accordion-body">
                                <!-- Add job details here -->
                                <p>Details for Risk and Data Analyst...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Apply Form -->
            <div class="col-md-6">
                <h2 class="fw-bold mb-4">Quick Apply Form</h2>
                <form action="submit-application.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name <span class="text-danger">(Required)</span></label>
                        <input type="text" class="form-control" id="fullName" name="fullName" required>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position Applying for <span class="text-danger">(Required)</span></label>
                        <select class="form-select" id="position" name="position" required>
                            <option value="" disabled selected>Select Position</option>
                            <option value="Audit Staff">Audit Staff</option>
                            <option value="Legal Clerk">Legal Clerk</option>
                            <option value="Training and Development Officer">Training and Development Officer</option>
                            <option value="Risk and Data Analyst">Risk and Data Analyst</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address <span class="text-danger">(Required)</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number <span class="text-danger">(Required)</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="resume" class="form-label">File <span class="text-danger">(Required)</span></label>
                        <input type="file" class="form-control" id="resume" name="resume" required>
                        <small class="text-muted">Max. File size: 128 MB.</small>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="bg-dark text-white py-5" role="contentinfo">
    <div class="container">
        <div class="row">
            <!-- Left Section: Company Info -->
            <div class="col-md-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="Images/logo.jpg" alt="QCREDIT Logo" height="40" class="me-2">
                    <p class="mb-0"><strong>QCREDIT CORP.</strong></p>
                </div>
                <p>SEC Reg. No. CS201738217</p>
                <p>Certificate of Authority No. 2617</p>
                <p>Please study the terms and conditions in the disclosure statement before proceeding with your loan transaction.</p>
                
                <!-- Social Media Icons -->
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-danger btn-sm"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-danger btn-sm"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="btn btn-danger btn-sm"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="btn btn-danger btn-sm"><i class="fab fa-tiktok"></i></a>
                </div>

                <img src="Images/SEAL.jpg" alt="DPO DPS Certificate" class="mt-3 img-fluid" width="150">
            </div>

            <!-- Middle Section: Menu & Quick Links -->
            <div class="col-md-4 mb-4">
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
