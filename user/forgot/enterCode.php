<?php
require_once('../../utility/Database.php');

session_start();
if (isset($_SESSION['loggedinuserId'])) {
    header('Location: ../pages/home.php');
    exit();
}

$db = new Database();
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitBtn'])) {
    $otp = htmlspecialchars($_POST['otp']);
    $where = "email='$email'";

    $result = $db->select('user_info', 'verify_code', null, $where);
    if ($result && $row = $result->fetch_assoc()) {
        if ($otp == $row['verify_code']) {
            $db->update('user_info', ['verify_code' => null], $where);
            echo "<script>alert('OTP verified.'); window.location.href='./resetPassword.php?email=$email';</script>";
        } else {
            echo "<script>alert('Invalid OTP.');</script>";
        }
    } else {
        echo "<script>alert('Invalid action.'); window.location.href='../login.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Code</title>
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
        }
    </style>
</head>

<body>
    <section class="forgot-section">
        <h1 class="content-header">Enter Code</h1>
        <form class="form-class" method="post" action="">
            <div class="form-group">
                <input type="text" placeholder="Enter OTP code" name="otp" id="otp" required>
            </div>
            <button type="submit" class="btn" name="submitBtn">Submit</button>
        </form>
    </section>
</body>

</html>