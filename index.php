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
    <title>UNLAD PLUS LOAN</title>
    <meta name="description" content="FAST CASH - Quick and reliable financial solutions for everyone">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css?v=1.2"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="script.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    
<!-- Header Section -->
<header class="top-bar bg-light py-2 border-bottom" role="banner">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <div class="d-flex align-items-center justify-content-between flex-nowrap">
            <!-- Logo Section - Fixed width with min-width -->
            <div class="d-flex align-items-center" style="min-width: 180px;">
                <img src="Images/UNLAD.PNG" alt="UNLAD PLUS LOAN" class="logo-img me-2" height="50">
                <span class="brand-name fw-bold fs-5">UNLAD PLUS LOAN</span>
            </div>

            <!-- Contact & Links - Auto width with no flex-wrap -->
            <div class="d-flex flex-nowrap gap-4">
                <div><strong>Customer Service</strong><br><a href="tel:(02)1234-5678">(02) 1234-5678</a></div>
                <div><strong>Help & Support</strong><br><a href="mailto:support@unladplusloan.com">support@unladplusloan.com</a></div>
                <div class="d-none d-lg-block"><strong>Careers</strong><br><a href="mailto:careers@unladplusloan.com">careers@unladplusloan.com</a></div>
                <div class="d-none d-xl-block"><strong>Complaints</strong><br><a href="mailto:complaints@unladplusloan.com">complaints@unladplusloan.com</a></div>
            </div>

            <!-- Login Button -->
            <div>
                <a href="login.php" class="btn btn-primary text-white px-3 py-1">Login</a>
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


<!-- Market Vendor Loan Section - Enhanced Version -->
<section class="mvl-section py-5" aria-labelledby="mvl-heading">
    <div class="container px-lg-4 px-md-3 px-sm-2">
        <div class="row g-4 mx-0">
            <!-- MVL Promo Content - Enhanced Card -->
            <div class="col-lg-6 px-3">
                <?php if (!empty($mvl_image)): ?>
                <div class="mvl-card bg-white p-0 rounded-4 shadow-sm h-100 overflow-hidden">
                    <figure class="mvl-image mb-0 mx-0 position-relative">
                        <img src="<?php echo $mvl_image; ?>" 
                            alt="Market Vendor Loan Advertisement" 
                            class="img-fluid w-100">
                        <div class="image-overlay"></div>
                        <figcaption class="visually-hidden">Market Vendor Loan Promotional Image</figcaption>
                    </figure>
                    
                    <div class="mvl-text-content p-4 position-relative">
                        <span class="badge bg-primary text-white mb-2 px-3 py-1 rounded-pill">LEARN MORE ABOUT OUR LOANS</span>
                        <h2 id="mvl-heading" class="fw-bold mb-3 display-5">Grow your business with <span class="text-primary">UNLAD PLUS LOAN</span></h2>
                        <p class="text-muted mb-4 fs-5">We provide fast and easy loans tailored for market vendors and small business owners. Get the capital you need to expand your inventory and grow your business.</p>
                        <div class="d-flex align-items-center gap-3">
                            <a href="apply.php" class="btn btn-primary px-4 py-3 fw-bold rounded-pill" aria-label="Apply online for UNLAD PLUS LOAN">
                                APPLY ONLINE <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            <a href="#" class="btn btn-outline-primary px-4 py-3 fw-bold rounded-pill">
                                LEARN MORE
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

<div class="col-lg-6">
    <div class="requirements-card bg-white p-4 rounded-4 shadow-sm h-100">
        <span class="badge bg-primary text-white mb-2 px-3 py-1 rounded-pill">LOAN REQUIREMENTS</span>
        <h2 class="fw-bold mb-4 display-5">Who can apply for a <strong class="text-primary">UNLAD PLUS LOAN?</strong></h2>
        <p class="text-muted mb-4">Our loans are designed for hardworking individuals who meet these simple requirements:</p>

        <div class="requirements-grid">
            <div class="row g-3">
                
                <!-- Age Requirement -->
                <div class="col-6 col-md-3">
                    <article class="requirement-item text-center p-3 rounded-3 h-100 d-flex flex-column">
                    <div class="icon-container rounded-circle mb-3 mx-auto" style="width: 80px; height: 80px;">
                            <?php if (!empty($loan_images['adult']) && file_exists($loan_images['adult'])): ?>
                                <img src="<?php echo $loan_images['adult']; ?>" 
                                     alt="Age Requirement: <?php echo $loan_texts['adult']['line1'].' '.$loan_texts['adult']['line2']; ?>" 
                                     class="img-fluid h-100 w-auto" style="object-fit: contain;">
                            <?php else: ?>
                                <i class="fas fa-user fa-2x text-primary"></i>
                            <?php endif; ?>
                        </div>
                        <div class="mt-auto">
                            <h5 class="fw-bold mb-1"><?php echo $loan_texts['adult']['line1']; ?></h5>
                            <p class="mb-0 text-muted small"><?php echo $loan_texts['adult']['line2']; ?></p>
                        </div>
                    </article>
                </div>
                
                <!-- Store Owner Requirement -->
                <div class="col-6 col-md-3">
                    <article class="requirement-item text-center p-3 rounded-3 h-100 d-flex flex-column">
                    <div class="icon-container rounded-circle mb-3 mx-auto" style="width: 80px; height: 80px;">
                            <?php if (!empty($loan_images['market']) && file_exists($loan_images['market'])): ?>
                                <img src="<?php echo $loan_images['market']; ?>" 
                                     alt="Requirement: <?php echo $loan_texts['market']['line1'].' '.$loan_texts['market']['line2']; ?>" 
                                     class="img-fluid h-100 w-auto" style="object-fit: contain;">
                            <?php else: ?>
                                <i class="fas fa-store fa-2x text-primary"></i>
                            <?php endif; ?>
                        </div>
                        <div class="mt-auto">
                            <h5 class="fw-bold mb-1"><?php echo $loan_texts['market']['line1']; ?></h5>
                            <p class="mb-0 text-muted small"><?php echo $loan_texts['market']['line2']; ?></p>
                        </div>
                    </article>
                </div>
                
                <!-- Resident Requirement -->
                <div class="col-6 col-md-3">
                    <article class="requirement-item text-center p-3 rounded-3 h-100 d-flex flex-column">
                    <div class="icon-container rounded-circle mb-3 mx-auto" style="width: 80px; height: 80px;">
                            <?php if (!empty($loan_images['house']) && file_exists($loan_images['house'])): ?>
                                <img src="<?php echo $loan_images['house']; ?>" 
                                     alt="Requirement: <?php echo $loan_texts['house']['line1'].' '.$loan_texts['house']['line2']; ?>" 
                                     class="img-fluid h-100 w-auto" style="object-fit: contain;">
                            <?php else: ?>
                                <i class="fas fa-home fa-2x text-primary"></i>
                            <?php endif; ?>
                        </div>
                        <div class="mt-auto">
                            <h5 class="fw-bold mb-1"><?php echo $loan_texts['house']['line1']; ?></h5>
                            <p class="mb-0 text-muted small"><?php echo $loan_texts['house']['line2']; ?></p>
                        </div>
                    </article>
                </div>
                
                <!-- Responsible Borrower -->
                <div class="col-6 col-md-3">
                    <article class="requirement-item text-center p-3 rounded-3 h-100 d-flex flex-column">
                    <div class="icon-container rounded-circle mb-3 mx-auto" style="width: 80px; height: 80px;">
                            <?php if (!empty($loan_images['responsibility']) && file_exists($loan_images['responsibility'])): ?>
                                <img src="<?php echo $loan_images['responsibility']; ?>" 
                                     alt="Requirement: <?php echo $loan_texts['responsibility']['line1'].' '.$loan_texts['responsibility']['line2']; ?>" 
                                     class="img-fluid h-100 w-auto" style="object-fit: contain;">
                            <?php else: ?>
                                <i class="fas fa-handshake fa-2x text-primary"></i>
                            <?php endif; ?>
                        </div>
                        <div class="mt-auto">
                            <h5 class="fw-bold mb-1"><?php echo $loan_texts['responsibility']['line1']; ?></h5>
                            <p class="mb-0 text-muted small"><?php echo $loan_texts['responsibility']['line2']; ?></p>
                        </div>
                    </article>
                </div>
            </div>
        </div>

        <div class="eligibility-cta mt-4 pt-4 border-top">
            <h4 class="mb-3">Check your eligibility for <strong class="text-primary">UNLAD PLUS LOAN</strong></h4>
            <div class="d-flex flex-wrap gap-2">
                <a href="#" class="btn btn-primary flex-grow-1 py-3 rounded-pill" aria-label="Affordability and Suitability Assessment">
                    <i class="fas fa-calculator me-2"></i> Assessment Tool
                </a>
                <a href="#" class="btn btn-outline-primary flex-grow-1 py-3 rounded-pill" aria-label="Review Your Assessment Result">
                    <i class="fas fa-chart-line me-2"></i> Check Results
                </a>
            </div>
        </div>
    </div>
</div>
</section>

<!-- Testimonials Section -->
<section class="testimonials container text-center py-5" aria-labelledby="testimonials-heading">
    <div class="container">
        <h6 class="text-primary">OUR TESTIMONIALS</h6>
        <h2 id="testimonials-heading">What Our <strong>Customers Say About Us</strong></h2>
        
        <div class="row mt-4">
            <?php 
            $testimonials = $conn->query("SELECT * FROM Testimonials ORDER BY created_at DESC");
            
            if ($testimonials->num_rows > 0): 
                while ($row = $testimonials->fetch_assoc()): 
                    $thumbnailPath = htmlspecialchars($row['thumbnail_path']);
                    
                    if (!empty($thumbnailPath) && !preg_match('/^https?:\/\//i', $thumbnailPath) && 
                        !file_exists($thumbnailPath) && file_exists("ADMIN DASHBOARD/" . $thumbnailPath)) {
                        $thumbnailPath = "ADMIN DASHBOARD/" . $thumbnailPath;
                    }
            ?>
                <article class="col-md-6 col-lg-4 mb-4" aria-labelledby="testimonial-<?= $row['id']; ?>-heading">
                    <a href="<?= htmlspecialchars($row['video_url']); ?>" target="_blank" class="video-link">
                        <div class="video-thumbnail shadow-sm rounded">
                            <img src="<?= $thumbnailPath ?>" 
                                 alt="Testimonial Video: <?= htmlspecialchars($row['title']); ?>" 
                                 class="img-fluid rounded"
                                 onerror="this.src='assets/img/testimonial-fallback.jpg'">
                            <div class="play-overlay">
                                <i class="fas fa-play-circle"></i>
                            </div>
                        </div>
                        <h3 id="testimonial-<?= $row['id']; ?>-heading" class="visually-hidden">
                            <?= htmlspecialchars($row['title']); ?> Testimonial
                        </h3>
                    </a>
                </article>
            <?php 
                endwhile; 
            else: 
            ?>
                <div class="col-12">
                    <div class="alert alert-info">
                        No testimonials available yet. Please check back later.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="container text-center py-4">
    <a href="https://youtube.com/channel/YOUR_CHANNEL_ID" target="_blank" class="btn btn-primary">
        <i class="fab fa-youtube me-2"></i> OUR YOUTUBE CHANNEL
    </a>
</section>

<section id="number-speak" class="number-speak-section py-5 text-center bg-light" aria-labelledby="number-speak-heading">
    <div class="container">
        <h2 id="number-speak-heading" class="fw-bold">Our Journey in Numbers</h2>
        <div class="row mt-5">

            <div class="col-md-4">
                <div class="number-box">
                    <h3 class="display-4 fw-bold text-primary" data-target="2023">0</h3>
                    <p>Started</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="number-box">
                    <h3 class="display-4 fw-bold text-primary" data-target="50">0</h3>
                    <p>Branches</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="number-box">
                    <h3 class="display-4 fw-bold text-primary" data-target="500">0</h3>
                    <p>Active Employees</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- News & Events Section -->
<section id="news-events" class="news-section py-5" aria-labelledby="news-events-heading">
    <div class="container text-center">
        <h6 class="text-primary">NEWS & EVENTS</h6>
        <h2 id="news-events-heading">Our Latest <strong>Updates</strong> in UNLAD PLUS LOAN</h2>

        <div class="row mt-4">
            <?php
            $featured_query = "SELECT id, title, description, created_at, external_url, is_featured 
                             FROM newsevents 
                             WHERE is_featured = 1 
                             ORDER BY created_at DESC LIMIT 6";
            $featured_result = $conn->query($featured_query);
            
            if ($featured_result && $featured_result->num_rows > 0) {
                while ($row = $featured_result->fetch_assoc()) {
                    $date_badge = date("M j", strtotime($row['created_at']));
                    $short_desc = strlen($row['description']) > 100 ? 
                        substr($row['description'], 0, 100) . "..." : $row['description'];
                    ?>
                    <!-- News Item -->
                    <article class="col-md-6 col-lg-4 mb-4" aria-labelledby="news-<?= $row['id']; ?>-title">
                        <div class="card news-card shadow-sm h-100">
                            <div class="position-relative">
                                <?php if (!empty($row['external_url'])): ?>
                                    <div class="embed-container" style="height: 200px; overflow: hidden;">
                                        <?php
                                        $url = $row['external_url'];
                                        if (preg_match('/facebook\.com|fb\.watch/i', $url)) {
                                            echo '<div class="fb-post" data-href="'.htmlspecialchars($url).'" data-width="500" data-show-text="true"></div>';
                                        } elseif (preg_match('/twitter\.com|t\.co/i', $url)) {
                                            echo '<blockquote class="twitter-tweet"><a href="'.htmlspecialchars($url).'"></a></blockquote>';
                                        } elseif (preg_match('/instagram\.com/i', $url)) {
                                            echo '<blockquote class="instagram-media" data-instgrm-permalink="'.htmlspecialchars($url).'" data-instgrm-version="13"></blockquote>';
                                        } elseif (preg_match('/youtube\.com|youtu\.be/i', $url)) {
                                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
                                            $video_id = $matches[1] ?? '';
                                            echo '<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen style="width:100%;height:100%;"></iframe>';
                                        } else {
                                            echo '<div class="oembed-container" data-url="'.htmlspecialchars($url).'" style="width:100%;height:100%;"></div>';
                                        }
                                        ?>
                                    </div>
                                <?php else: ?>
                                    <div class="no-embed-placeholder" style="height: 200px; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                                        <i class="fas fa-newspaper fa-3x text-muted"></i>
                                    </div>
                                <?php endif; ?>
                                <span class="badge news-date"><?= $date_badge; ?></span>
                                <?php if ($row['is_featured']): ?>
                                    <span class="badge bg-primary position-absolute top-0 end-0 m-2">Featured</span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 id="news-<?= $row['id']; ?>-title" class="card-title">
                                    <?= htmlspecialchars($row['title']) ?>
                                </h5>
                                <p class="card-text"><?= htmlspecialchars($short_desc) ?></p>
                                <div class="mt-auto">
                                    <?php if (!empty($row['external_url'])): ?>
                                        <a href="<?= htmlspecialchars($row['external_url']) ?>" target="_blank" class="btn btn-primary">
                                            View Content <i class="fas fa-external-link-alt"></i>
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

<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0" nonce="YOUR_NONCE"></script>
<script async defer src="https://www.instagram.com/embed.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.oembed-container').forEach(container => {
        const url = container.dataset.url;
        fetch(`https://noembed.com/embed?url=${encodeURIComponent(url)}`)
            .then(response => response.json())
            .then(data => {
                if (data.html) {
                    container.innerHTML = data.html;
                } else {
                    container.innerHTML = `<a href="${url}" target="_blank" class="btn btn-primary">View Content</a>`;
                }
            })
            .catch(() => {
                container.innerHTML = `<a href="${url}" target="_blank" class="btn btn-primary">View Content</a>`;
            });
    });
});


    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('[data-target]');
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / 200;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    requestAnimationFrame(updateCount);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    });
</script>

</script>
</body>
</html>
<?php $conn->close(); ?>