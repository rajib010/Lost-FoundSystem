<?php
require_once('../../utility/Database.php');
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$db = new Database();

session_start();
if (isset($_SESSION['loggedinuserId'])) {
    header('Location: ../../pages/home.php');
    exit();
}

if (isset($_GET['email'])) {
    $email = htmlspecialchars($_GET['email']);
    $where = "email='$email'";

    // Generate a 6-digit verification code
    $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    $updateParams = [
        'verify_code' => $code,
        'code_generated_at' => date('Y-m-d H:i:s')
    ];

    // Update the user's verify_code and timestamp in the database
    if ($db->update('user_info', $updateParams, $where)) {
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USER'];
            $mail->Password = $_ENV['SMTP_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $_ENV['SMTP_PORT'];

            // Recipients
            $mail->setFrom($_ENV['MAIL_FROM'], 'Rajib Pokhrel');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password reset code';
            $mail->Body = "This is a password reset code. Ignore this if you havenot requested for the code. The code is $code";

            $mail->send();
            echo "<script>alert('Email sent successfully!')
                    window.location.href='./enterCode.php';        
            </script>";
        } catch (Exception $e) {
            echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
        }
    } else {
        header('Location: forgotPassword.php');
        exit();
    }
}
