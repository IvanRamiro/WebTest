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

$loan_texts = [];
$result = $conn->query("SELECT * FROM loan_requirement_texts");
while ($row = $result->fetch_assoc()) {
    $loan_texts[$row['requirement_type']] = $row;
}

$default_texts = [
    'adult' => ['line1' => '18 to 75', 'line2' => 'Years of Age'],
    'market' => ['line1' => 'A Store or', 'line2' => 'Market Stall Owner'],
    'house' => ['line1' => 'A Permanent', 'line2' => 'Resident'],
    'responsibility' => ['line1' => 'A Responsible', 'line2' => 'Borrower']
];

foreach ($default_texts as $type => $text) {
    if (!isset($loan_texts[$type])) {
        $loan_texts[$type] = $text;
    }
}

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

// Fetch testimonials
$testimonials = $conn->query("SELECT * FROM Testimonials ORDER BY created_at DESC");
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
<section class="hero" style="height: 500px; background: url('<?php echo $bg_image; ?>') no-repeat center center / cover;">
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
                                             alt="Age Requirement: <?php echo $loan_texts['adult']['line1'].' '.$loan_texts['adult']['line2']; ?>" 
                                             class="img-fluid mb-3" style="height: 60px; width: auto;">
                                    <?php else: ?>
                                        <div class="no-image-placeholder" style="height: 60px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-user fa-2x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                    <p class="mb-0 fw-medium"><?php echo $loan_texts['adult']['line1']; ?><br><?php echo $loan_texts['adult']['line2']; ?></p>
                                </article>
                            </div>
                            
                            <!-- Store Owner Requirement -->
                            <div class="col-6 col-md-3">
                                <article class="requirement-item text-center p-3">
                                    <?php if (!empty($loan_images['market']) && file_exists($loan_images['market'])): ?>
                                        <img src="<?php echo $loan_images['market']; ?>" 
                                             alt="Requirement: <?php echo $loan_texts['market']['line1'].' '.$loan_texts['market']['line2']; ?>" 
                                             class="img-fluid mb-3" style="height: 60px; width: auto;">
                                    <?php else: ?>
                                        <div class="no-image-placeholder" style="height: 60px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-store fa-2x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                    <p class="mb-0 fw-medium"><?php echo $loan_texts['market']['line1']; ?><br><?php echo $loan_texts['market']['line2']; ?></p>
                                </article>
                            </div>
                            
                            <!-- Resident Requirement -->
                            <div class="col-6 col-md-3">
                                <article class="requirement-item text-center p-3">
                                    <?php if (!empty($loan_images['house']) && file_exists($loan_images['house'])): ?>
                                        <img src="<?php echo $loan_images['house']; ?>" 
                                             alt="Requirement: <?php echo $loan_texts['house']['line1'].' '.$loan_texts['house']['line2']; ?>" 
                                             class="img-fluid mb-3" style="height: 60px; width: auto;">
                                    <?php else: ?>
                                        <div class="no-image-placeholder" style="height: 60px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-home fa-2x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                    <p class="mb-0 fw-medium"><?php echo $loan_texts['house']['line1']; ?><br><?php echo $loan_texts['house']['line2']; ?></p>
                                </article>
                            </div>
                            
                            <!-- Responsible Borrower -->
                            <div class="col-6 col-md-3">
                                <article class="requirement-item text-center p-3">
                                    <?php if (!empty($loan_images['responsibility']) && file_exists($loan_images['responsibility'])): ?>
                                        <img src="<?php echo $loan_images['responsibility']; ?>" 
                                             alt="Requirement: <?php echo $loan_texts['responsibility']['line1'].' '.$loan_texts['responsibility']['line2']; ?>" 
                                             class="img-fluid mb-3" style="height: 60px; width: auto;">
                                    <?php else: ?>
                                        <div class="no-image-placeholder" style="height: 60px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-handshake fa-2x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                    <p class="mb-0 fw-medium"><?php echo $loan_texts['responsibility']['line1']; ?><br><?php echo $loan_texts['responsibility']['line2']; ?></p>
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
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials container text-center py-5" aria-labelledby="testimonials-heading">
    <div class="container">
        <h6 class="text-danger">OUR TESTIMONIALS</h6>
        <h2 id="testimonials-heading">What Our <strong>Customers Say About Us</strong></h2>
        
        <div class="row mt-4">
            <?php while ($row = $testimonials->fetch_assoc()): ?>
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

<!-- Call to Action -->
<section class="container text-center py-4">
    <a href="https://youtube.com/channel/YOUR_CHANNEL_ID" target="_blank" class="btn btn-danger">
        <i class="fab fa-youtube me-2"></i> OUR YOUTUBE CHANNEL
    </a>
</section>

<!-- Number Speak Section -->
<section id="number-speak" class="number-speak-section py-5 text-center bg-light" aria-labelledby="number-speak-heading">
    <div class="container">
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
    </div>
</section>

<!-- News & Events Section -->
<section id="news-events" class="news-section py-5" aria-labelledby="news-events-heading">
    <div class="container text-center">
        <h6 class="text-danger">NEWS & EVENTS</h6>
        <h2 id="news-events-heading">Our Latest <strong>Updates</strong> in QCredit Corp.</h2>

        <div class="row mt-4">
            <?php
            // Fetch only featured events (max 3)
            $featured_query = "SELECT id, title, description, event_date, location, thumbnail, external_url, is_featured 
                             FROM newsevents 
                             WHERE is_featured = 1 
                             ORDER BY event_date DESC LIMIT 3";
            $featured_result = $conn->query($featured_query);
            
            if ($featured_result && $featured_result->num_rows > 0) {
                while ($row = $featured_result->fetch_assoc()) {
                    $date_badge = date("M j", strtotime($row['event_date']));
                    $short_desc = strlen($row['description']) > 100 ? 
                        substr($row['description'], 0, 100) . "..." : $row['description'];
                    ?>
                    <!-- News Item -->
                    <article class="col-md-6 col-lg-4 mb-4" aria-labelledby="news-<?= $row['id']; ?>-title">
                        <div class="card news-card shadow-sm h-100">
                            <div class="position-relative">
                                <?php if (!empty($row['thumbnail'])): ?>
                                    <img src="ADMIN DASHBOARD/<?= htmlspecialchars($row['thumbnail']); ?>" 
                                         class="card-img-top" 
                                         alt="<?= htmlspecialchars($row['title']); ?>"
                                         style="height: 200px; object-fit: cover;">
                                <?php else: ?>
                                    <img src="Images/default-event.jpg" 
                                         class="card-img-top" 
                                         alt="Default Event Image"
                                         style="height: 200px; object-fit: cover;">
                                <?php endif; ?>
                                <span class="badge news-date"><?= $date_badge; ?></span>
                                <span class="badge bg-danger position-absolute top-0 end-0 m-2">Featured</span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 id="news-<?= $row['id']; ?>-title" class="card-title">
                                    <?= htmlspecialchars($row['title']) ?>
                                    <?php if (!empty($row['external_url'])): ?>
                                        <span class="external-link-indicator" title="Has external link">
                                            <i class="fas fa-external-link-alt"></i>
                                        </span>
                                    <?php endif; ?>
                                </h5>
                                <p class="card-text"><?= htmlspecialchars($short_desc) ?></p>
                                <?php if (!empty($row['location'])): ?>
                                    <p class="text-muted small mb-3">
                                        <i class="fas fa-map-marker-alt"></i> 
                                        <?= htmlspecialchars($row['location']) ?>
                                    </p>
                                <?php endif; ?>
                                <div class="mt-auto">
                                    <a href="event-details.php?id=<?= $row['id'] ?>" class="btn btn-primary">READ MORE</a>
                                    <?php if (!empty($row['external_url'])): ?>
                                        <a href="<?= htmlspecialchars($row['external_url']) ?>" target="_blank" class="btn btn-outline-secondary ms-2">
                                            External Link <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                    <?php
                }
            } else {
                echo '<div class="col-12"><div class="alert alert-info">No featured events at the moment. Check our <a href="news-events.php">News & Events</a> page for updates.</div></div>';
            }
            ?>
        </div>

        <!-- Call to Action -->
        <p class="mt-3">Want to know more about our <strong>Latest Updates?</strong></p>
        <a href="news-events.php" class="btn btn-dark">
            <i class="fas fa-arrow-right me-2"></i> GO TO NEWS & EVENTS
        </a>
    </div>
</section>

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
<?php $conn->close(); ?>