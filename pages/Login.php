<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/Login.css" />
   
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