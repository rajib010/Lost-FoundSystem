<?php
include "../utility/Database.php";
$db = new Database();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["loginBtn"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        if (empty($email)) {
            $errors['email'] = "Email cannot be empty";
        }
        if (empty($password)) {
            $errors['password'] = "Password cannot be empty";
        }
        $where = "email='$email'";
        $result = $db->select("user_info", "*", null, $where, null, null);

        if ($result->num_rows == 0) {
            $errors['email'] = "User does not exist.";
        } else {
            $row = $result->fetch_assoc();
            if (!password_verify($password, $row["password"])) {
                $errors["password"] = "Invalid password. Try again.";
            } else {
                session_start();
                if ($row['user_type'] == 0) {
                    if ($row['status'] == 'deactivated') {
                        echo "<script>
                            alert('User is suspened.Please contact the admin');
                            window.location.href='../index.php#contact';
                        </script>";
                        exit();
                    }
                    $_SESSION["loggedinuserId"] = $row["id"];
                    $_SESSION['userImg'] = $row['profileImg'];
                    header("location: ../pages/home.php");
                    exit();
                } else if ($row['user_type'] == 1) {
                    $_SESSION["loggedinadmin"] = $row["name"];
                    header("location: ../dashboard/users.php");
                    exit();
                }
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
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../index.css" />
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            overflow: hidden;
        }

        .login-section {
            justify-content: space-between;
            width: 60%;
            padding: 0;
            height: 90%;
            overflow: hidden;
        }

        .form-class {
            gap: 7px;
        }

        .left-side {
            width: 50%;
            max-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        a {
            color: blue;
            cursor: pointer;
        }

        .input-container {
            position: relative;
            margin-bottom: 0;
        }

        .form-group input {
            padding-left: 40px;
            padding-right: 40px;
        }

        .form-group {
            position: relative;
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-group::before {
            content: attr(data-icon);
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2rem;
            color: #333;
        }

        .fa-eye:before {
            content: "\f06e";
            color: black;
        }

        .fa-eye-slash:before {
            content: "\f070";
            color: black;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2rem;
        }

        .right-side {
            width: 50%;
            height: 100%;
            background-image: url(../public/lost.svg);
            background-size: cover;
            background-position: center;
        }

        .error {
            position: absolute;
            top: 100%;
            left: 0;
            color: red;
            font-size: 0.8rem;
            margin-top: 3px;
        }

        .left {
            text-align: left;
        }


        /* Responsive Design for Tablets */
        @media (min-width: 768px) and (max-width: 1024px) {

            .login-section {
                width: 90%;
            }

            .left-side,
            .right-side {
                width: 100%;
                height: 100%;
            }

            .left-side {
                padding: 5vw;
            }

            .content-p,
            a {
                font-size: 1.8vw;
            }

            .right-side {
                background-image: url(./public/lost.svg);
            }

            .input-container::before {
                top: 37%;
            }
        }

        /* Responsive Design for Mobiles */
        @media (max-width: 767px) {
            .login-section {
                width: 90%;
            }

            .right-side {
                display: none;
            }

            .left-side {
                width: 100%;
                align-items: center;
                padding: 1rem;
            }

            .header {
                width: 100%;
                justify-content: center;
            }

            .input-container::before {
                top: 37%;
            }

        }
    </style>
</head>

<body class="center">
    <main class="login-section center">
        <div class="left-side center">
            <h1 class="content-header">Welcome back!!</h1>
            <div class="input-fields">
                <form class="form-class" action="" method="post">
                    <div class="form-group" data-icon="✉">
                        <input type="text" placeholder="Enter your email" name="email"
                            value="<?php $_POST['email'] ?? '' ?>">
                        <p class="error"><?php echo $errors['email'] ?? '' ?></p>
                    </div>
                    <div class="form-group" data-icon="🔒">
                        <input type="password" placeholder="Enter your password" name="password" id="password">
                        <span class="toggle-password" onclick="togglePasswordVisibility()"><i
                                class="fa-solid fa-eye-slash"></i></span>
                        <p class="error"><?php echo $errors['password'] ?? '' ?></p>
                    </div>
                    <p class="content-p left"><a href="./forgot/forgotPassword.php">Forgot Password?</a></p>
                    <button type="submit" name="loginBtn" class="btn">Login</button>
                    <p class="content-p">Don't have an account?
                        <span>
                            <a href="./signup.php">Sign up now.</a>
                        </span>
                    </p>
                </form>
            </div>
        </div>
        <div class="right-side center">
        </div>
    </main>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById("password");
            const toggleIcon = document.querySelector(".toggle-password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.innerHTML = `<i class="fa-solid fa-eye"></i>`;
            } else {
                passwordField.type = "password";
                toggleIcon.innerHTML = `<i class="fa-solid fa-eye-slash"> </i>`;
            }
        }
    </script>
</body>

</html>