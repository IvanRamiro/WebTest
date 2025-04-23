<?php
$host = "localhost";
$db = "fastcash_db";
$user = "root";
$pass = "";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

function uploadFile($field) {
    global $uploadDir;
    $fileName = basename($_FILES[$field]['name']);
    $targetPath = $uploadDir . time() . "_" . $fileName;
    move_uploaded_file($_FILES[$field]['tmp_name'], $targetPath);
    return $targetPath;
}

function sanitize($data) {
    return htmlspecialchars(trim($data));
}

// Personal info
$firstName = sanitize($_POST['firstName']);
$middleName = sanitize($_POST['middleName']);
$lastName = sanitize($_POST['lastName']);
$birthDate = $_POST['birthDate'];
$civilStatus = $_POST['civilStatus'];
$email = sanitize($_POST['email']);
$mobile = sanitize($_POST['mobile']);

// Address
$currentAddress = sanitize($_POST['currentAddress']);
$permanentAddress = sanitize($_POST['permanentAddress']);
$sameAsCurrent = isset($_POST['sameAsCurrent']) ? 1 : 0;
$city = sanitize($_POST['city']);
$province = sanitize($_POST['province']);
$zipCode = sanitize($_POST['zipCode']);

// Employment
$employmentStatus = $_POST['employmentStatus'];
$monthlyIncome = $_POST['monthlyIncome'];
$employerName = sanitize($_POST['employerName']);
$jobPosition = sanitize($_POST['jobPosition']);
$workDuration = sanitize($_POST['workDuration']);
$workAddress = sanitize($_POST['workAddress']);

// Loan
$loanAmount = $_POST['loanAmount'];
$loanPurpose = $_POST['loanPurpose'];
$loanTerm = $_POST['loanTerm'];
$paymentMethod = $_POST['paymentMethod'];

// File uploads
$validId1 = uploadFile('validId1');
$validId2 = uploadFile('validId2');
$proofOfIncome = uploadFile('proofOfIncome');
$proofOfBilling = uploadFile('proofOfBilling');

$cidValidId1 = 'validId1_' . uniqid();
$cidValidId2 = 'validId2_' . uniqid();
$cidIncome = 'income_' . uniqid();
$cidBilling = 'billing_' . uniqid();

$agreeTerms = isset($_POST['agreeTerms']) ? 1 : 0;
$allowMarketing = isset($_POST['allowMarketing']) ? 1 : 0;

// Insert to DB
$stmt = $conn->prepare("INSERT INTO loan_application (
    first_name, middle_name, last_name, birth_date, civil_status, email, mobile,
    current_address, permanent_address, same_as_current, city, province, zip_code,
    employment_status, monthly_income, employer_name, job_position, work_duration, work_address,
    loan_amount, loan_purpose, loan_term, payment_method,
    valid_id_1, valid_id_2, proof_of_income, proof_of_billing,
    agree_terms, allow_marketing
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssssssssssdsdssssssssssssi",
    $firstName, $middleName, $lastName, $birthDate, $civilStatus, $email, $mobile,
    $currentAddress, $permanentAddress, $sameAsCurrent, $city, $province, $zipCode,
    $employmentStatus, $monthlyIncome, $employerName, $jobPosition, $workDuration, $workAddress,
    $loanAmount, $loanPurpose, $loanTerm, $paymentMethod,
    $validId1, $validId2, $proofOfIncome, $proofOfBilling,
    $agreeTerms, $allowMarketing
);

if ($stmt->execute()) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sonatavann@gmail.com';
        $mail->Password = 'jszf oarb vgil tfrx';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('sonatavann@gmail.com', 'FAST CASH');
        $mail->addAddress($email, "$firstName $lastName");
        $mail->addBCC('sonatavann@gmail.com');
        $mail->addReplyTo($email, "$firstName $lastName");

        // Embed images
        $mail->addEmbeddedImage($validId1, $cidValidId1);
        $mail->addEmbeddedImage($validId2, $cidValidId2);
        $mail->addEmbeddedImage($proofOfIncome, $cidIncome);
        $mail->addEmbeddedImage($proofOfBilling, $cidBilling);

        $mail->isHTML(true);
        $mail->Subject = "Loan Application Received";
        $mail->Body = "
            <p>Dear $firstName,</p>
            <p>Thank you for applying for a loan with <strong>FAST CASH</strong>. Below is a summary of your submitted application:</p>

            <h3>Personal Information</h3>
            <ul>
                <li><strong>Name:</strong> $firstName $middleName $lastName</li>
                <li><strong>Birth Date:</strong> $birthDate</li>
                <li><strong>Civil Status:</strong> $civilStatus</li>
                <li><strong>Email:</strong> $email</li>
                <li><strong>Mobile:</strong> $mobile</li>
            </ul>

            <h3>Address</h3>
            <ul>
                <li><strong>Current Address:</strong> $currentAddress</li>
                <li><strong>Permanent Address:</strong> $permanentAddress</li>
                <li><strong>Same as Current:</strong> " . ($sameAsCurrent ? "Yes" : "No") . "</li>
                <li><strong>City:</strong> $city</li>
                <li><strong>Province:</strong> $province</li>
                <li><strong>ZIP Code:</strong> $zipCode</li>
            </ul>

            <h3>Employment Information</h3>
            <ul>
                <li><strong>Status:</strong> $employmentStatus</li>
                <li><strong>Monthly Income:</strong> ₱" . number_format($monthlyIncome, 2) . "</li>
                <li><strong>Employer:</strong> $employerName</li>
                <li><strong>Position:</strong> $jobPosition</li>
                <li><strong>Work Duration:</strong> $workDuration</li>
                <li><strong>Work Address:</strong> $workAddress</li>
            </ul>

            <h3>Loan Information</h3>
            <ul>
                <li><strong>Amount:</strong> ₱" . number_format($loanAmount, 2) . "</li>
                <li><strong>Purpose:</strong> $loanPurpose</li>
                <li><strong>Term:</strong> $loanTerm months</li>
                <li><strong>Payment Method:</strong> $paymentMethod</li>
            </ul>

            <h3>Uploads</h3>
            <ul>
                <li><strong>Valid ID 1:</strong><br><img src='cid:$cidValidId1' style='max-width:300px;'></li>
                <li><strong>Valid ID 2:</strong><br><img src='cid:$cidValidId2' style='max-width:300px;'></li>
                <li><strong>Proof of Income:</strong><br><img src='cid:$cidIncome' style='max-width:300px;'></li>
                <li><strong>Proof of Billing:</strong><br><img src='cid:$cidBilling' style='max-width:300px;'></li>
            </ul>

            <h3>Consent</h3>
            <ul>
                <li><strong>Agreed to Terms:</strong> " . ($agreeTerms ? "Yes" : "No") . "</li>
                <li><strong>Allow Marketing:</strong> " . ($allowMarketing ? "Yes" : "No") . "</li>
            </ul>

            <br><p>We will contact you shortly after verification.</p>
            <p>Regards,<br><strong>FAST CASH Team</strong></p>
        ";

        $mail->send();
    } catch (Exception $e) {
        error_log("PHPMailer Error: " . $mail->ErrorInfo);
    }

    echo "<script>alert('Application submitted successfully!'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Failed to submit application. Please try again.'); history.back();</script>";
}

$stmt->close();
$conn->close();
?>
