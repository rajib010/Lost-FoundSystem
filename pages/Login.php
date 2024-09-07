<?php
include "../utility/Database.php";
$db = new Database();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["loginBtn"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $userType = isset($_POST['userType']) ? $_POST['userType'] : 0;

        // Use prepared statements to prevent SQL injection
        $stmt = $db->conn->prepare("SELECT * FROM user_info WHERE email = ? AND user_type = ?");
        $stmt->bind_param("si", $email, $userType);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $errors['email'] = "User does not exist.";
        } else {
            $row = $result->fetch_assoc();
            if ($row["password"] != $password) {
                $errors["password"] = "Invalid password. Try again.";
            } else {
                session_start();
                if ($userType == 0) {
                    $_SESSION["loggedinuser"] = $row["username"];
                    header("location: ./index.php");
                } else if ($userType == 1) {
                    $_SESSION["loggedinadmin"] = $row["username"];
                    header("location: ../dashboard/pages/index.php");
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
                <form action="" method="post">
                    <div class="input-container" data-icon="👨">
                        <input type="text" placeholder="Enter your email" name="email" class="inputField">
                        <p class="error"><?php echo $errors['email'] ?? ''; ?></p>
                    </div>
                    <div class="input-container" data-icon="🔒">
                        <input type="password" placeholder="Enter your password" class="inputField" name="password" id="password">
                        <span class="toggle-password" onclick="togglePasswordVisibility()"><i
                                class="fa-solid fa-eye-slash"></i></span>
                        <p class="error"><?php echo $errors['password'] ?? '' ?></p>
                    </div>
                    <div class="userType-container">
                        <label for="">Log in as</label>
                        <label for="user">User
                            <input type="radio" name="userType" value="0" id="user">
                        </label>
                        <label for="admin">Admin
                            <input type="radio" name="userType" value="1" id="admin">
                        </label>
                    </div>
                    <p><a href="#">Forgot Password?</a></p>
                    <button type="submit" name="loginBtn" class="loginBtn">Login</button>
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