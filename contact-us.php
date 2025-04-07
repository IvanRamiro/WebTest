<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | QCREDIT</title>
    <meta name="description" content="Contact QCREDIT for loans, financial services, or support. Find our offices, departments, and contact information.">
    <meta name="keywords" content="QCREDIT contact, loan inquiry, financial support, customer service">
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
<header class="bg-white shadow-sm">
    <div class="container">
        <div class="row align-items-center py-2">
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
                            <a href="tel:(02)5310-2796" class="text-decoration-none">(02) 5310-2796 loc. 5100</a>
                        </p>
                    </li>
                    <li>
                        <p class="mb-0 text-center text-md-start"><strong>Help & Support</strong><br>
                            <a href="mailto:wecare@qcreditcorp.net" class="text-decoration-none">wecare@qcreditcorp.net</a>
                        </p>
                    </li>
                    <li>
                        <p class="mb-0 text-center text-md-start"><strong>Hiring</strong><br>
                            <a href="mailto:hiring@qcreditcorp.net" class="text-decoration-none">hiring@qcreditcorp.net</a>
                        </p>
                    </li>
                </ul>
            </nav>

            <!-- Login Button -->
            <div class="col-12 col-md-2 text-center text-md-end">
                <a href="login.php" class="btn btn-danger text-white px-3 py-1 fw-bold">Login</a>
            </div>
        </div>
    </div>
</header>

<!-- Navigation Section -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="loans.php">Loans</a></li>
                <li class="nav-item"><a class="nav-link" href="help-support.php">Help & Support</a></li>
                <li class="nav-item"><a class="nav-link" href="consumer-protection.php">Consumer Protection</a></li>
                <li class="nav-item"><a class="nav-link" href="about-us.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="careers.php">Careers</a></li>
                <li class="nav-item"><a class="nav-link" href="news-events.php">News & Events</a></li>
                <li class="nav-item"><a class="nav-link active" href="contact-us.php">Contact Us</a></li>
            </ul>
        </div>
        <form class="d-none d-lg-flex ms-3" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
</nav>

<!-- Main Content Container -->
<main class="container my-5">
    <!-- Page Header -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="fw-bold display-5">Contact <span class="text-danger">QCREDIT</span></h1>
            <p class="lead">We're here to help. Reach out to us through any of the following channels.</p>
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
                        <button type="submit" class="btn btn-danger w-100 py-2">Send Message</button>
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
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1930.123456789!2d121.027724!3d14.553888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c9f123456789%3A0x123456789abcdef!2sMakati%20City!5e0!3m2!1sen!2sph!4v1234567890" 
                            width="100%" 
                            height="250" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            aria-label="QCREDIT Makati Office Location">
                        </iframe>
                    </div>
                    
                    <!-- Office Locations -->
                    <div class="office-info mb-4">
                        <h3 class="h5 fw-bold"><i class="fas fa-building text-danger me-2"></i> Makati Head Office</h3>
                        <p class="ms-4">
                            2602 Antel Corporate Center, 121 Valero Street,<br>
                            Salcedo Village, Bel-air, Makati City, 1227<br>
                            <strong>Tel:</strong> <a href="tel:(02)5310-2796" class="text-decoration-none">(02) 5310-2796 loc. 5100</a>
                        </p>
                    </div>
                    
                    <div class="office-info">
                        <h3 class="h5 fw-bold"><i class="fas fa-map-marker-alt text-danger me-2"></i> CDO Sub Office</h3>
                        <p class="ms-4">
                            1267 Bolonsiri Road, Camaman-an,<br>
                            Cagayan de Oro City 9000<br>
                            <strong>Tel:</strong> <a href="tel:(088)327-9462" class="text-decoration-none">(088) 327-9462 loc. 5100</a>
                        </p>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Quick Contacts -->
                    <div class="quick-contacts">
                        <h3 class="h5 fw-bold mb-3">Quick Contacts</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-envelope text-danger me-2"></i>
                                <strong>General:</strong> <a href="mailto:wecare@qcreditcorp.net" class="text-decoration-none">wecare@qcreditcorp.net</a>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-user-tie text-danger me-2"></i>
                                <strong>Hiring:</strong> <a href="mailto:hiring@qcreditcorp.net" class="text-decoration-none">hiring@qcreditcorp.net</a>
                            </li>
                            <li>
                                <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                                <strong>Complaints:</strong> <a href="mailto:ireport@qcreditcorp.net" class="text-decoration-none">ireport@qcreditcorp.net</a>
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
                <h2 class="card-title fw-bold mb-4 text-center">Our <span class="text-danger">Departments</span></h2>
                <div class="row g-4">
                    <!-- Department Cards -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-danger">
                            <div class="card-body">
                                <h3 class="h5 fw-bold text-danger">
                                    <i class="fas fa-shield-alt me-2"></i>Consumer Protection
                                </h3>
                                <ul class="list-unstyled mt-3">
                                    <li><strong>Hotline:</strong> (02) 5310-2796</li>
                                    <li><strong>Extensions:</strong> 7019, 5557</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-danger">
                            <div class="card-body">
                                <h3 class="h5 fw-bold text-danger">
                                    <i class="fas fa-users me-2"></i>Human Resources
                                </h3>
                                <ul class="list-unstyled mt-3">
                                    <li><strong>Email:</strong> hiring@qcreditcorp.net</li>
                                    <li><strong>Phone:</strong> (02) 5310-2796 loc. 5101</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-danger">
                            <div class="card-body">
                                <h3 class="h5 fw-bold text-danger">
                                    <i class="fas fa-credit-card me-2"></i>Cash Card Department
                                </h3>
                                <ul class="list-unstyled mt-3">
                                    <li><strong>Email:</strong> cashcard@qcreditcorp.net</li>
                                    <li><strong>Phone:</strong> (02) 5310-2796 loc. 5102</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-danger">
                            <div class="card-body">
                                <h3 class="h5 fw-bold text-danger">
                                    <i class="fas fa-gavel me-2"></i>Legal Department
                                </h3>
                                <ul class="list-unstyled mt-3">
                                    <li><strong>Email:</strong> legal@qcreditcorp.net</li>
                                    <li><strong>Phone:</strong> (02) 5310-2796 loc. 5103</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-danger">
                            <div class="card-body">
                                <h3 class="h5 fw-bold text-danger">
                                    <i class="fas fa-search-dollar me-2"></i>Audit Department
                                </h3>
                                <ul class="list-unstyled mt-3">
                                    <li><strong>Email:</strong> audit@qcreditcorp.net</li>
                                    <li><strong>Phone:</strong> (02) 5310-2796 loc. 5104</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-danger">
                            <div class="card-body">
                                <h3 class="h5 fw-bold text-danger">
                                    <i class="fas fa-phone-volume me-2"></i>Collection Unit
                                </h3>
                                <ul class="list-unstyled mt-3">
                                    <li><strong>Email:</strong> collection@qcreditcorp.net</li>
                                    <li><strong>Phone:</strong> (02) 5310-2796 loc. 5105</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Branch Network Section -->
    <section class="mt-5">
        <div class="card shadow-sm bg-danger text-white">
            <div class="card-body p-4 text-center">
                <h2 class="card-title fw-bold mb-3">Nationwide Branch Network</h2>
                <p class="lead mb-4">QCREDIT has more than 70 branches across the Philippines. Visit the branch most convenient for you.</p>
                <a href="branch-locator.php" class="btn btn-light text-danger fw-bold px-4">Find a Branch Near You</a>
            </div>
        </div>
    </section>
</main>

<!-- Footer Section -->
<footer class="bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row g-4">
            <!-- Company Info -->
            <div class="col-lg-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="Images/logo.jpg" alt="QCREDIT Logo" height="40" class="me-2">
                    <span class="fw-bold fs-5">QCREDIT CORP.</span>
                </div>
                <p>SEC Reg. No. CS201738217<br>
                Certificate of Authority No. 2617</p>
                <p>Please study the terms and conditions in the disclosure statement before proceeding with your loan transaction.</p>
                
                <div class="social-icons mb-3">
                    <a href="#" class="text-white me-2" aria-label="Facebook"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="#" class="text-white me-2" aria-label="YouTube"><i class="fab fa-youtube fa-lg"></i></a>
                    <a href="#" class="text-white me-2" aria-label="LinkedIn"><i class="fab fa-linkedin-in fa-lg"></i></a>
                    <a href="#" class="text-white" aria-label="TikTok"><i class="fab fa-tiktok fa-lg"></i></a>
                </div>
                
                <img src="Images/SEAL.jpg" alt="DPO DPS Certificate" class="img-fluid" width="150">
            </div>
            
            <!-- Quick Links -->
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">Menu</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                            <li class="mb-2"><a href="loans.php" class="text-white text-decoration-none">Loans</a></li>
                            <li class="mb-2"><a href="help-support.php" class="text-white text-decoration-none">Help & Support</a></li>
                            <li class="mb-2"><a href="consumer-protection.php" class="text-white text-decoration-none">Consumer Protection</a></li>
                            <li class="mb-2"><a href="about-us.php" class="text-white text-decoration-none">About Us</a></li>
                            <li><a href="careers.php" class="text-white text-decoration-none">Careers</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Apply Online</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Loan Calculator</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">FAQs</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Branch Locator</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Data Privacy Notice</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Site Map</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">Contact Information</h5>
                <address>
                    <p><i class="fas fa-map-marker-alt me-2"></i> 2602 Antel 2000 Corporate Center, 121 Valero Street, Salcedo Village, Makati City 1227</p>
                    <p><i class="fas fa-phone me-2"></i> (02) 5310-2796 loc. 5100</p>
                    <p><i class="fas fa-envelope me-2"></i> wecare@qcreditcorp.net</p>
                    <p><i class="fas fa-user me-2"></i> hiring@qcreditcorp.net</p>
                    <p><i class="fas fa-exclamation-circle me-2"></i> ireport@qcreditcorp.net</p>
                </address>
            </div>
        </div>
        
        <hr class="my-4">
        
        <!-- Copyright -->
        <div class="text-center">
            <p class="mb-0">&copy; 2025 QCREDIT CORP. ALL RIGHTS RESERVED.</p>
            <p class="mb-0">WEBSITE BY WEB DESIGN PHILIPPINES</p>
        </div>
    </div>
</footer>

</body>
</html>