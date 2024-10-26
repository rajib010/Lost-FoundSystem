<?php

if(file_exists('../vendor/autoload.php')){
    require_once '../vendor/autoload.php';
}else if(file_exists('../../vendor/autoload.php')){
    require_once '../../vendor/autoload.php';    
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($receiver, $subject, $content)
{
    $mail = new PHPMailer(true);

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
        $mail->addAddress($receiver);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $content;

        return $mail->send();
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
    }
}
