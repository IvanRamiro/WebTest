<?php
// Database configuration
$host = "localhost";
$db = "fastcash_db";
$user = "root"; // Change if needed
$pass = "";     // Change if needed

// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// Create DB connection
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Upload directory
$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Upload file
function uploadFile($field) {
    global $uploadDir;
    $fileName = basename($_FILES[$field]['name']);
    $targetPath = $uploadDir . time() . "_" . $fileName;
    move_uploaded_file($_FILES[$field]['tmp_name'], $targetPath);
    return $targetPath;
}

// Sanitize input
function sanitize($data) {
    return htmlspecialchars(trim($data));
}

// Assign variables
$firstName = sanitize($_POST['firstName']);
$middleName = sanitize($_POST['middleName']);
$lastName = sanitize($_POST['lastName']);
$birthDate = $_POST['birthDate'];
$civilStatus = $_POST['civilStatus'];
$email = sanitize($_POST['email']);
$mobile = sanitize($_POST['mobile']);

$currentAddress = sanitize($_POST['currentAddress']);
$permanentAddress = sanitize($_POST['permanentAddress']);
$sameAsCurrent = isset($_POST['sameAsCurrent']) ? 1 : 0;
$city = sanitize($_POST['city']);
$province = sanitize($_POST['province']);
$zipCode = sanitize($_POST['zipCode']);

$employmentStatus = $_POST['employmentStatus'];
$monthlyIncome = $_POST['monthlyIncome'];
$employerName = sanitize($_POST['employerName']);
$jobPosition = sanitize($_POST['jobPosition']);
$workDuration = sanitize($_POST['workDuration']);
$workAddress = sanitize($_POST['workAddress']);

$loanAmount = $_POST['loanAmount'];
$loanPurpose = $_POST['loanPurpose'];
$loanTerm = $_POST['loanTerm'];
$paymentMethod = $_POST['paymentMethod'];

$validId1 = uploadFile('validId1');
$validId2 = uploadFile('validId2');
$proofOfIncome = uploadFile('proofOfIncome');
$proofOfBilling = uploadFile('proofOfBilling');

$agreeTerms = isset($_POST['agreeTerms']) ? 1 : 0;
$allowMarketing = isset($_POST['allowMarketing']) ? 1 : 0;

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

        $mail->isHTML(true);
        $mail->Subject = "Loan Application Received";
        $mail->Body    = "
            <p>Dear $firstName,</p>
            <p>Thank you for applying for a loan with <strong>FAST CASH</strong>. Your application has been received and is under review.</p>
            <p>We will contact you shortly after verification.</p>
            <br>
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
