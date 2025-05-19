<?php
require 'ADMIN DASHBOARD/config.php';
include 'db.php';

// Fetch background image
$bg_image = "";
$bg_result = $conn->query("SELECT bg_image FROM bgchanger ORDER BY id DESC LIMIT 1");
if ($bg_result && $bg_result->num_rows > 0) {
    $bg_row = $bg_result->fetch_assoc();
    $bg_image = "ADMIN DASHBOARD/" . $bg_row['bg_image'];
}

// Fetch events without thumbnail and location
$featured_events = $conn->query("SELECT * FROM NewsEvents 
    WHERE is_featured = 1 
    ORDER BY created_at DESC 
    LIMIT 12");

$recent_events = $conn->query("SELECT * FROM NewsEvents 
    WHERE is_featured = 0
    ORDER BY created_at DESC 
    LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCREDIT</title>
    <meta name="description" content="QCREDIT - Delivering financial access to everyone...">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css?v=1.1"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="script.js" defer></script>
</head>
<body>

    <style>
        :root {
            --main-color: #4d2379;
            --secondary-color: #ffc301;
            --text-color: #000;
            --subheader-color: #fff;
        }
        
        .event-card {
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            margin-bottom: 30px;
        }
        
        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .event-img-container {
            height: 220px;
            overflow: hidden;
            position: relative;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .event-icon {
            font-size: 3rem;
            color: var(--main-color);
        }
        
        .featured-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--main-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            z-index: 2;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .event-date {
            color: var(--main-color);
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .event-date i {
            margin-right: 8px;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .section-title h6 {
            color: var(--main-color);
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }
        
        .section-title h2 {
            font-weight: 700;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }
        
        .section-title h2:after {
            content: '';
            position: absolute;
            width: 80px;
            height: 3px;
            background: var(--main-color);
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .card-body {
            padding: 25px;
        }
        
        .card-title {
            font-weight: 700;
            margin-bottom: 15px;
            color: #333;
        }
        
        .card-text {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        
        .btn-danger {
            background: var(--main-color);
            border: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-danger:hover {
            background: #3a1a5e;
            transform: translateY(-2px);
        }
        
        .btn-outline-danger {
            border-color: var(--main-color);
            color: var(--main-color);
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-outline-danger:hover {
            background: var(--main-color);
            color: white;
            transform: translateY(-2px);
        }
        
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .empty-state i {
            font-size: 50px;
            color: var(--main-color);
            margin-bottom: 20px;
        }
        
        .empty-state h4 {
            color: #333;
            margin-bottom: 15px;
        }
        
        .empty-state p {
            color: #666;
            max-width: 500px;
            margin: 0 auto 20px;
        }
        
        .external-link-indicator {
            display: inline-flex;
            align-items: center;
            color: #6c757d;
            font-size: 0.8rem;
            margin-left: 5px;
        }
        
        @media (max-width: 768px) {
            .hero {
                height: 300px;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .event-img-container {
                height: 180px;
            }
            
            .section-title h2 {
                font-size: 1.8rem;
            }
        }
    </style>
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
</nav>
</section>


<!-- News & Events Content -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title">
            <h6 style="color: var(--main-color);">NEWS & EVENTS</h6>
            <h2>Latest <strong>Updates and Activities</strong></h2>
        </div>

        <!-- Featured Events -->
        <?php if ($featured_events->num_rows > 0): ?>
    <div class="mb-5">
        <h3 class="mb-4">Featured Events</h3>
        <div class="row g-4">
            <?php while ($event = $featured_events->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card event-card h-100 shadow-sm">
                        <?php if (!empty($event['external_url'])): ?>
                            <div class="embed-responsive embed-responsive-16by9">
                                <?php
                                // Check if URL is from a supported platform
                                $url = $event['external_url'];
                                if (preg_match('/facebook\.com|fb\.watch/i', $url)) {
                                    // Facebook embed
                                    echo '<div class="fb-post" data-href="'.htmlspecialchars($url).'" data-width="500" data-show-text="true"></div>';
                                } elseif (preg_match('/twitter\.com|t\.co/i', $url)) {
                                    // Twitter embed
                                    echo '<blockquote class="twitter-tweet"><a href="'.htmlspecialchars($url).'"></a></blockquote>';
                                } elseif (preg_match('/instagram\.com/i', $url)) {
                                    // Instagram embed
                                    echo '<blockquote class="instagram-media" data-instgrm-permalink="'.htmlspecialchars($url).'" data-instgrm-version="13"></blockquote>';
                                } elseif (preg_match('/youtube\.com|youtu\.be/i', $url)) {
                                    // YouTube embed
                                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
                                    $video_id = $matches[1] ?? '';
                                    echo '<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe>';
                                } else {
                                    // Generic oEmbed for other sites (WordPress, etc.)
                                    echo '<div class="oembed-container" data-url="'.htmlspecialchars($url).'"></div>';
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h4 class="card-title"><?= htmlspecialchars($event['title']) ?></h4>
                            <p class="card-text"><?= substr(htmlspecialchars($event['description']), 0, 100) ?>...</p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php else: ?>
            <div class="empty-state">
                <i class="far fa-calendar-star"></i>
                <h4>No Featured Events</h4>
                <p>There are currently no featured events. Check back later for updates.</p>
                <a href="index.php" class="btn" style="background-color: var(--main-color); color: white;">Back to Home</a>
            </div>
        <?php endif; ?>

        <!-- Recent Events -->
        <?php if ($recent_events->num_rows > 0): ?>
            <div class="mb-5">
                <h3 class="mb-4">Recent Updates</h3>
                <div class="row g-4">
                    <?php while ($event = $recent_events->fetch_assoc()): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card event-card h-100 shadow-sm">
                                <div class="event-img-container">
                                    <i class="fas fa-newspaper event-icon"></i>
                                </div>
                                <div class="card-body">
                                    <div class="event-date mb-2">
                                        <i class="far fa-calendar-alt"></i>
                                        <?= date('F j, Y', strtotime($event['created_at'])) ?>
                                    </div>
                                    <h4 class="card-title"><?= htmlspecialchars($event['title']) ?>
                                        <?php if (!empty($event['external_url'])): ?>
                                            <span class="external-link-indicator" title="Has external link">
                                                <i class="fas fa-external-link-alt"></i>
                                            </span>
                                        <?php endif; ?>
                                    </h4>
                                    <div class="d-flex justify-content-between">
                                        <?php if (!empty($event['external_url'])): ?>
                                            <a href="<?= htmlspecialchars($event['external_url']) ?>" target="_blank" class="btn btn-outline-danger">
                                                Read More <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="far fa-calendar-plus"></i>
                <h4>No Recent Events</h4>
                <p>There are currently no recent updates. Check back later for news.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>

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
                    container.innerHTML = `<a href="${url}" target="_blank">View Content</a>`;
                }
            })
            .catch(() => {
                container.innerHTML = `<a href="${url}" target="_blank">View Content</a>`;
            });
    });
});
</script>

</body>
</html>
<?php $conn->close(); ?>