<?php
include 'db.php';

$bg_image = "";
$bg_result = $conn->query("SELECT bg_image FROM bgchanger ORDER BY id DESC LIMIT 1");
if ($bg_result && $bg_result->num_rows > 0) {
    $bg_row = $bg_result->fetch_assoc();
    $bg_image = "ADMIN DASHBOARD/" . $bg_row['bg_image'];
}

$mvl_image = "";
$mvl_result = $conn->query("SELECT image_path FROM website_images 
                          WHERE image_type = 'mvl' AND is_active = 1 
                          ORDER BY upload_time DESC LIMIT 1");
if ($mvl_result && $mvl_result->num_rows > 0) {
    $mvl_row = $mvl_result->fetch_assoc();
    $mvl_image = "ADMIN DASHBOARD/" . $mvl_row['image_path'];
}

$loan_images = [
    'adult' => '',
    'market' => '',
    'house' => '',
    'responsibility' => ''
];

foreach ($loan_images as $type => $value) {
    $sql = "SELECT image_path FROM website_images 
            WHERE image_type = 'loan_requirement' 
            AND image_subtype = '$type'
            AND is_active = 1 
            ORDER BY upload_time DESC LIMIT 1";
    
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $loan_images[$type] = "ADMIN DASHBOARD/" . $row['image_path'];
        
        if (!file_exists($loan_images[$type])) {
            error_log("File not found: " . $loan_images[$type]);
        }
    } else {
        error_log("No image found in DB for type: $type");
    }
}
?>

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

 <!-- Market Vendor Loan Section -->
<section class="mvl-section py-5" aria-labelledby="mvl-heading">
    <div class="container px-lg-4 px-md-3 px-sm-2">
        <div class="row g-4 mx-0">
            <!-- MVL Promo Content -->
            <div class="col-lg-6 px-3">
                <?php if (!empty($mvl_image)): ?>
                <div class="mvl-card bg-white p-4 rounded-3 shadow-sm h-100">
                    <figure class="mvl-image mb-4 mx-0">
                        <img src="<?php echo $mvl_image; ?>" 
                            alt="Market Vendor Loan Advertisement" 
                            class="img-fluid rounded-3 w-100">
                        <figcaption class="visually-hidden">Market Vendor Loan Promotional Image</figcaption>
                    </figure>
                    
                    <div class="mvl-text-content px-2">
                        <span class="text-danger fw-bold small d-block mb-2">LEARN MORE ABOUT MVL</span>
                        <h2 id="mvl-heading" class="fw-bold mb-3">Grow your business with <span class="text-primary">Market Vendor Loan</span></h2>
                        <p class="text-muted mb-4">Apply for a loan, boost your capital, and increase your inventory. We've made it easy for you so you can focus on growing your business.</p>
                        <a href="#" class="btn btn-danger px-4 py-2 fw-bold" aria-label="Apply online for Market Vendor Loan">
                            APPLY ONLINE <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Loan Requirements -->
            <div class="col-lg-6">
    <div class="requirements-card bg-white p-4 rounded-3 shadow-sm h-100">
        <span class="text-danger fw-bold small d-block mb-2">LOAN REQUIREMENTS</span>
        <h2 class="fw-bold mb-4">Who can apply for a <strong class="text-primary">Market Vendor Loan?</strong></h2>

        <div class="requirements-grid">
            <div class="row g-3">
                <!-- Age Requirement -->
                <div class="col-6 col-md-3">
                    <article class="requirement-item text-center p-3">
                        <?php if (!empty($loan_images['adult']) && file_exists($loan_images['adult'])): ?>
                            <img src="<?php echo $loan_images['adult']; ?>" 
                                 alt="Age Requirement: 18 to 75 Years" 
                                 class="img-fluid mb-3" style="height: 60px; width: auto;">
                        <?php else: ?>
                            <div class="no-image-placeholder" style="height: 60px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user fa-2x text-muted"></i>
                            </div>
                        <?php endif; ?>
                        <p class="mb-0 fw-medium">18 to 75 <br> Years of Age</p>
                    </article>
                </div>
                
                <!-- Store Owner Requirement -->
                <div class="col-6 col-md-3">
                    <article class="requirement-item text-center p-3">
                        <?php if (!empty($loan_images['market']) && file_exists($loan_images['market'])): ?>
                            <img src="<?php echo $loan_images['market']; ?>" 
                                 alt="Requirement: Store or Market Stall Owner" 
                                 class="img-fluid mb-3" style="height: 60px; width: auto;">
                        <?php else: ?>
                            <div class="no-image-placeholder" style="height: 60px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-store fa-2x text-muted"></i>
                            </div>
                        <?php endif; ?>
                        <p class="mb-0 fw-medium">A Store or <br> Market Stall Owner</p>
                    </article>
                </div>
                
                <!-- Resident Requirement -->
                <div class="col-6 col-md-3">
                    <article class="requirement-item text-center p-3">
                        <?php if (!empty($loan_images['house']) && file_exists($loan_images['house'])): ?>
                            <img src="<?php echo $loan_images['house']; ?>" 
                                 alt="Requirement: Permanent Resident" 
                                 class="img-fluid mb-3" style="height: 60px; width: auto;">
                        <?php else: ?>
                            <div class="no-image-placeholder" style="height: 60px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-home fa-2x text-muted"></i>
                            </div>
                        <?php endif; ?>
                        <p class="mb-0 fw-medium">A Permanent <br> Resident</p>
                    </article>
                </div>
                
                <!-- Responsible Borrower -->
                <div class="col-6 col-md-3">
                    <article class="requirement-item text-center p-3">
                        <?php if (!empty($loan_images['responsibility']) && file_exists($loan_images['responsibility'])): ?>
                            <img src="<?php echo $loan_images['responsibility']; ?>" 
                                 alt="Requirement: Responsible Borrower" 
                                 class="img-fluid mb-3" style="height: 60px; width: auto;">
                        <?php else: ?>
                            <div class="no-image-placeholder" style="height: 60px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-handshake fa-2x text-muted"></i>
                            </div>
                        <?php endif; ?>
                        <p class="mb-0 fw-medium">A Responsible <br> Borrower</p>
                    </article>
                </div>
            </div>
        </div>

        <div class="eligibility-cta mt-4 pt-3 border-top">
            <p class="mb-3">Want to know if you're eligible for <strong class="text-primary">Market Vendor Loan?</strong></p>
            <div class="d-flex flex-wrap gap-2">
                <a href="#" class="btn btn-outline-danger flex-grow-1" aria-label="Affordability and Suitability Assessment">
                    Affordability & Suitability Assessment
                </a>
                <a href="#" class="btn btn-outline-danger flex-grow-1" aria-label="Review Your Assessment Result">
                    Review Your Assessment Result
                </a>
            </div>
        </div>
    </div>
</div>
</section>

<?php
require 'ADMIN DASHBOARD/config.php';
// Fetch all testimonials from the database
$result = $conn->query("SELECT * FROM Testimonials ORDER BY created_at DESC");
?>

<!-- Testimonials Section -->
<section class="testimonials container text-center py-5" aria-labelledby="testimonials-heading">
    <div class="container">
        <h6 class="text-danger">OUR TESTIMONIALS</h6>
        <h2 id="testimonials-heading">What Our <strong>Customers Say About Us</strong></h2>
        
        <div class="row mt-4">
            <?php while ($row = $result->fetch_assoc()): ?>
                <article class="col-md-6 col-lg-4 mb-4" aria-labelledby="testimonial-<?= $row['id']; ?>-heading">
                    <a href="<?= htmlspecialchars($row['video_url']); ?>" target="_blank" class="video-link">
                        <div class="video-thumbnail shadow-sm rounded">
                            <img src="<?= htmlspecialchars($row['thumbnail_path']); ?>" alt="Testimonial Video" class="img-fluid rounded">
                            <div class="play-overlay">
                                <i class="fas fa-play-circle"></i>
                            </div>
                        </div>
                        <h3 id="testimonial-<?= $row['id']; ?>-heading" class="visually-hidden">Testimonial Video</h3>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php $conn->close(); ?>

        <<!-- Call to Action -->
        <div class="text-center mt-3">
                <a href="https://youtube.com/channel/YOUR_CHANNEL_ID" target="_blank" class="btn custom-btn">
            <i   i class="fab fa-youtube"></i> OUR YOUTUBE CHANNEL
        </a>
    </div>
</section>

<!-- Number Speak Section -->
<section id="number-speak" class="number-speak-section py-5 text-center bg-light" aria-labelledby="number-speak-heading">
    <section class="container">
        <h2 id="number-speak-heading" class="fw-bold">Our Journey in Numbers</h2>
        <div class="row mt-5">
            <!-- Number 1 -->
            <div class="col-md-4">
                <div class="number-box">
                    <h3 class="display-4 fw-bold text-primary" data-target="2027">0</h3>
                    <p>Started</p>
                </div>
            </div>
            <!-- Number 2 -->
            <div class="col-md-4">
                <div class="number-box">
                    <h3 class="display-4 fw-bold text-primary" data-target="79">0</h3>
                    <p>Branches</p>
                </div>
            </div>
            <!-- Number 3 -->
            <div class="col-md-4">
                <div class="number-box">
                    <h3 class="display-4 fw-bold text-primary" data-target="800">0</h3>
                    <p>Active Employees</p>
                </div>
            </div>
        </div>
</section>

<!-- News & Events Section -->
<section id="news-events" class="news-section py-5" aria-labelledby="news-events-heading">
    <div class="container text-center">
        <h6 class="text-danger">NEWS & EVENTS</h6>
        <h2 id="news-events-heading">Our Latest <strong>Updates</strong> in QCredit Corp.</h2>

        <div class="row mt-4">
            <!-- News Item 1 -->
            <article class="col-md-6 col-lg-4 mb-4" aria-labelledby="news1-title">
                <a href="https://www.inquirer.net/" target="_blank" class="news-link">
                    <div class="card news-card shadow-sm">
                        <div class="position-relative">
                            <img src="Images/ABSOLUTE.jpg" class="card-img-top" alt="QCredit Corp. Recognized as Top Producer">
                            <span class="badge news-date">DEC 11</span>
                        </div>
                        <div class="card-body">
                            <h5 id="news1-title" class="card-title">QCredit Corp. Recognized as Top Producer by La Jolla Hotel and Beach Resort</h5>
                            <p class="card-text">On December 7, 2024, QCredit Corp. was honored as one of the Top Producers...</p>
                            <button class="btn btn-primary">READ MORE</button>
                        </div>
                    </div>
                </a>
            </article>

            <!-- News Item 2 -->
            <article class="col-md-6 col-lg-4 mb-4" aria-labelledby="news2-title">
                <a href="https://www.inquirer.net/" target="_blank" class="news-link">
                    <div class="card news-card shadow-sm">
                        <div class="position-relative">
                            <img src="Images/ABSOLUTE.jpg" class="card-img-top" alt="QCredit Grants Scholarships to 543 Students">
                            <span class="badge news-date">OCT 31</span>
                        </div>
                        <div class="card-body">
                            <h5 id="news2-title" class="card-title">QCredit Grants Scholarships & Educational Assistance to 543 Students</h5>
                            <p class="card-text">In a remarkable demonstration of its commitment to Corporate Social Responsibility...</p>
                            <button class="btn btn-primary">READ MORE</button>
                        </div>
                    </div>
                </a>
            </article>

            <!-- News Item 3 -->
            <article class="col-md-6 col-lg-4 mb-4" aria-labelledby="news3-title">
                <a href="https://www.inquirer.net/" target="_blank" class="news-link">
                    <div class="card news-card shadow-sm">
                        <div class="position-relative">
                            <img src="Images/ABSOLUTE.jpg" class="card-img-top" alt="QCredit Corp. Launches Pilot Run">
                            <span class="badge news-date">OCT 01</span>
                        </div>
                        <div class="card-body">
                            <h5 id="news3-title" class="card-title">QCredit Corp. Launches Pilot Run of Ka-Partner Mo sa Pag-asenso Program</h5>
                            <p class="card-text">In a bold move to enhance customer outreach and support local businesses, QCredit Corp...</p>
                            <button class="btn btn-primary">READ MORE</button>
                        </div>
                    </div>
                </a>
            </article>
        </div>

        <!-- Call to Action -->
        <p class="mt-3">Want to know more about our <strong>Latest Updates?</strong></p>
        <a href="news-events.php" class="btn btn-dark">
            <i class="fas fa-arrow-right"></i> GO TO NEWS & EVENTS
        </a>
    </div>
</section>

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
