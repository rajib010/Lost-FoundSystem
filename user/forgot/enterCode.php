<?php

require_once('../../utility/Database.php');
$db = new Database();

session_start();
if (isset($_SESSION['loggedinuserId'])) {
    header('Location: ../pages/home.php');
    exit();
}

$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submitBtn'])) {
        $otp = $_POST['otp'];

        // Sanitize input
        $otp = htmlspecialchars($otp);
        $where = "verify_code='$otp'";

        $result = $db->select('user_info', 'email', null, $where, null, null);
        if (!$result) {
            echo "<script>
                    alert('Invalid OTP code.');
                    window.location.reload();
                  </script>";
        } else {
            $where = "email=$email";
            $reset = $db->update('user_info', ['verify_code' => null], $where);
            if ($reset) {
                echo `<script>
                    alert('OTP verified successfully. You can reset your password now.');
                    window.location.href = "resetPassword.php?email=${$email}";
                 </script>`;
            }
        }
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
        <form class="form-class" method="post" action="">
            <div class="form-group">
                <input type="text" placeholder="Enter OTP code" name="otp" id="otp" required>
            </div>
            <p class="content-p">Didn't get the code?
                <span>
                    <a href="./requestCode.php<?php echo $email ? '?email=' . urlencode($email) : ''; ?>">Request Again</a>
                </span>
            </p>
            <button type="submit" class="btn" name="submitBtn">Submit</button>
        </form>
    </section>
</body>

</html>