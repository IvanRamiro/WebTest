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
    <title>Apply for Loan | FAST CASH</title>
    <meta name="description" content="Apply for a FAST CASH loan - Quick and easy financial solutions">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css?v=1.1"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <div class="col-lg-8 text-center">
            <h1 class="display-4 fw-bold text-white mb-4">Apply for Unlad Plus Loan</h1>
            <p class="lead text-white mb-5">Flexible terms with competitive rates for your growth</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="#loan-application" class="btn btn-lg px-4 py-2 rounded-pill" style="background-color: var(--secondary-color); color: white;">
                    <i class="fas fa-pencil-alt me-2"></i> Start Application
                </a>
                <a href="#loan-calculator" class="btn btn-outline-light btn-lg px-4 py-2 rounded-pill">
                    <i class="fas fa-calculator me-2"></i> Calculate Loan
                </a>
            </div>
        </div>
    </div>
</div>
</section>

<!-- Loan Application Section -->
<section id="loan-application" class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header py-3 text-white" style="background-color: var(--main-color);">
                        <h2 class="h4 mb-0 text-center"><i class="fas fa-file-signature me-2"></i> Loan Application Form</h2>
                    </div>
                    <div class="card-body p-4">
                        <form id="loanApplicationForm" action="process-application.php" method="POST" enctype="multipart/form-data">
                            <!-- Personal Information -->
                            <fieldset class="mb-4">
                                <legend class="fw-bold border-bottom pb-2" style="color: var(--main-color);">Personal Information</legend>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="middleName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="middleName" name="middleName">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="birthDate" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="birthDate" name="birthDate" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="civilStatus" class="form-label">Civil Status <span class="text-danger">*</span></label>
                                        <select class="form-select" id="civilStatus" name="civilStatus" required>
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Separated">Separated</option>
                                            <option value="Widowed">Widowed</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="mobile" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="mobile" name="mobile" required>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Address Information -->
                            <fieldset class="mb-4">
                                <legend class="fw-bold border-bottom pb-2" style="color: var(--main-color);">Address Information</legend>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="currentAddress" class="form-label">Current Address <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="currentAddress" name="currentAddress" rows="2" required></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="permanentAddress" class="form-label">Permanent Address <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="permanentAddress" name="permanentAddress" rows="2" required></textarea>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" id="sameAsCurrent" name="sameAsCurrent">
                                            <label class="form-check-label" for="sameAsCurrent">Same as Current Address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="city" class="form-label">City/Municipality <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="city" name="city" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="province" class="form-label">Province <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="province" name="province" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="zipCode" class="form-label">ZIP Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="zipCode" name="zipCode" required>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Employment Information -->
                            <fieldset class="mb-4">
                            <legend class="fw-bold border-bottom pb-2" style="color: var(--main-color);">Employment Information</legend>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="employmentStatus" class="form-label">Employment Status <span class="text-danger">*</span></label>
                                        <select class="form-select" id="employmentStatus" name="employmentStatus" required>
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="Employed">Employed</option>
                                            <option value="Self-Employed">Self-Employed</option>
                                            <option value="OFW">OFW</option>
                                            <option value="Retired">Retired</option>
                                            <option value="Unemployed">Unemployed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="monthlyIncome" class="form-label">Monthly Income (PHP) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="monthlyIncome" name="monthlyIncome" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="employerName" class="form-label">Employer/Business Name</label>
                                        <input type="text" class="form-control" id="employerName" name="employerName">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="jobPosition" class="form-label">Job Position</label>
                                        <input type="text" class="form-control" id="jobPosition" name="jobPosition">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="workDuration" class="form-label">Duration of Employment/Business</label>
                                        <input type="text" class="form-control" id="workDuration" name="workDuration" placeholder="e.g. 2 years">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="workAddress" class="form-label">Work/Business Address</label>
                                        <textarea class="form-control" id="workAddress" name="workAddress" rows="2"></textarea>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Loan Details -->
                            <fieldset class="mb-4">
                                <legend class="fw-bold border-bottom pb-2" style="color: var(--main-color);">Loan Details</legend>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="loanAmount" class="form-label">Loan Amount (PHP) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="loanAmount" name="loanAmount" min="5000" max="100000" required>
                                        <div class="form-text">Minimum: ₱5,000 | Maximum: ₱100,000</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="loanPurpose" class="form-label">Loan Purpose <span class="text-danger">*</span></label>
                                        <select class="form-select" id="loanPurpose" name="loanPurpose" required>
                                            <option value="" selected disabled>Select Purpose</option>
                                            <option value="Emergency">Emergency</option>
                                            <option value="Medical">Medical</option>
                                            <option value="Education">Education</option>
                                            <option value="Business">Business</option>
                                            <option value="Home Improvement">Home Improvement</option>
                                            <option value="Debt Consolidation">Debt Consolidation</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="loanTerm" class="form-label">Preferred Loan Term <span class="text-danger">*</span></label>
                                        <select class="form-select" id="loanTerm" name="loanTerm" required>
                                            <option value="" selected disabled>Select Term</option>
                                            <option value="3 months">3 months</option>
                                            <option value="6 months">6 months</option>
                                            <option value="12 months">12 months</option>
                                            <option value="18 months">18 months</option>
                                            <option value="24 months">24 months</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="paymentMethod" class="form-label">Preferred Payment Method <span class="text-danger">*</span></label>
                                        <select class="form-select" id="paymentMethod" name="paymentMethod" required>
                                            <option value="" selected disabled>Select Method</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                            <option value="GCash">GCash</option>
                                            <option value="PayMaya">PayMaya</option>
                                            <option value="Over-the-Counter">Over-the-Counter</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Documents Upload -->
                            <fieldset class="mb-4">
                            <legend class="fw-bold border-bottom pb-2" style="color: var(--main-color);">Required Documents</legend>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i> Please upload clear copies of the following documents (JPEG, PNG or PDF format)
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="validId1" class="form-label">Primary Valid ID <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="validId1" name="validId1" accept="image/*,.pdf" required>
                                        <div class="form-text">e.g. Passport, Driver's License, UMID</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validId2" class="form-label">Secondary Valid ID <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="validId2" name="validId2" accept="image/*,.pdf" required>
                                        <div class="form-text">e.g. SSS ID, PhilHealth ID, TIN</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="proofOfIncome" class="form-label">Proof of Income <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="proofOfIncome" name="proofOfIncome" accept="image/*,.pdf" required>
                                        <div class="form-text">e.g. Payslips, Bank Statements, ITR</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="proofOfBilling" class="form-label">Proof of Billing <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="proofOfBilling" name="proofOfBilling" accept="image/*,.pdf" required>
                                        <div class="form-text">e.g. Utility Bill, Credit Card Statement</div>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Terms and Conditions -->
                            <div class="mb-4 p-3 border rounded bg-light">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="agreeTerms" name="agreeTerms" required>
                                    <label class="form-check-label" for="agreeTerms">
                                        I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a> and <a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal">Privacy Policy</a> of Unlad Plus Loan <span style="color: var(--main-color);">*</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="allowMarketing" name="allowMarketing">
                                    <label class="form-check-label" for="allowMarketing">
                                        I agree to receive marketing communications from Unlad Plus Loan
                                    </label>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg px-5 py-3" style="background-color: var(--main-color); color: white;">
                                    <i class="fas fa-paper-plane me-2"></i> Submit Application
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Loan Calculator Section -->
<section id="loan-calculator" class="py-5 bg-white">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0">
          <div class="card-header py-3 text-white" style="background-color: var(--main-color);">
            <h2 class="h4 mb-0 text-center">
              <i class="fas fa-calculator me-2"></i> Unlad Plus Loan Calculator
            </h2>
          </div>
          <div class="card-body p-4">
            <div class="row g-4">
              <div class="col-md-6">
                <!-- Loan Amount -->
                <div class="mb-3">
                  <label for="calcAmount" class="form-label">Loan Amount (PHP)</label>
                  <input type="range" class="form-range" id="calcAmount" min="1000" max="500000" step="1" value="25000">
                  <input type="number" class="form-control mt-2" id="inputAmount" step="0.01" value="25000">
                  <div class="d-flex justify-content-between mt-1">
                    <span>₱1,000</span>
                    <span>₱500,000</span>
                  </div>
                </div>

                <!-- Term -->
                <div class="mb-3">
                  <label for="calcTerm" class="form-label">Loan Term</label>
                  <select class="form-select" id="calcTerm">
                    <option value="3">3 months</option>
                    <option value="6">6 months</option>
                    <option value="12" selected>12 months</option>
                    <option value="18">18 months</option>
                    <option value="24">24 months</option>
                  </select>
                </div>

                <!-- Interest Rate -->
                <div class="mb-3">
                  <label for="calcRate" class="form-label">Interest Rate (%)</label>
                  <input type="number" class="form-control" id="calcRate" step="0.01" value="3.5">
                </div>

                <!-- Calculate Button -->
                <button id="calculateBtn" class="btn w-100" style="background-color: var(--main-color); color: white;">
                  <i class="fas fa-calculator me-2"></i> Calculate
                </button>
              </div>

              <!-- Results -->
              <div class="col-md-6">
                <div class="results-container p-3 border rounded bg-light">
                  <h5 class="text-center mb-3">Loan Summary</h5>
                  <div class="result-item d-flex justify-content-between mb-2">
                    <span>Loan Amount:</span>
                    <strong id="resultAmount">₱25,000.00</strong>
                  </div>
                  <div class="result-item d-flex justify-content-between mb-2">
                    <span>Interest Rate:</span>
                    <strong id="resultRate">3.5% monthly</strong>
                  </div>
                  <div class="result-item d-flex justify-content-between mb-2">
                    <span>Loan Term:</span>
                    <strong id="resultTerm">12 months</strong>
                  </div>
                  <div class="result-item d-flex justify-content-between mb-2">
                    <span>Total Interest:</span>
                    <strong id="resultInterest">₱10,500.00</strong>
                  </div>
                  <div class="result-item d-flex justify-content-between mb-2">
                    <span>Total Payment:</span>
                    <strong id="resultTotal">₱35,500.00</strong>
                  </div>
                  <div class="result-item d-flex justify-content-between mb-2">
                    <span>Monthly Payment:</span>
                    <strong id="resultMonthly">₱2,958.33</strong>
                  </div>
                  <div class="alert alert-info mt-3 mb-0">
                    <small><i class="fas fa-info-circle me-2"></i> Rates are subject to change based on credit evaluation</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Why Choose <span style="color: var(--main-color);">Unlad Plus Loan</span></h2>
            <div class="divider mx-auto" style="background-color: var(--main-color);"></div>
            <p class="lead mx-auto" style="max-width: 700px;">We make borrowing simple and growth-focused with competitive rates and excellent service</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-4 mx-auto" style="background-color: var(--main-color); color: white;">
                            <i class="fas fa-bolt fa-2x"></i>
                        </div>
                        <h3 class="h4">Fast Approval</h3>
                        <p>Get loan approval within 24-48 hours for complete applications with all required documents.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-4 mx-auto" style="background-color: var(--main-color); color: white;">
                            <i class="fas fa-percentage fa-2x"></i>
                        </div>
                        <h3 class="h4">Competitive Rates</h3>
                        <p>Enjoy some of the most competitive interest rates in the market with transparent terms.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-4 mx-auto" style="background-color: var(--main-color); color: white;">
                            <i class="fas fa-shield-alt fa-2x"></i>
                        </div>
                        <h3 class="h4">Secure Process</h3>
                        <p>Your personal and financial information is protected with bank-level security measures.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Frequently Asked <span style="color: var(--main-color);">Questions</span></h2>
            <div class="divider mx-auto" style="background-color: var(--main-color);"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqHeading1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                What are the requirements to apply for a Unlad Plus loan?
                            </button>
                        </h2>
                        <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                To qualify for a  Unlad Plus loan, you need to be:
                                <ul>
                                    <li>Filipino citizen aged 21-65 years old</li>
                                    <li>With a minimum monthly income of ₱10,000</li>
                                    <li>With at least 6 months employment/business history</li>
                                    <li>With valid government-issued IDs and proof of billing</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqHeading2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                How long does the application process take?
                            </button>
                        </h2>
                        <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                The application process typically takes 24-48 hours for complete applications with all required documents. You'll receive updates via email and SMS at each stage of the process.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqHeading3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                How will I receive my loan proceeds?
                            </button>
                        </h2>
                        <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You can choose from several disbursement options:
                                <ul>
                                    <li><strong>Bank Transfer:</strong> Direct to your account (1-2 business days)</li>
                                    <li><strong>Cash Pickup:</strong> At any Unlad Plus loan branch (same day)</li>
                                    <li><strong>E-Wallet:</strong> GCash or PayMaya (within 24 hours)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqHeading4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                                Can I pay my loan early?
                            </button>
                        </h2>
                        <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, you can pay your loan early without any prepayment penalties. Early repayment may even reduce your total interest cost. Contact our customer service for details on early repayment.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqHeading5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                                What happens if I miss a payment?
                            </button>
                        </h2>
                        <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                If you miss a payment, a late payment fee will be applied. We recommend contacting our customer service immediately if you anticipate difficulty in making a payment. We may be able to work out a revised payment plan to help you avoid additional charges.
                            </div>
                        </div>
                    </div>
                    </div>
                <div class="text-center mt-4">
                    <a href="help-support.php" class="btn btn-outline-danger" style="border-color: var(--main-color); color: var(--main-color);">View More FAQs</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 text-white" style="background-color: var(--main-color);">
    <div class="container text-center">
        <h2 class="display-5 fw-bold mb-4">Ready to Grow?</h2>
        <p class="lead mb-4">Apply now and get funds to support your goals!</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#loan-application" class="btn btn-light btn-lg px-4" style="color: var(--main-color);">Apply Now</a>
            <a href="contact-us.php" class="btn btn-outline-light btn-lg px-4">Contact Us</a>
        </div>
    </div>
</section>

<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: var(--main-color);">
                <h5 class="modal-title" id="termsModalLabel">Unlad Plus Loan Terms and Conditions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Terms content here -->
                <h6>1. Loan Agreement</h6>
                <p>By applying for a Unlad Plus loan loan, you agree to the terms and conditions outlined in our loan agreement...</p>
                
                <h6>2. Interest Rates and Fees</h6>
                <p>Interest rates range from 2.5% to 5% monthly depending on loan amount and term...</p>
                
                <h6>3. Repayment Terms</h6>
                <p>Repayment is due monthly on the date specified in your loan agreement...</p>
                
                <h6>4. Late Payments</h6>
                <p>A late payment fee of 5% of the installment amount or ₱500, whichever is higher, will be charged for payments received after the due date...</p>
                
                <h6>5. Data Privacy</h6>
                <p>Unlad Plus loan complies with the Data Privacy Act of 2012. Your personal information will be kept confidential and used only for loan processing purposes...</p>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="background-color: var(--main-color); color: white;" data-bs-dismiss="modal">I Understand</button>
            </div>
        </div>
    </div>
</div>

<!-- Privacy Policy Modal -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: var(--main-color);">
                <h5 class="modal-title" id="privacyModalLabel">Unlad Plus Loan Privacy Policy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Privacy policy content here -->
                <h6>1. Information We Collect</h6>
                <p>We collect personal information necessary to process your loan application including but not limited to...</p>
                
                <h6>2. How We Use Your Information</h6>
                <p>Your personal information is used to evaluate your loan application, process your loan if approved, and for collection purposes if necessary...</p>
                
                <h6>3. Information Sharing</h6>
                <p>We may share your information with credit bureaus and collection agencies as necessary for loan processing and collection...</p>
                
                <h6>4. Data Security</h6>
                <p>Unlad Plus loan implements appropriate security measures to protect your personal information from unauthorized access...</p>
                
                <h6>5. Your Rights</h6>
                <p>You have the right to access, correct, and request deletion of your personal information in our records...</p>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="background-color: var(--main-color); color: white;" data-bs-dismiss="modal">I Understand</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Form submission with SweetAlert
    document.getElementById('loanApplicationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate form
        if (!this.checkValidity()) {
            // If form is invalid, show error message
            Swal.fire({
                icon: 'error',
                title: 'Form Incomplete',
                text: 'Please fill out all required fields before submitting.',
                confirmButtonColor: 'var(--main-color)'
            });
            return;
        }

        // Show loading indicator
        Swal.fire({
            title: 'Processing your application',
            html: 'Please wait while we submit your information...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Simulate form submission (replace with actual AJAX call)
        setTimeout(() => {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Thank you for applying for a loan with Unlad Plus!',
                text: "We've successfully received your application and our team will get back to you shortly.",
                showConfirmButton: true,
                confirmButtonColor: 'var(--main-color)',
                timer: 5000,
                timerProgressBar: true
            }).then((result) => {
                // Submit the form after the alert is closed
                this.submit();
            });
        }, 2000);
    });

    // Loan Calculator Script
    const calcAmount = document.getElementById('calcAmount');
    const inputAmount = document.getElementById('inputAmount');
    const calcTerm = document.getElementById('calcTerm');
    const calcRate = document.getElementById('calcRate');
    const calculateBtn = document.getElementById('calculateBtn');

    const resultAmount = document.getElementById('resultAmount');
    const resultRate = document.getElementById('resultRate');
    const resultTerm = document.getElementById('resultTerm');
    const resultInterest = document.getElementById('resultInterest');
    const resultTotal = document.getElementById('resultTotal');
    const resultMonthly = document.getElementById('resultMonthly');

    // Format function for PHP currency
    const formatCurrency = (num) =>
      `₱${parseFloat(num).toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      })}`;

    // Sync range with number input
    calcAmount.addEventListener('input', () => {
      inputAmount.value = calcAmount.value;
    });

    // Sync number input to range if value is within slider range
    inputAmount.addEventListener('input', () => {
      const val = parseFloat(inputAmount.value);
      if (!isNaN(val) && val >= parseFloat(calcAmount.min) && val <= parseFloat(calcAmount.max)) {
        calcAmount.value = val;
      }
    });

    // Calculate on button click
    calculateBtn.addEventListener('click', () => {
      const amount = parseFloat(inputAmount.value);
      const term = parseInt(calcTerm.value);
      const rate = parseFloat(calcRate.value);

      if (isNaN(amount) || isNaN(rate) || isNaN(term)) return;

      const monthlyInterest = (rate / 100) * amount;
      const totalInterest = monthlyInterest * term;
      const totalPayment = amount + totalInterest;
      const monthlyPayment = totalPayment / term;

      // Display results
      resultAmount.textContent = formatCurrency(amount);
      resultRate.textContent = `${rate}% monthly`;
      resultTerm.textContent = `${term} months`;
      resultInterest.textContent = formatCurrency(totalInterest);
      resultTotal.textContent = formatCurrency(totalPayment);
      resultMonthly.textContent = formatCurrency(monthlyPayment);
    });

    // Same as current address checkbox functionality
    document.getElementById('sameAsCurrent').addEventListener('change', function() {
        if (this.checked) {
            const currentAddress = document.getElementById('currentAddress').value;
            document.getElementById('permanentAddress').value = currentAddress;
        }
    });
</script>

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