<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup page</title>
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
            width: 100%;
            max-width: 100%;
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        main {
            width: 90%;
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .myForm {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .myForm>h1 {
            margin-bottom: 3vw;
        }

        .inputContainer {
            width: 48%;
            margin-bottom: 15px;
            position: relative;
        }

        .inputContainer.fullWidth {
            width: 100%;
            height: 4vw;
        }

        .inputContainer.profileContainer {
            width: 60%;
        }

        .inputContainer>label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .inputField,
        .passwordField {
            width: 100%;
            height: 2.6vw;
            border-radius: 10px;
            padding: 0.5em 1em;
            border: 1px solid #ccc;
            font-size: 1em;
            outline: none;
        }

        .passwordContainer {
            display: flex;
            align-items: center;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 70%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .error {
            font-size: smaller;
            color: red;
            display: none;
        }

        .loginPoint {
            width: 100%;
            text-align: center;
            margin-top: 15px;
        }

        .signup {
            width: 100%;
            text-align: center;
            margin-top: 10px;
        }

        .signup button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        @media (min-width: 767px) and (max-width:1024px) {

            .inputField,
            .passwordField {
                height: 4.5vw;
            }

        }

        @media (max-width: 768px) {
            .inputContainer {
                width: 100%;
            }

            .inputContainer.profileContainer {
                width: 100%;
            }

            .inputField,
            .passwordField {
                height: 7vw;
                padding: 0.8em 1em;
            }

            .toggle-password {
                top: 70%;
                transform: translateY(-50%);
            }
        }

        @media (max-width: 600px) {

            .inputField,
            .passwordField {
                height: 7vw;
            }

            .toggle-password {
                top: 75%;
                transform: translateY(-50%);
            }
        }
    </style>

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