<?php
require_once('../../utility/Database.php');

session_start();
if (isset($_SESSION['loggedinuserId'])) {
    header('Location: ../pages/home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resetBtn'])) {
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_GET['email']);

    $db = new Database();
    $where = "email='$email'";

    if ($db->update('user_info', ['password' => $password], $where)) {
        echo "<script>alert('Password reset successfully.'); window.location.href='../login.php';</script>";
    } else {
        echo "<script>alert('Failed to reset password.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../../index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 0;
            top: 0;

        }

        .forgot-section {
            max-width: 500px;
        }

        .form-group {
            position: relative;
        }

        span>a {
            color: blue;
            font-size: small;
        }

        .error {
            margin: 5px 0px;

        }
    </style>
</head>

<body>
    <section class="forgot-section">
        <h1 class="content-header">Change Password</h1>
        <form class="form-class" method="post" action="" onsubmit="return validatePassword()">
            <div class="form-group">
                <input type="password" placeholder="Enter new password" name="password" id="password">
                <span class="toggle-password" onclick="togglePasswordVisibility('password', this)">
                    <i class="fa-solid fa-eye-slash"></i>
                </span>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Confirm your password" name="cpassword" id="cpassword">
                <span class="toggle-password" onclick="togglePasswordVisibility('cpassword', this)">
                    <i class="fa-solid fa-eye-slash"></i>
                </span>
                <p class="error"></p>
            </div>
            <button type="submit" class="btn" name="resetBtn">Reset</button>
        </form>
    </section>
    <script>
        function validatePassword() {
            let isValid = true;
            const errorParagraph = document.querySelector(".error");
            errorParagraph.innerText = "";
            const password = document.getElementById('password').value;
            const cpassword = document.getElementById('cpassword').value;

            if (password.length < 6) {
                errorParagraph.innerText = 'Password must be at least 6 characters long'
                isValid = false
            }

            if (password !== cpassword) {
                errorParagraph.innerText = 'Passwords donot match'
                isValid = false;
            }
            return isValid;
        }

        function togglePasswordVisibility(fieldId, iconElement) {
            const passwordField = document.getElementById(fieldId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                iconElement.innerHTML = `<i class="fa-solid fa-eye"></i>`;
            } else {
                passwordField.type = "password";
                iconElement.innerHTML = `<i class="fa-solid fa-eye-slash"></i>`;
            }
        }
    </script>
</body>

</html>