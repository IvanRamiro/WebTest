<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD']=="POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = "sonatavann@gmail.com";
        $mail->Password = "jszf oarb vgil tfrx";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail ->setFrom("mocaaoa69@gmaail.com","Moca");
        $mail->addAddress("sonatavann@gmail.com", "Evan");

        $mail->Subject = "Contact Us Form Submission";
        $mail->Body = "Name: $name\n".
                        "Email: $email\n".
                       "Message: $message";

        if ($mail->send()) {
            echo "Message sent successfully!";
        } else {
            echo "Message could not be sent: ". $mail->ErrorInfo;
        }
    
} catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
?>