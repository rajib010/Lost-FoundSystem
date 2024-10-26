<?php
require './components/Header.php';
require '../vendor/autoload.php';
require '../utility/SendMail.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$receiverEmail = '';

if (isset($_GET['receiver'])) {
    $receiverEmail = $_GET['receiver']?? '';
}

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
                    sendMail($receiverEmail, $subject, $content);
                }
                ?>

                <form class="form-class" method="POST">
                    <div class="form-group">
                        <label for="receiver-email">Receiver Email:</label>
                        <input type="email" id="receiver-email" name="receiver-email" value="<?= $receiverEmail ?>" required>
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