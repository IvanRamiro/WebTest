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
    <title>Help & Support | QCREDIT</title>
    <meta name="description" content="Get help with your QCREDIT account, loans, and services. Contact our customer support team for assistance.">
    <meta name="keywords" content="QCREDIT help, customer support, loan assistance, contact QCREDIT">
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
<section class="hero" style="height: 500px; background: url('<?php echo $bg_image; ?>') no-repeat center center/cover;">
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
    
    <!-- Hero Content -->
    <div class="container h-100 d-flex align-items-center">
        <div class="row justify-content-center w-100">
            <div class="col-lg-8 text-center">
                <h1 class="display-4 fw-bold text-white mb-4">How can we help you today?</h1>
                <div class="search-box mx-auto" style="max-width: 600px;">
                    <form class="d-flex">
                        <input class="form-control form-control-lg rounded-start-pill" type="search" placeholder="Search help articles..." aria-label="Search help">
                        <button class="btn btn-danger rounded-end-pill px-4" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<main class="help-content py-5">
    <div class="container">
        <!-- Help Categories -->
        <section class="help-categories mb-5">
            <h2 class="text-center mb-4">Browse Help Topics</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-danger bg-opacity-10 text-danger rounded-circle mx-auto mb-3">
                                <i class="fas fa-file-invoice-dollar fs-3"></i>
                            </div>
                            <h3 class="h5">Loan Applications</h3>
                            <p class="text-muted">Learn how to apply for loans and check requirements</p>
                            <a href="#" class="btn btn-link text-danger stretched-link">View Articles <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-3">
                                <i class="fas fa-money-bill-wave fs-3"></i>
                            </div>
                            <h3 class="h5">Payments</h3>
                            <p class="text-muted">Payment methods, schedules, and troubleshooting</p>
                            <a href="#" class="btn btn-link text-primary stretched-link">View Articles <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-3">
                                <i class="fas fa-user-shield fs-3"></i>
                            </div>
                            <h3 class="h5">Account Security</h3>
                            <p class="text-muted">Protect your account and personal information</p>
                            <a href="#" class="btn btn-link text-success stretched-link">View Articles <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-warning bg-opacity-10 text-warning rounded-circle mx-auto mb-3">
                                <i class="fas fa-question-circle fs-3"></i>
                            </div>
                            <h3 class="h5">FAQs</h3>
                            <p class="text-muted">Answers to frequently asked questions</p>
                            <a href="#" class="btn btn-link text-warning stretched-link">View Articles <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-info bg-opacity-10 text-info rounded-circle mx-auto mb-3">
                                <i class="fas fa-calculator fs-3"></i>
                            </div>
                            <h3 class="h5">Loan Calculator</h3>
                            <p class="text-muted">Estimate your payments and loan amounts</p>
                            <a href="#" class="btn btn-link text-info stretched-link">View Articles <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-purple bg-opacity-10 text-purple rounded-circle mx-auto mb-3">
                                <i class="fas fa-exclamation-triangle fs-3"></i>
                            </div>
                            <h3 class="h5">Report Issues</h3>
                            <p class="text-muted">Report problems or submit complaints</p>
                            <a href="#" class="btn btn-link text-purple stretched-link">View Articles <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popular Articles -->
        <section class="popular-articles mb-5">
            <h2 class="text-center mb-4">Popular Help Articles</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h5">How to apply for a Market Vendor Loan</h3>
                            <p class="text-muted">Step-by-step guide to applying for our most popular loan product.</p>
                            <a href="#" class="btn btn-sm btn-outline-danger">Read Article</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h5">Accepted payment methods</h3>
                            <p class="text-muted">Learn about all the different ways you can make payments.</p>
                            <a href="#" class="btn btn-sm btn-outline-danger">Read Article</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h5">Understanding your loan terms</h3>
                            <p class="text-muted">Explanation of interest rates, payment schedules, and fees.</p>
                            <a href="#" class="btn btn-sm btn-outline-danger">Read Article</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h5">What to do if you can't make a payment</h3>
                            <p class="text-muted">Options available if you're having difficulty with repayment.</p>
                            <a href="#" class="btn btn-sm btn-outline-danger">Read Article</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Options -->
        <section class="contact-options bg-light rounded-3 p-5 mb-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="mb-3">Still need help?</h2>
                    <p class="lead">Our customer care team is ready to assist you with any questions or concerns.</p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="tel:09177918872" class="btn btn-outline-primary">
                            <i class="fas fa-phone me-2"></i> Call Us
                        </a>
                        <a href="mailto:wecare@qcreditcorp.net" class="btn btn-outline-danger">
                            <i class="fas fa-envelope me-2"></i> Email Us
                        </a>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#helpTicketModal">
                            <i class="fas fa-ticket-alt me-2"></i> Submit Help Ticket
                        </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="Images/ABSOLUTE.jpg" alt="Customer Support Team" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </section>

        <!-- Service Hours -->
        <div class="alert alert-info text-center">
            <i class="fas fa-clock me-2"></i> <strong>Customer Care Hours:</strong> Monday to Saturday, 8:00 AM to 5:00 PM
        </div>
    </div>
</main>

<!-- Help Ticket Modal -->
<div class="modal fade" id="helpTicketModal" tabindex="-1" aria-labelledby="helpTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="helpTicketModalLabel">Submit Help Ticket</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="helpTicketForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone">
                        </div>
                        <div class="col-md-6">
                            <label for="loanAccount" class="form-label">Loan Account Number (if applicable)</label>
                            <input type="text" class="form-control" id="loanAccount">
                        </div>
                        <div class="col-12">
                            <label for="issueType" class="form-label">Issue Type</label>
                            <select class="form-select" id="issueType" required>
                                <option value="" selected disabled>Select issue type</option>
                                <option value="loan-application">Loan Application</option>
                                <option value="payment-issue">Payment Issue</option>
                                <option value="account-access">Account Access</option>
                                <option value="loan-terms">Loan Terms Question</option>
                                <option value="complaint">Complaint</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="message" class="form-label">Describe your issue</label>
                            <textarea class="form-control" id="message" rows="5" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="attachments" class="form-label">Attachments (if any)</label>
                            <input class="form-control" type="file" id="attachments" multiple>
                            <div class="form-text">You can upload screenshots or documents that might help us understand your issue better.</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="helpTicketForm" class="btn btn-danger">Submit Ticket</button>
            </div>
        </div>
    </div>
</div>

<!-- Footer Section -->
<footer class="bg-dark text-white py-5">
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
                    <li><a href="#" class="footer-link">About MVL</a></li>
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
                <p><i class="fas fa-map-marker-alt text-danger me-2"></i> <strong>Main Office:</strong> 2602 Antel 2000 Corporate Center, 121 Valero Street, Salcedo Village, Barangay Bel-air, Makati City 1227, Philippines</p>
                <p><i class="fas fa-phone text-danger me-2"></i> <strong>Trunkline:</strong> (02) 5310-2796 loc. 5100</p>
                <p><i class="fas fa-envelope text-danger me-2"></i> <strong>Help & Support:</strong> wecare@qcreditcorp.net</p>
                <p><i class="fas fa-user text-danger me-2"></i> <strong>Hiring:</strong> hiring@qcreditcorp.net</p>
                <p><i class="fas fa-exclamation-circle text-danger me-2"></i> <strong>Complaint:</strong> ireport@qcreditcorp.net</p>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="text-center mt-4 pt-3 border-top border-secondary">
            <p class="mb-0">&copy; 2025 QCREDIT CORP. ALL RIGHTS RESERVED.</p>
            <p class="mb-0">WEBSITE BY WEB DESIGN PHILIPPINES</p>
        </div>
    </div>
</footer>


</body>
</html>