<?php require("./components/Header.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Send Mail</title>
    <link rel="stylesheet" href="./index.css">
    <style>
        .admin-panel {
            padding: 5px 20px;
            width: 80vw;
            margin: 0 auto;
        }

        .admin-dashboard {
            display: flex;
        }

        /* Form Styles */
        .mail-form {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group>label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group>textarea {
            resize: vertical;
        }

        .send-btn {
            background-color: #ff5722;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 50%;
            margin: auto;
        }

        .send-btn:hover {
            background-color: #e64a19;
        }
    </style>
</head>

<body>

    <main class="admin-dashboard">
        <?php require("./components/Nav.php"); ?>
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