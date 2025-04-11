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
                <img src="Images/Logo.png" alt="FAST CASH Logo" class="logo-img me-2" height="50">
                <span class="brand-name fw-bold text-primary fs-5">FAST CASH</span>
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
<section class="hero" style="height: 500px; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('<?php echo $bg_image; ?>') no-repeat center center/cover;">
    <!-- Navigation Bar -->
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
                    <li class="nav-item"><a class="nav-link text-white" href="apply.php">Apply</a></li>
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
            <div class="col-lg-10 text-center">
                <h1 class="display-3 fw-bold text-white mb-4">Your FAST CASH Loan Journey Starts Here</h1>
                <p class="lead text-white mb-5">Get the financial support you need in just 6 simple steps</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="#loan-process" class="btn btn-danger btn-lg px-4 py-2 rounded-pill">
                        <i class="fas fa-list-ol me-2"></i> View Loan Steps
                    </a>
                    <a href="#" class="btn btn-outline-light btn-lg px-4 py-2 rounded-pill">
                        <i class="fas fa-calculator me-2"></i> Calculate Loan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Loan Process Timeline -->
<section id="loan-process" class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-danger mb-3">How to Get Your FAST CASH Loan</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <p class="lead">Follow this straightforward process to access funds quickly and securely. Our average approval time is just 24-48 hours for complete applications.</p>
                </div>
            </div>
        </div>

        <!-- Timeline Structure -->
        <div class="loan-timeline">
            <!-- Step 1 -->
            <div class="timeline-step">
                <div class="timeline-marker">
                    <div class="timeline-number">1</div>
                </div>
                <div class="timeline-content">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-danger text-white py-3">
                            <h3 class="h4 mb-0">Eligibility Check</h3>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="text-danger">Basic Requirements</h4>
                                    <ul class="list-icon">
                                        <li><i class="fas fa-check-circle text-danger"></i> Filipino citizen, 21-65 years old</li>
                                        <li><i class="fas fa-check-circle text-danger"></i> Minimum monthly income: ₱10,000</li>
                                        <li><i class="fas fa-check-circle text-danger"></i> At least 6 months with current employer/business</li>
                                        <li><i class="fas fa-check-circle text-danger"></i> No active bankruptcies</li>
                                    </ul>
                                    <div class="mt-3">
                                        <button class="btn btn-sm btn-outline-danger">Check Eligibility</button>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center d-none d-md-block">
                                    <img src="Images/Logo.png" alt="Eligibility Check" class="img-fluid" style="max-height: 150px;">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <small><i class="fas fa-clock text-danger me-1"></i> Time required: 2 minutes</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="timeline-step">
                <div class="timeline-marker">
                    <div class="timeline-number">2</div>
                </div>
                <div class="timeline-content">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-danger text-white py-3">
                            <h3 class="h4 mb-0">Document Preparation</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="text-danger"><i class="fas fa-id-card me-2"></i> Required IDs</h4>
                                    <ul>
                                        <li>Primary: Passport, Driver's License, UMID</li>
                                        <li>Secondary: SSS ID, PhilHealth ID, TIN</li>
                                        <li>2 copies of each ID</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="text-danger"><i class="fas fa-file-alt me-2"></i> Financial Proof</h4>
                                    <ul>
                                        <li>Latest 3 months payslips</li>
                                        <li>Bank statements</li>
                                        <li>ITR (for self-employed)</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-warning mt-3">
                                <i class="fas fa-exclamation-triangle me-2"></i> Original documents may be required for verification
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="timeline-step">
                <div class="timeline-marker">
                    <div class="timeline-number">3</div>
                </div>
                <div class="timeline-content">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-danger text-white py-3">
                            <h3 class="h4 mb-0">Application Submission</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="p-4 border rounded text-center h-100">
                                        <i class="fas fa-laptop-house text-danger mb-3" style="font-size: 2.5rem;"></i>
                                        <h4>Online Application</h4>
                                        <ol class="text-start ps-3">
                                            <li>Complete digital form</li>
                                            <li>Upload scanned documents</li>
                                            <li>E-sign application</li>
                                        </ol>
                                        <a href="#" class="btn btn-danger mt-2">Apply Online</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-4 border rounded text-center h-100">
                                        <i class="fas fa-store text-danger mb-3" style="font-size: 2.5rem;"></i>
                                        <h4>FAST CASH Branch Application</h4>
                                        <ol class="text-start ps-3">
                                            <li>Visit nearest FAST CASH branch</li>
                                            <li>Submit physical documents</li>
                                            <li>Get instant acknowledgement</li>
                                        </ol>
                                        <a href="#" class="btn btn-outline-danger mt-2">Find Branches</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="timeline-step">
                <div class="timeline-marker">
                    <div class="timeline-number">4</div>
                </div>
                <div class="timeline-content">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-danger text-white py-3">
                            <h3 class="h4 mb-0">Verification Process</h3>
                        </div>
                        <div class="card-body">
                            <div class="process-steps">
                                <div class="process-step completed">
                                    <div class="step-icon"><i class="fas fa-check"></i></div>
                                    <p class="step-label">Initial Review</p>
                                </div>
                                <div class="process-step active">
                                    <div class="step-icon">2</div>
                                    <p class="step-label">Document Check</p>
                                </div>
                                <div class="process-step">
                                    <div class="step-icon">3</div>
                                    <p class="step-label">Background Check</p>
                                </div>
                                <div class="process-step">
                                    <div class="step-icon">4</div>
                                    <p class="step-label">Final Approval</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h5 class="text-danger">What to Expect:</h5>
                                <ul class="list-icon">
                                    <li><i class="fas fa-phone text-danger"></i> Possible verification call within 24 hours</li>
                                    <li><i class="fas fa-envelope text-danger"></i> Email updates at each stage</li>
                                    <li><i class="fas fa-user-clock text-danger"></i> Typical processing: 1-2 business days</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="timeline-step">
                <div class="timeline-marker">
                    <div class="timeline-number">5</div>
                </div>
                <div class="timeline-content">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-danger text-white py-3">
                            <h3 class="h4 mb-0">Loan Approval</h3>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="approval-box bg-success bg-opacity-10 p-4 rounded border border-success mb-3">
                                        <h4 class="text-success"><i class="fas fa-check-circle me-2"></i> Congratulations!</h4>
                                        <p>Your FAST CASH loan has been approved with these terms:</p>
                                        <div class="loan-terms">
                                            <div class="term-item">
                                                <span>Loan Amount</span>
                                                <strong>₱50,000</strong>
                                            </div>
                                            <div class="term-item">
                                                <span>Interest Rate</span>
                                                <strong>3.5% monthly</strong>
                                            </div>
                                            <div class="term-item">
                                                <span>Term</span>
                                                <strong>12 months</strong>
                                            </div>
                                            <div class="term-item">
                                                <span>Monthly Payment</span>
                                                <strong>₱4,958.33</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="text-danger mb-3">Next Steps</h4>
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item border-0">Review loan agreement</li>
                                        <li class="list-group-item border-0">Sign documents</li>
                                        <li class="list-group-item border-0">Choose disbursement method</li>
                                        <li class="list-group-item border-0">Confirm acceptance</li>
                                    </ol>
                                    <div class="mt-3">
                                        <button class="btn btn-danger">View Full Contract</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 6 -->
            <div class="timeline-step">
                <div class="timeline-marker">
                    <div class="timeline-number">6</div>
                </div>
                <div class="timeline-content">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-danger text-white py-3">
                            <h3 class="h4 mb-0">Fund Disbursement</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="disbursement-method text-center p-3 h-100">
                                        <div class="icon-container bg-danger bg-opacity-10 rounded-circle p-4 mb-3 mx-auto">
                                            <i class="fas fa-university text-danger" style="font-size: 2rem;"></i>
                                        </div>
                                        <h5>Bank Transfer</h5>
                                        <p>Direct to your account (1-2 business days)</p>
                                        <small class="text-muted">No additional fees</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="disbursement-method text-center p-3 h-100">
                                        <div class="icon-container bg-danger bg-opacity-10 rounded-circle p-4 mb-3 mx-auto">
                                            <i class="fas fa-money-bill-wave text-danger" style="font-size: 2rem;"></i>
                                        </div>
                                        <h5>Cash Pickup</h5>
                                        <p>Available at FAST CASH branches (same day)</p>
                                        <small class="text-muted">With valid ID required</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="disbursement-method text-center p-3 h-100">
                                        <div class="icon-container bg-danger bg-opacity-10 rounded-circle p-4 mb-3 mx-auto">
                                            <i class="fas fa-mobile-alt text-danger" style="font-size: 2rem;"></i>
                                        </div>
                                        <h5>E-Wallet</h5>
                                        <p>GCash or PayMaya (within 24 hours)</p>
                                        <small class="text-muted">2% service fee applies</small>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-info mt-4">
                                <i class="fas fa-info-circle me-2"></i> <strong>Note:</strong> First-time borrowers may receive funds within 3 business days after approval.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="cta-section bg-danger text-white rounded-3 p-5 mt-5 shadow">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="mb-3">Ready to Start Your FAST CASH Loan Application?</h3>
                    <p class="mb-0">Join thousands of satisfied customers who trusted FAST CASH for their financial needs.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="#" class="btn btn-light btn-lg px-4 py-2 rounded-pill">Apply Now <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <!-- Left Section: Company Info -->
            <div class="col-md-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="Images/Logo.png" alt="FAST CASH Logo" height="40" class="me-2">
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