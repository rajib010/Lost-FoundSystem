<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['submitBtn'])) {
        if (empty($_POST["fullName"])) {
            $errors['fullName'] = "Full Name is required";
        }
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email address";
        }
        if (strlen($_POST["password"]) < 6) {
            $errors['password'] = "Password must be at least 6 characters";
        }
        if ($_POST["password"] !== $_POST["confirmPassword"]) {
            $errors['confirmPassword'] = "Passwords do not match";
        }
        if (!preg_match("/^\d{10}$/", $_POST["phone_number"])) {
            $errors['phone_number'] = "Invalid phone number";
        }
        if (empty($_POST["address"])) {
            $errors['address'] = "Address is required";
        }
        // if (!isset($_FILES['profileImg']) || $_FILES['profileImg']['error'] != 0) {
        //     $errors['profileImg'] = "Profile image is required or failed to upload";
        // } else {
        //     // Check allowed file types
        //     $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        //     $fileType = $_FILES['profileImg']['type'];

        //     if (!in_array($fileType, $allowedTypes)) {
        //         $errors['profileImg'] = "Only JPG, PNG, and GIF formats are allowed.";
        //     } else {
        //         // Process image upload
        //         $fileExtension = pathinfo($_FILES['profileImg']['name'], PATHINFO_EXTENSION);
        //         $fileName = uniqid() . '.' . $fileExtension;
        //         $uploadDir = 'uploads/';
        //         $targetFile = $uploadDir . $fileName;

        //         if (!move_uploaded_file($_FILES['profileImg']['tmp_name'], $targetFile)) {
        //             $errors['profileImg'] = "Failed to upload image.";
        //         }
        //     }
        // }

        // If no errors, redirect to the login page
        if (empty($errors)) {
            header('location: ./Login.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="../styles/Signup.css">
</head>

<body>
    <main>
        <form action="" method="post" enctype="multipart/form-data" class="myForm">
            <h1>Sign up to get connected with us...</h1>

            <div class="inputContainer">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" class="inputField" name="fullName" value="<?php echo htmlspecialchars($_POST['fullName'] ?? ''); ?>">
                <p class="error"><?php echo $errors['fullName'] ?? ''; ?></p>
            </div>

            <div class="inputContainer">
                <label for="email">Email</label>
                <input type="email" id="email" class="inputField" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                <p class="error"><?php echo $errors['email'] ?? ''; ?></p>
            </div>

            <div class="inputContainer">
                <label for="password">Password</label>
                <div class="passwordContainer">
                    <input type="password" placeholder="Enter password" class="passwordField" name="password" id="password">
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <i class="fa-solid fa-eye-slash"></i>
                    </span>
                </div>
                <p class="error"><?php echo $errors['password'] ?? ''; ?></p>
            </div>

            <div class="inputContainer">
                <label for="confirmpassword">Confirm Password</label>
                <div class="passwordContainer">
                    <input type="password" placeholder="Confirm Password" name="confirmPassword" class="passwordField" id="confirmpassword">
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <i class="fa-solid fa-eye-slash"></i>
                    </span>
                </div>
                <p class="error"><?php echo $errors["confirmPassword"] ?? ''; ?></p>
            </div>

            <div class="inputContainer">
                <label for="phone_number">Phone No</label>
                <input type="text" id="phone_number" class="inputField" name="phone_number" value="<?php echo htmlspecialchars($_POST['phone_number'] ?? ''); ?>">
                <p class="error"><?php echo $errors['phone_number'] ?? ''; ?></p>
            </div>

            <div class="inputContainer">
                <label for="address">Address</label>
                <input type="text" id="address" class="inputField" name="address" value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>">
                <p class="error"><?php echo $errors['address'] ?? ''; ?></p>
            </div>

            <div class="inputContainer profileContainer">
                <label for="profile">Profile Image</label>
                <input type="file" name="profileImg" id="profile">
                <p class="error"><?php echo $errors['profileImg'] ?? ''; ?></p>
            </div>
            <div class="loginPoint">
                <p>Already have an account? <span><a href="../pages/Login.php">Login</a></span></p>
            </div>

            <div class="signup">
                <button class="loginButton" type="submit" name="submitBtn">Sign up</button>
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