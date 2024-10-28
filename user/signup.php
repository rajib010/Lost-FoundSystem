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

        // Check if passwords match
        if ($password !== $confirmPassword) {
            $errors['confirmPassword'] = 'Passwords do not match';
        }

        // Check if email or phone already exists in the database
        $where1 = "email='$email'";
        $where2 = "phone_number='$phoneNumber'";
        $res1 = $db->select('user_info', "name", null, $where1, null, null);
        if ($res1 && $res1->num_rows > 0) {
            $errors['email'] = 'User already registered with this email';
        }
        $res2 = $db->select('user_info', "name", null, $where2, null, null);
        if ($res2 && $res2->num_rows > 0) {
            $errors['phone_number'] = 'Phone number already used';
        }

        // Handle image upload
        if (!isset($_FILES['profileImg']) || $_FILES['profileImg']['error'] !== UPLOAD_ERR_OK) {
            $errors['profileImg'] = "Profile image is required or failed to upload.";
        } else {
            //unique filename
            $fileExtension = pathinfo($_FILES['profileImg']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid() . '.' . $fileExtension;
            $uploadDir = '../uploads/user/';
            $targetFile = $uploadDir . $fileName;

            if (!move_uploaded_file($_FILES['profileImg']['tmp_name'], $targetFile)) {
                $errors['profileImg'] = "Failed to upload image.";
            }
        }

        // If no errors, proceed with the signup process
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
                            window.location.href = './login.php';
                        }
                      </script>";
                exit();
            } else {
                echo "<script>
                        alert('Error during signup');
                      </script>";
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
    <link rel="stylesheet" href="../index.css">
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
        <form action="" method="post" enctype="multipart/form-data" class="form-class" onsubmit="return validateForm()">

            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" class="inputField" name="fullName" value="<?php echo htmlspecialchars($_POST['fullName'] ?? ''); ?>">
                <p class="error" id="nameError"></p>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="inputField" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                <p class="error" id="emailError"><?php echo $errors['email'] ?? ''; ?></p>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="passwordContainer">
                    <input type="password" placeholder="Enter password" class="passwordField" name="password" id="password">
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <i class="fa-solid fa-eye-slash"></i>
                    </span>
                </div>
                <p class="error" id="passwordError"></p>
            </div>

            <div class="form-group">
                <label for="confirmpassword">Confirm Password</label>
                <div class="passwordContainer">
                    <input type="password" placeholder="Confirm Password" name="confirmPassword" class="passwordField" id="confirmpassword">
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <i class="fa-solid fa-eye-slash"></i>
                    </span>
                </div>
                <p class="error" id="confirmPasswordError"></p>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone No</label>
                <input type="text" id="phone_number" class="inputField" name="phone_number" value="<?php echo htmlspecialchars($_POST['phone_number'] ?? ''); ?>">
                <p class="error" id="phone_numberError"><?php echo $errors['phone_number'] ?? ''; ?></p>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" class="inputField" name="address" value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>">
                <p class="error" id="addressError"></p>
            </div>

            <div class="form-group">
                <label for="profileImg">Profile Image</label>
                <div class="file-upload-container">
                    <input type="file" id="profileImg" name="profileImg" style="display: none;" accept="image/*" onchange="previewImage(event)">
                    <button type="button" class="file-btn" onclick="document.getElementById('profileImg').click()">Choose Image</button>
                </div>
                <img class="displayedImg" style="display:none; max-width: 100px; margin-top: 10px;">
                <p class="error" id="profileImgError"></p>
            </div>


            <p class="content-p">Already have an account? <span><a href="./login.php">Login</a></span></p>
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

        function validateForm() {
            let isValid = true;

            // Clear previous errors
            document.getElementById('nameError').innerText = '';
            document.getElementById('emailError').innerText = '';
            document.getElementById('passwordError').innerText = '';
            document.getElementById('confirmPasswordError').innerText = '';
            document.getElementById('phone_numberError').innerText = '';
            document.getElementById('addressError').innerText = '';
            document.getElementById('profileImgError').innerText = '';

            // Get values
            const fullName = document.getElementById('fullName').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmpassword').value;
            const phone = document.getElementById('phone_number').value;
            const address = document.getElementById('address').value;
            const profileImg = document.getElementById('profileImg').files[0];

            // Full Name Validation
            if (fullName.length === 0) {
                document.getElementById('nameError').innerText = "Full name cannot be empty";
                isValid = false;
            }

            // Email Validation
            const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!emailPattern.test(email)) {
                document.getElementById('emailError').innerText = "Invalid email address";
                isValid = false;
            }

            // Password Validation
            if (password.length < 6) {
                document.getElementById('passwordError').innerText = "Password must be at least 6 characters";
                isValid = false;
            } else if (password !== confirmPassword) {
                document.getElementById('confirmPasswordError').innerText = "Passwords do not match";
                isValid = false;
            }

            // Phone Number Validation
            const phonePattern = /^\d{10}$/;
            if (!phonePattern.test(phone)) {
                document.getElementById('phone_numberError').innerText = "Invalid phone number";
                isValid = false;
            }

            // Address Validation
            if (address.length === 0) {
                document.getElementById('addressError').innerText = "Address field cannot be empty";
                isValid = false;
            }

            // Profile Image Validation
            if (!profileImg) {
                document.getElementById('profileImgError').innerText = "Profile image is required";
                isValid = false;
            } else {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(profileImg.type)) {
                    document.getElementById('profileImgError').innerText = "Only JPG, PNG, and GIF formats are allowed.";
                    isValid = false;
                }
            }

            return isValid;
        }


        function previewImage(event) {
            const image = document.querySelector('.displayedImg');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    image.src = e.target.result;
                    image.style.display = 'block'; // Display the image
                };
                reader.readAsDataURL(file);
            } else {
                image.style.display = 'none';
            }
        }
    </script>
</body>

</html>