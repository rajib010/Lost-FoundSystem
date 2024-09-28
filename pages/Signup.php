<?php
include "../utility/Database.php";

$db = new Database();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['submitBtn'])) {
        $name = $_POST["fullName"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $phoneNumber = $_POST["phone_number"];
        $address = $_POST["address"];

        // Validate inputs
        if (empty($name)) {
            $errors['fullName'] = "Full Name is required";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email address";
        }
        if (strlen($password) < 6) {
            $errors['password'] = "Password must be at least 6 characters";
        }
        if ($password !== $confirmPassword) {
            $errors['confirmPassword'] = "Passwords do not match";
        }
        if (!preg_match("/^\d{10}$/", $phoneNumber)) {
            $errors['phone_number'] = "Invalid phone number";
        }
        if (empty($address)) {
            $errors['address'] = "Address is required";
        }

        if (!isset($_FILES['profileImg']) || $_FILES['profileImg']['error'] != 0) {
            $errors['profileImg'] = "Profile image is required or failed to upload";
        } else {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileType = $_FILES['profileImg']['type'];

            if (!in_array($fileType, $allowedTypes)) {
                $errors['profileImg'] = "Only JPG, PNG, and GIF formats are allowed.";
            } else {
                $fileExtension = pathinfo($_FILES['profileImg']['name'], PATHINFO_EXTENSION);
                $fileName = uniqid() . '.' . $fileExtension;
                $uploadDir = '../uploads/user/';
                $targetFile = $uploadDir . $fileName;

                if (!move_uploaded_file($_FILES['profileImg']['tmp_name'], $targetFile)) {
                    $errors['profileImg'] = "Failed to upload image.";
                }
            }
        }

        // If no errors, carry on with the signup process
        if (empty($errors)) {
            $result = $db->insert("user_info", [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'phone_number' => $phoneNumber,
                'address' => $address,
                'profileImg' => $fileName
            ]);

            if ($result) {
                echo "<script>
                        if (confirm('You have been registered successfully. Click OK to redirect to the login page')) {
                            window.location.href = '../index.php';
                        }
                      </script>";
                exit();
            } else {
                echo "Error during signup";
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
    <title>Signup page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="../styles/index.css">
    <style>
        body {
            overflow-y: auto;
        }

        .signup-section {
            overflow-y: auto;
            width: 80%;
            padding: 2vw 5vw;
        }

        .form-class {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

       .signup-section form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .signup-section .form-group {
            width: 100%;
        }

        .signup-section .form-group:nth-last-child(3) {
            grid-column: 1 / -1;
        }

        .signup-section button {
            grid-column: 1 / -1;
        }
        
        a {
            color: blue;
        }

        a,
        .content-p {
            font-size: 1em;
        }

        .content-p {
            width: 100%;
            text-align: left;
        }

        @media (max-width: 767px) {
            .signup-section form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body class="center">
    <main class="signup-section">
        <h1 class="content-header">Become a Member Today!</h1>
        <form action="" method="post" enctype="multipart/form-data" class="form-class">

            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" class="inputField" name="fullName" value="<?php echo htmlspecialchars($_POST['fullName'] ?? ''); ?>">
                <p class="error"><?php echo $errors['fullName'] ?? ''; ?></p>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="inputField" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                <p class="error"><?php echo $errors['email'] ?? ''; ?></p>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="passwordContainer">
                    <input type="password" placeholder="Enter password" class="passwordField" name="password" id="password">
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <i class="fa-solid fa-eye-slash"></i>
                    </span>
                </div>
                <p class="error"><?php echo $errors['password'] ?? ''; ?></p>
            </div>

            <div class="form-group">
                <label for="confirmpassword">Confirm Password</label>
                <div class="passwordContainer">
                    <input type="password" placeholder="Confirm Password" name="confirmPassword" class="passwordField" id="confirmpassword">
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <i class="fa-solid fa-eye-slash"></i>
                    </span>
                </div>
                <p class="error"><?php echo $errors["confirmPassword"] ?? ''; ?></p>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone No</label>
                <input type="text" id="phone_number" class="inputField" name="phone_number" value="<?php echo htmlspecialchars($_POST['phone_number'] ?? ''); ?>">
                <p class="error"><?php echo $errors['phone_number'] ?? ''; ?></p>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" class="inputField" name="address" value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>">
                <p class="error"><?php echo $errors['address'] ?? ''; ?></p>
            </div>

            <div class="form-group profileContainer">
                <label for="profile" class="profileSelect">Select Profile</label>
                <input type="file" name="profileImg" id="profile">
                <p class="error"><?php echo $errors['profileImg'] ?? ''; ?></p>
            </div>
            <p class="content-p">Already have an account? <span><a href="../index.php">Login</a></span></p>
            <button class="btn" type="submit" name="submitBtn">Sign up</button>

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