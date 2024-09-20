<?php require("./components/Header.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Send Mail</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0px;
            padding: 0px;
        }

        .admin-panel {
            padding: 15px 20px;
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .admin-dashboard {
            display: flex;
        }

        .title {
            width: 100%;
            text-align: center;
            margin: 1vw auto;
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
            width: 100%;
            font-size: 1.2vw;
            margin: auto;
        }

        .send-btn:hover {
            background-color: #e64a19;
        }
    </style>
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