<?php
require_once('../../utility/Database.php');
$db = new Database();

session_start();
if (isset($_SESSION['loggedinuserId'])) {
    header('Location: ../pages/home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['resetBtn'])) {
        $password = htmlspecialchars($_POST['password']);
        $cpassword = htmlspecialchars($_POST['cpassword']);
        if($password!==$cpassword){
            //error using frontend
        }

        if (isset($_GET['email'])) {
            $email = htmlspecialchars($_GET['email']);
        }
        // Sanitize email input
        $password = ($password);
        $password = htmlspecialchars($password);
        $where = "email='$email'";

        $result = $db->update('user_info',['password'=>$password], $where);
        if ($result) {
            echo "<script>
                    alert('User password updated successfully');
                    window.location.href='../login.php';
                  </script>";
        } else {
            
                echo "<script>alert('Failed to update password');
                    window.locatio.reload();
                    </script>
                    ";
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
                <input type="password" placeholder="Enter new password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Confirm your password" name="cpassword" id="cpassword" required>
                <p id="error"></p>
            </div>
            
            <button type="submit" class="btn" name="resetBtn">Reset</button>
        </form>
    </section>
</body>

</html>