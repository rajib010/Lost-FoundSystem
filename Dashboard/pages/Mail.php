<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/Mail.css">
</head>

<body>
    <header class="admin-header">
        <h1>Welcome, Admin</h1>
        <button class="logout-btn">Log out</button>
    </header>

    <main class="admin-dashboard">
        <?php require("../components/Nav.php"); ?>
        <div class="admin-panel">
            <h1>Send Mail</h1>
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
