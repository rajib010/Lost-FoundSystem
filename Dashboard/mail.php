<?php
require './components/Header.php';
require '../vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Send Mail</title>
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <main class="admin-dashboard">
        <?php require("./components/Nav.php"); ?>
        <div class="admin-panel">
            <h1 class="content-header admin-title">Send Mail</h1>
            <div class="mail-form">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $receiverEmail = $_POST['receiver-email'];
                    $subject = $_POST['subject'];
                    $content = $_POST['content'];

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
                        $mail->addAddress($receiverEmail);

                        // Content
                        $mail->isHTML(true);
                        $mail->Subject = $subject;
                        $mail->Body = $content;

                        $mail->send();
                        echo "<script>alert('Email sent successfully!')
                                window.reload();        
                        </script>";
                    } catch (Exception $e) {
                        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
                    }
                }
                ?>

                <form class="form-class" method="POST">
                    <div class="form-group">
                        <label for="receiver-email">Receiver Email:</label>
                        <input type="email" id="receiver-email" name="receiver-email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Content:</label>
                        <textarea id="content" name="content" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn">Send</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>