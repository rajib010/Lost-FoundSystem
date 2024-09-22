<?php require("./components/Header.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Send Mail</title>
    <link rel="stylesheet" href="./index.css">

</head>

<body>
    <main class="admin-dashboard">
        <?php require("./components/Nav.php"); ?>
        <div class="admin-panel">
            <h1 class="title">Send Mail</h1>
            <div class="mail-form">
                <form>
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
                    <button type="submit" class="send-btn">Send</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>