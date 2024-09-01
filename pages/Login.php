<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            width: 100%;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f2f2f2;
            padding: 1rem;
        }

        .main-content {
            display: flex;
            justify-content: space-between;
            width: 60%;
            height: 90vh;
            align-items: center;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .left-side {
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem;
            background-color: #fff;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            width: 95%;
            margin-bottom: 2rem;
        }

        .header>img {
            width: 5rem;
        }

        .header>h1 {
            font-size: 2rem;
        }

        .input-fields {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .input-container {
            position: relative;
            margin-bottom: 1vw;
        }

        .input-container::before {
            content: attr(data-icon);
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2rem;
        }

        .inputField {
            width: 100%;
            padding: 0.5rem 0.5rem 0.5rem 2.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .input-container .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2rem;
        }

        .loginBtn {
            width: 100%;
            padding: 0.75rem;
            border-radius: 5px;
            background: blue;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            border: none;
            margin: 1vw auto;
        }

        .loginBtn:hover {
            background-color: darkblue;
        }

        .right-side {
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url(../public/lost.svg);
            background-size: cover;
            background-position: center;
        }

        p>span>a {
            color: blue;
            text-decoration: none;
            cursor: pointer;
        }

        /* Tablet devices (768px to 1024px) */
        @media (min-width: 768px) and (max-width: 1024px) {
            .main-content {
                flex-direction: column;
                width: 80%;
                height: auto;
                padding: 2rem;
            }

            .left-side,
            .right-side {
                width: 100%;
                height: auto;
            }

            .header {
                width: 85%;
            }

            .header>img {
                width: 6rem;
            }

            .header>h1 {
                font-size: 2.5rem;
            }

            .inputField {
                font-size: 1.2rem;
                margin-bottom: 2vw;
            }

            .input-container::before {
                top: 37%;
            }

            .toggle-password {
                bottom: -2vw;
            }

            .loginBtn {
                font-size: 1.2rem;
                margin: 2vw auto;
            }
        }

        /* Mobile devices (max-width: 767px) */
        @media (max-width: 767px) {
            .main-content {
                flex-direction: column;
                width: 90%;
                height: auto;
                padding: 1rem;
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

            .header>img {
                width: 8rem;
            }

            .header>h1 {
                font-size: 1.8rem;
            }

            .inputField {
                height: auto;
                font-size: 1.5rem;
                padding: 0.5rem 0.5rem 0.5rem 2.5rem;
                margin-bottom: 2.5vw;
            }

            .input-container::before {
                top: 37%;
            }

            .toggle-password {
                bottom: -2vw;
            }

            .loginBtn {
                height: auto;
                padding: 1rem;
                font-size: 1.5rem;
                margin: 2vw auto;
            }
        }
    </style>
</head>

<body>
    <main class="main-content">
        <div class="left-side">
            <div class="header">
                <img src="../public/logo.svg" alt="logo">
                <h1>Welcome back!!</h1>
            </div>
            <div class="input-fields">
                <form action="" method="">
                    <div class="input-container" data-icon="👨">
                        <input type="text" placeholder="Enter your email" class="inputField">
                    </div>
                    <div class="input-container" data-icon="🔒">
                        <input type="password" placeholder="Enter your password" class="inputField" id="password">
                        <span class="toggle-password" onclick="togglePasswordVisibility()"><i
                                class="fa-solid fa-eye-slash"></i></span>
                    </div>
                    <p><a href="#">Forgot Password?</a></p>
                    <button type="submit" class="loginBtn">Login</button>
                    <p>Don't have an account?
                        <span>
                            <a href="../pages/Signup.php">Sign up now.</a>
                        </span>
                    </p>
                </form>
            </div>
        </div>
        <div class="right-side">
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