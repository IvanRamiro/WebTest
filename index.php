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
<section id="bannerCarousel" class="carousel slide position-relative" data-bs-ride="carousel" aria-label="Hero Banner Slideshow">
    <sec class="container-fluid p-0">
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

        <!-- Carousel -->
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <img src="images/banner.jpg" class="d-block w-100 banner-img" alt="Financial Access for Everyone">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                    <h1 class="fw-bold text-white text-shadow">Delivering Financial Access to Everyone</h1>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <img src="images/banner2.jpg" class="d-block w-100 banner-img" alt="Empowering Small Businesses">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                </div>
            </div>
        </div>
</section>

<!-- MVL Section -->
<section class="mvl-section d-flex justify-content-center align-items-center" aria-labelledby="mvl-heading">
    <div class="mvl-card d-flex align-items-center flex-wrap">
        <!-- Image -->
        <figure class="mvl-img mb-4 mb-md-0 me-md-4">
            <img src="images/mvl.jpg" alt="Market Vendor Loan Advertisement" class="img-fluid">
            <figcaption class="visually-hidden">Market Vendor Loan Promotional Image</figcaption>
        </figure>
        <!-- Text Content -->
        <div class="mvl-content">
            <h6 id="mvl-heading" class="text-danger fw-bold">LEARN MORE ABOUT MVL</h6>
            <h2 class="fw-bold">Grow your business with <br><span class="text-dark">Market Vendor Loan</span></h2>
            <p>Apply for a loan, boost your capital, and increase your inventory. We've made it easy for you so you can focus on growing your business.</p>
            <a href="#" class="btn btn-danger fw-bold" aria-label="Apply online for Market Vendor Loan">APPLY ONLINE</a>
        </div>
    </div>
</section>
<!-- Loan Requirements Section -->
<section class="loan-requirements text-center py-5" aria-labelledby="loan-requirements-heading">
    <h6 class="text-danger fw-bold">LOAN REQUIREMENTS</h6>
    <h2 id="loan-requirements-heading">Who can apply for a <strong>Market Vendor Loan?</strong></h2>

    <!-- Flexbox for Requirements -->
    <div class="d-flex flex-wrap justify-content-center align-items-start mt-4">
        <article class="requirement-item text-center mx-3 mb-3">
            <img src="images/adult.png" alt="Age Requirement: 18 to 75 Years of Age" class="img-fluid">
            <p>18 to 75 <br> Years of Age</p>
        </article>
        <article class="requirement-item text-center mx-3 mb-3">
            <img src="images/market.png" alt="Requirement: Store or Market Stall Owner" class="img-fluid">
            <p>A Store or <br> Market Stall Owner</p>
        </article>
        <article class="requirement-item text-center mx-3 mb-3">
            <img src="images/house.png" alt="Requirement: Permanent Resident" class="img-fluid">
            <p>A Permanent <br> Resident</p>
        </article>
        <article class="requirement-item text-center mx-3 mb-3">
            <img src="images/responsibility.png" alt="Requirement: Responsible Borrower" class="img-fluid">
            <p>A Responsible <br> Borrower</p>
        </article>
    </div>

    <!-- Eligibility Section -->
    <p class="mt-4">Want to know if you're eligible for <strong>Market Vendor Loan?</strong></p>
    <div class="d-flex justify-content-center gap-3 mt-3">
        <button class="btn btn-primary" aria-label="Affordability and Suitability Assessment">Affordability & Suitability Assessment</button>
        <button class="btn btn-primary" aria-label="Review Your Assessment Result">Review Your Assessment Result</button>
    </div>
</section>

<!-- Market Vendor Loan Steps Section -->
<section class="container my-5" aria-labelledby="mvl-steps-heading">
    <div class="row bg-light p-4 shadow-sm">
        <!-- Left side text content -->
        <article class="col-md-5 d-flex flex-column justify-content-center">
            <h4 class="text-danger fw-bold">NO HASSLE. FAST AND EASY.</h4>
            <h2 id="mvl-steps-heading" class="fw-bold">
                How does <span class="text-primary">Market Vendor Loan</span> work?
            </h2>
            <p>
                Borrow up to <strong>₱200,000</strong> without collateral or co-maker.
                Market Vendor Loan (MVL) is perfect for small to medium-scale businesses looking 
                to finance short-term needs, whether it's equipment or additional capital.
            </p>
            <a href="#" class="btn custom-btn mt-3" aria-label="Learn More About Market Vendor Loan">
                <i class="fas fa-info-circle"></i> Learn More About MVL
            </a>
        </article>

        <!-- Right side steps -->
        <div class="col-md-7">
            <div class="row g-3">
                <!-- Step 1 -->
                <article class="col-6">
                    <div class="step-box">
                        <div class="step-label">STEP 1</div>
                        <h5><i class="fas fa-file-signature"></i> APPLY</h5>
                        <p>Apply online or submit an accomplished MVL Application Form to any QCredit branch near you.</p>
                    </div>
                </article>
                <!-- Step 2 -->
                <article class="col-6">
                    <div class="step-box">
                        <div class="step-label">STEP 2</div>
                        <h5><i class="fas fa-mobile-alt"></i> REGISTER</h5>
                        <p>Subscribe your mobile number to QCredit e-Cash service through text messaging.</p>
                    </div>
                </article>
                <!-- Step 3 -->
                <article class="col-6">
                    <div class="step-box">
                        <div class="step-label">STEP 3</div>
                        <h5><i class="fas fa-comment-sms"></i> REQUEST</h5>
                        <p>Send loan request by texting the right command using your registered mobile number.</p>
                    </div>
                </article>
                <!-- Step 4 -->
                <article class="col-6">
                    <div class="step-box">
                        <div class="step-label">STEP 4</div>
                        <h5><i class="fas fa-wallet"></i> RECEIVE</h5>
                        <p>Get your loan from the branch where you applied or withdraw it from your BDO Cash Card.</p>
                    </div>
                </article>
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
            <!-- Testimonial 1 -->
            <article class="col-md-6 col-lg-4 mb-4" aria-labelledby="testimonial-1-heading">
                <a href="https://www.youtube.com/watch?v=VIDEO_ID_1" target="_blank" class="video-link">
                    <div class="video-thumbnail shadow-sm rounded">
                        <img src="thumbnail1.jpg" alt="Testimonial Video 1" class="img-fluid rounded">
                        <div class="play-overlay">
                            <i class="fas fa-play-circle"></i>
                        </div>
                    </div>
                    <h3 id="testimonial-1-heading" class="visually-hidden">Testimonial Video 1</h3>
                </a>
            </article>

            <!-- Testimonial 2 -->
            <article class="col-md-6 col-lg-4 mb-4" aria-labelledby="testimonial-2-heading">
                <a href="https://www.youtube.com/watch?v=VIDEO_ID_2" target="_blank" class="video-link">
                    <div class="video-thumbnail shadow-sm rounded">
                        <img src="thumbnail2.jpg" alt="Testimonial Video 2" class="img-fluid rounded">
                        <div class="play-overlay">
                            <i class="fas fa-play-circle"></i>
                        </div>
                    </div>
                    <h3 id="testimonial-2-heading" class="visually-hidden">Testimonial Video 2</h3>
                </a>
            </article>

            <!-- Testimonial 3 -->
            <article class="col-md-6 col-lg-4 mb-4" aria-labelledby="testimonial-3-heading">
                <a href="https://www.youtube.com/watch?v=VIDEO_ID_3" target="_blank" class="video-link">
                    <div class="video-thumbnail shadow-sm rounded">
                        <img src="thumbnail3.jpg" alt="Testimonial Video 3" class="img-fluid rounded">
                        <div class="play-overlay">
                            <i class="fas fa-play-circle"></i>
                        </div>
                    </div>
                    <h3 id="testimonial-3-heading" class="visually-hidden">Testimonial Video 3</h3>
                </a>
            </article>

            <!-- Testimonial 4 -->
            <article class="col-md-6 col-lg-4 mb-4" aria-labelledby="testimonial-4-heading">
                <a href="https://www.youtube.com/watch?v=VIDEO_ID_4" target="_blank" class="video-link">
                    <div class="video-thumbnail shadow-sm rounded">
                        <img src="thumbnail4.jpg" alt="Testimonial Video 4" class="img-fluid rounded">
                        <div class="play-overlay">
                            <i class="fas fa-play-circle"></i>
                        </div>
                    </div>
                    <h3 id="testimonial-4-heading" class="visually-hidden">Testimonial Video 4</h3>
                </a>
            </article>

            <!-- Testimonial 5 -->
            <article class="col-md-6 col-lg-4 mb-4" aria-labelledby="testimonial-5-heading">
                <a href="https://www.youtube.com/watch?v=VIDEO_ID_5" target="_blank" class="video-link">
                    <div class="video-thumbnail shadow-sm rounded">
                        <img src="thumbnail5.jpg" alt="Testimonial Video 5" class="img-fluid rounded">
                        <div class="play-overlay">
                            <i class="fas fa-play-circle"></i>
                        </div>
                    </div>
                    <h3 id="testimonial-5-heading" class="visually-hidden">Testimonial Video 5</h3>
                </a>
            </article>

            <!-- Testimonial 6 -->
            <article class="col-md-6 col-lg-4 mb-4" aria-labelledby="testimonial-6-heading">
                <a href="https://www.youtube.com/watch?v=VIDEO_ID_6" target="_blank" class="video-link">
                    <div class="video-thumbnail shadow-sm rounded">
                        <img src="thumbnail6.jpg" alt="Testimonial Video 6" class="img-fluid rounded">
                        <div class="play-overlay">
                            <i class="fas fa-play-circle"></i>
                        </div>
                    </div>
                    <h3 id="testimonial-6-heading" class="visually-hidden">Testimonial Video 6</h3>
                </a>
            </article>
        </div>

        <!-- Call to Action -->
        <p class="mt-3">See what our Nanays & Tatays have to say about <strong>Market Vendor Loan</strong></p>
        <a href="https://youtube.com/channel/YOUR_CHANNEL_ID" target="_blank" class="btn custom-btn">
            <i class="fab fa-youtube"></i> OUR YOUTUBE CHANNEL
        </a>
    </div>
</section>


        <!-- Number Speak Section -->
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

        <!-- Image -->
        <div class="mt-5">
            <figure>
                <img src="images/journey.jpg" alt="Our Journey Image" class="img-fluid rounded shadow">
                <figcaption class="visually-hidden">Our Journey with QCREDIT</figcaption>
            </figure>
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
                <a href="https://example.com/news1" target="_blank" class="news-link">
                    <div class="card news-card shadow-sm">
                        <div class="position-relative">
                            <img src="news1.jpg" class="card-img-top" alt="QCredit Corp. Recognized as Top Producer">
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
                <a href="https://example.com/news2" target="_blank" class="news-link">
                    <div class="card news-card shadow-sm">
                        <div class="position-relative">
                            <img src="news2.jpg" class="card-img-top" alt="QCredit Grants Scholarships to 543 Students">
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
                <a href="https://example.com/news3" target="_blank" class="news-link">
                    <div class="card news-card shadow-sm">
                        <div class="position-relative">
                            <img src="news3.jpg" class="card-img-top" alt="QCredit Corp. Launches Pilot Run">
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
        <a href="https://example.com/news" class="btn btn-dark">
            <i class="fas fa-arrow-right"></i> GO TO NEWS & EVENTS
        </a>
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
                    <a href="#" class="btn btn-danger btn-sm"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-danger btn-sm"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="btn btn-danger btn-sm"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="btn btn-danger btn-sm"><i class="fab fa-tiktok"></i></a>
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
