<?php
include 'config.php';

// Get application ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch application data
$sql = "SELECT * FROM loan_applications WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<div class='alert alert-danger'>Application not found.</div>";
    exit;
}

$application = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loan Application View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script>
</head>
<body>
<section id="loan-application" class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-danger text-white py-3">
                        <h2 class="h4 mb-0 text-center"><i class="fas fa-file-signature me-2"></i> Loan Application Details</h2>
                    </div>
                    <div class="card-body p-4">

                        <!-- Personal Information -->
                        <fieldset class="mb-4">
                            <legend class="fw-bold text-danger border-bottom pb-2">Personal Information</legend>
                            <div class="row g-3">
                                <div class="col-md-4"><strong>First Name:</strong> <?= htmlspecialchars($application['firstName']) ?></div>
                                <div class="col-md-4"><strong>Middle Name:</strong> <?= htmlspecialchars($application['middleName']) ?></div>
                                <div class="col-md-4"><strong>Last Name:</strong> <?= htmlspecialchars($application['lastName']) ?></div>
                                <div class="col-md-6"><strong>Date of Birth:</strong> <?= htmlspecialchars($application['birthDate']) ?></div>
                                <div class="col-md-6"><strong>Civil Status:</strong> <?= htmlspecialchars($application['civilStatus']) ?></div>
                                <div class="col-md-6"><strong>Email:</strong> <?= htmlspecialchars($application['email']) ?></div>
                                <div class="col-md-6"><strong>Mobile:</strong> <?= htmlspecialchars($application['mobile']) ?></div>
                            </div>
                        </fieldset>

                        <!-- Address Information -->
                        <fieldset class="mb-4">
                            <legend class="fw-bold text-danger border-bottom pb-2">Address Information</legend>
                            <div class="row g-3">
                                <div class="col-md-6"><strong>Current Address:</strong> <?= nl2br(htmlspecialchars($application['currentAddress'])) ?></div>
                                <div class="col-md-6"><strong>Permanent Address:</strong> <?= nl2br(htmlspecialchars($application['permanentAddress'])) ?></div>
                                <div class="col-md-4"><strong>City:</strong> <?= htmlspecialchars($application['city']) ?></div>
                                <div class="col-md-4"><strong>Province:</strong> <?= htmlspecialchars($application['province']) ?></div>
                                <div class="col-md-4"><strong>ZIP Code:</strong> <?= htmlspecialchars($application['zipCode']) ?></div>
                            </div>
                        </fieldset>

                        <!-- Employment Information -->
                        <fieldset class="mb-4">
                            <legend class="fw-bold text-danger border-bottom pb-2">Employment Information</legend>
                            <div class="row g-3">
                                <div class="col-md-6"><strong>Status:</strong> <?= htmlspecialchars($application['employmentStatus']) ?></div>
                                <div class="col-md-6"><strong>Monthly Income:</strong> ₱<?= number_format($application['monthlyIncome'], 2) ?></div>
                                <div class="col-md-6"><strong>Employer/Business:</strong> <?= htmlspecialchars($application['employerName']) ?></div>
                                <div class="col-md-6"><strong>Job Position:</strong> <?= htmlspecialchars($application['jobPosition']) ?></div>
                                <div class="col-md-6"><strong>Employment Duration:</strong> <?= htmlspecialchars($application['workDuration']) ?></div>
                                <div class="col-md-6"><strong>Work Address:</strong> <?= nl2br(htmlspecialchars($application['workAddress'])) ?></div>
                            </div>
                        </fieldset>

                        <!-- Loan Details -->
                        <fieldset class="mb-4">
                            <legend class="fw-bold text-danger border-bottom pb-2">Loan Details</legend>
                            <div class="row g-3">
                                <div class="col-md-6"><strong>Loan Amount:</strong> ₱<?= number_format($application['loanAmount'], 2) ?></div>
                                <div class="col-md-6"><strong>Purpose:</strong> <?= htmlspecialchars($application['loanPurpose']) ?></div>
                                <div class="col-md-6"><strong>Loan Term:</strong> <?= htmlspecialchars($application['loanTerm']) ?></div>
                                <div class="col-md-6"><strong>Payment Method:</strong> <?= htmlspecialchars($application['paymentMethod']) ?></div>
                            </div>
                        </fieldset>

                        <!-- Uploaded Documents -->
                        <fieldset class="mb-4">
                            <legend class="fw-bold text-danger border-bottom pb-2">Submitted Documents</legend>
                            <div class="row g-3">
                                <div class="col-md-6"><strong>Primary Valid ID:</strong><br>
                                    <a href="uploads/<?= htmlspecialchars($application['validId1']) ?>" target="_blank">View Document</a>
                                </div>
                                <div class="col-md-6"><strong>Secondary Valid ID:</strong><br>
                                    <a href="uploads/<?= htmlspecialchars($application['validId2']) ?>" target="_blank">View Document</a>
                                </div>
                                <div class="col-md-6"><strong>Proof of Income:</strong><br>
                                    <a href="uploads/<?= htmlspecialchars($application['proofOfIncome']) ?>" target="_blank">View Document</a>
                                </div>
                                <div class="col-md-6"><strong>Proof of Billing:</strong><br>
                                    <a href="uploads/<?= htmlspecialchars($application['proofOfBilling']) ?>" target="_blank">View Document</a>
                                </div>
                            </div>
                        </fieldset>

                        <div class="text-center mt-4">
                            <a href="loan_dashboard.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

<?php
$conn->close();
?>
