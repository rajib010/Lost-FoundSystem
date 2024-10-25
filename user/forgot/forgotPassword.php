<?php
require_once('../../utility/Database.php');
$db = new Database();

session_start();
if (isset($_SESSION['loggedinuserId'])) {
    header('Location: ../pages/home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submitBtn'])) {
        $email = $_POST['email'];

        // Sanitize email input
        $email = htmlspecialchars($email);
        $where = "email='$email'";

        $result = $db->select('user_info', 'email', null, $where, null, null);
        if (!$result) {
            echo "<script>
                    alert('No user found with the email');
                    window.location.reload();
                  </script>";
        } else {
            $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $where = "email=$email";
            $updateParams = ['verify_code' => $code];
            $result = $db->update('user_info', $updateParams, $where);
            if ($result) {
                header('location: requestCode.php');
                exit();
            } else {
                echo "<script>alert('Internal Server Error');
                    window.location.href= '../login.php';
                    </script>
                    ";
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
    <title>Forgot Password</title>
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
            font-size: small;
        }
    </style>
</head>

<body>
    <section class="forgot-section">
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