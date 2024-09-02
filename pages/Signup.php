<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/pages/Signup.css">
</head>

<body>
    <main>
        <form action="" method="" onsubmit="" class="myForm">
            <h1>Sign up to get connected with us...</h1>
            <div class="inputContainer">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" class="inputField" name="fullName" placeholder="Ram Bahadur" required>
                <p class="error">Error</p>
            </div>
            <div class="inputContainer">
                <label for="email">Email</label>
                <input type="email" id="email" class="inputField" name="email" placeholder="ram@gmail.com" required>
                <p class="error">Error</p>
            </div>
            <div class="inputContainer">
                <label for="password">Password</label>
                <div class="passwordContainer">
                    <input type="password" placeholder="Enter password" class="passwordField" id="password">
                    <span class="toggle-password" onclick="togglePasswordVisibility()"><i
                            class="fa-solid fa-eye-slash"></i></span>
                </div>
                <p class="error">Error</p>
            </div>
            <div class="inputContainer">
                <label for="cpassword">Confirm Password</label>
                <div class="passwordContainer">
                    <input type="password" placeholder="Confirm Password" class="passwordField" id="cpassword">
                    <span class="toggle-password" onclick="togglePasswordVisibility()"><i
                            class="fa-solid fa-eye-slash"></i></span>
                </div>
                <p class="error">Error</p>
            </div>
            <div class="inputContainer">
                <label for="mobile">Mobile No</label>
                <input type="text" id="mobile" class="inputField" name="mobile" placeholder="98xxxxxxxx" required>
                <p class="error">Error</p>
            </div>
            <div class="inputContainer">
                <label for="address">Address</label>
                <input type="text" id="address" class="inputField" name="address" placeholder="123 Street, Abc town"
                    required>
                <p class="error">Error</p>
            </div>
            <div class="inputContainer profileContainer">
                <label for="profile">Profile Image</label>
                <input type="file" name="profile" id="profile" class="inputField" required>
                <p class="error">Error</p>
            </div>
            <div class="loginPoint">
                <p>Already have an account? <span><a href="../pages/Login.php">Login</a></span></p>
            </div>
            <div class="signup">
                <button class="loginButton" type="submit">Sign up</button>
            </div>
        </form>
    </main>
    <script>
        function togglePasswordVisibility() {
            const passwordFields = document.querySelectorAll(".passwordField");
            const toggleIcons = document.querySelectorAll(".toggle-password i");

            passwordFields.forEach((passwordField, index) => {
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    toggleIcons[index].classList.remove("fa-eye-slash");
                    toggleIcons[index].classList.add("fa-eye");
                } else {
                    passwordField.type = "password";
                    toggleIcons[index].classList.remove("fa-eye");
                    toggleIcons[index].classList.add("fa-eye-slash");
                }
            });
        }
    </script>

</body>

</html>