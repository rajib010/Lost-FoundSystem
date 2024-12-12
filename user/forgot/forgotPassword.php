<?php
require_once('../../utility/Database.php');
require_once('../../utility/SendMail.php');

session_start();
if (isset($_SESSION['loggedinuserId'])) {
    header('Location: ../pages/home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitBtn'])) {
    $email = htmlspecialchars($_POST['email']);
    $db = new Database();

    $where = "email='$email'";
    $result = $db->select('user_info', 'email', null, $where);

    if ($result && $result->num_rows > 0) {
        $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $subject = 'Password Reset OTP Code';
        $content = "Here is your OTP code for password reset: $code";

        $updateParams = ['verify_code' => $code];
        $db->update('user_info', $updateParams, $where);

        if (sendMail($email, $subject, $content)) {
            echo "<script> window.location.href='./enterCode.php?email=$email';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Email not found');</script>";
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

        span>a {
            color: blue;
            font-size: small;
        }
    </style>
</head>

<body>
    <section class="forgot-section">
        <h1 class="content-header">Password Recovery</h1>
        <form class="form-class" method="post" action="">
            <div class="form-group">
                <input type="email" placeholder="Enter your email" name="email" id="email" required>
            </div>
            <p class="content-p">Try another way?
                <span>
                    <a href="../login.php">Enter your password.</a>
                </span>
            </p>
            <button type="submit" class="btn" name="submitBtn">Send</button>
        </form>
    </section>
</body>

</html>