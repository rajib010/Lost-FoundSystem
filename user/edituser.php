<?php

include_once "../utility/Database.php";
require("../Navbar.php");
$db = new Database();
$errors = [];

if (!isset($_SESSION['loggedinuserId'])) {
    header('Location: ../login.php');
    exit();
}

$id = $_SESSION['loggedinuserId'];
$where = "id='$id'";

$result = $db->select("user_info", '*', null, $where, null, null);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['submitBtn'])) {
        $name = trim($_POST['fullName']);
        $password = $_POST['password'];
        $newPassword = $_POST['newPassword'];
        $phone_number = trim($_POST['phone_number']);
        $email = trim($_POST['email']);
        $address = trim($_POST['address']);
        $profileImg = $_FILES['profileImg'] ?? null;

        // verify the password
        if (!password_verify($password, $row['password'])) {
            $errors['password'] = 'Incorrect password.';
        } else {
            $updateData = [];

            // Only add fields to the update array if they've changed
            if ($name !== $row['name']) $updateData['name'] = $name;
            if ($email !== $row['email']) $updateData['email'] = $email;
            if ($phone_number !== $row['phone_number']) $updateData['phone_number'] = $phone_number;
            if ($address !== $row['address']) $updateData['address'] = $address;

            // Handle profile image upload if a new one is provided
            if ($profileImg && $profileImg['size'] > 0) {
                $fileName = uniqid() . '_' . basename($profileImg['name']);
                $targetPath = "../uploads/user/" . $fileName;

                if (move_uploaded_file($profileImg['tmp_name'], $targetPath)) {
                    $updateData['profileImg'] = $fileName;
                } else {
                    $errors['profileImg'] = 'Failed to upload image.';
                }
            }

            if (!empty($newPassword)) {
                if (strlen($newPassword) < 6) {
                    $errors['newPassword'] = 'New password must be at least 6 characters long.';
                } else {
                    $updateData['password'] = $newPassword;
                }
            }

            if (empty($errors) && !empty($updateData)) {
                $updateResult = $db->update('user_info', $updateData, $where);

                if ($updateResult) {
                    echo "<script>
                        window.location.href= '../pages/home.php';
                    </script>";
                } else {
                    echo "<script>alert('Failed to update user info');</script>";
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
    <title>Edit Profile</title>
    <link rel="stylesheet" href="./index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        #section {
            overflow-y: auto;
            width: 80%;
            padding: 2vw 5vw;
        }

        .edituser-section form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .edituser-section .form-group {
            width: 100%;
        }

        .error {
            margin-top: 5px;
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

        .edituser-section .buttons {
            grid-column: 1 / -1;
            display: flex;
            gap: 10px;
        }

        .displayedImg {
            margin-left: 20px;
            max-width: 100px;
            border-radius: 5px;
            object-fit: cover;
        }

        .note {
            font-style: italic;
            font: small;
        }

        @media (max-width: 767px) {
            .edituser-section form {
                grid-template-columns: 1fr;
            }

            .displayedImg {
                margin-left: 0;
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <section class="edituser-section" id="section">
        <h1 class="content-header">Update Your Profile</h1>
        <form action="" class="form-class" method="post" enctype="multipart/form-data" novalidate onsubmit="return validateForm()">
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" class="inputField" name="fullName" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                <p class="error" id="fullNameError"></p>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="inputField" name="email" value="<?php echo htmlspecialchars($row['email'] ?? ''); ?>" required>
                <p class="error" id="emailError"></p>
            </div>
            <div class="form-group">
                <label for="password">Current Password</label>
                <div class="passwordContainer">
                    <input type="password" placeholder="Enter current password" class="passwordField" name="password" id="password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('password')">
                        <i class="fa-solid fa-eye-slash"></i>
                    </span>
                </div>
                <p class="error" id="passwordError"><?php echo $errors['password'] ?? ''; ?></p>
                <p class="note">(Enter your password to confirm change.)</p>
            </div>

            <div class="form-group">
                <label for="newPassword">New Password</label>
                <div class="passwordContainer">
                    <input type="password" placeholder="Enter new password" class="passwordField" name="newPassword" id="newPassword">
                    <span class="toggle-password" onclick="togglePasswordVisibility('newPassword')">
                        <i class="fa-solid fa-eye-slash"></i>
                    </span>
                </div>
                <p class="error" id="newPasswordError"></p>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone No</label>
                <input type="text" id="phone_number" class="inputField" name="phone_number" value="<?php echo htmlspecialchars($row['phone_number'] ?? ''); ?>" required>
                <p class="error" id="phoneError"></p>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" class="inputField" name="address" value="<?php echo htmlspecialchars($row['address'] ?? ''); ?>" required>
                <p class="error" id="addressError"></p>
            </div>

            <div class="form-group">
                <label for="profileImg">Profile Image</label>
                <div class="file-upload-container">
                    <input type="file" id="profileImg" name="profileImg" style="display: none;" accept="image/*">
                    <button type="button" class="file-btn" onclick="document.getElementById('profileImg').click()">Choose Image</button>
                    <?php if (!empty($row['profileImg'])): ?>
                        <img class="displayedImg" src="../uploads/user/<?php echo htmlspecialchars($row['profileImg']); ?>" alt="Profile Image">
                    <?php endif; ?>
                </div>
                <p class="error" id="profileImgError"></p>
            </div>

            <div class="buttons center">
                <button type="submit" class="btn" name="submitBtn">Update</button>
                <button type="button" class="btn" id="cancelBtn" onclick="navigate()">Cancel</button>
            </div>
        </form>
    </section>
    <?php require("../components/Footer.php") ?>

    <script>
        function validateForm() {
            let isValid = true;

            // clear prev
            document.getElementById('fullNameError').innerText = '';
            document.getElementById('emailError').innerText = '';
            document.getElementById('passwordError').innerText = '';
            document.getElementById('newPasswordError').innerText = '';
            document.getElementById('phoneError').innerText = '';
            document.getElementById('addressError').innerText = '';
            document.getElementById('profileImgError').innerText = '';

            // name Validation
            const fullName = document.getElementById('fullName').value.trim();
            if (!fullName || fullName.length < 4) {
                document.getElementById('fullNameError').innerText = "Please enter a valid name (minimum 4 characters).";
                isValid = false;
            }

            // Email Validation
            const email = document.getElementById('email').value.trim();
            if (!email) {
                document.getElementById('emailError').innerText = "Email is required.";
                isValid = false;
            } else if (!validateEmail(email)) {
                document.getElementById('emailError').innerText = "Invalid email format.";
                isValid = false;
            }

            // Phone Number Validation
            const phoneNumber = document.getElementById('phone_number').value.trim();
            const phoneRegex = /^\+?\d{10,15}$/;
            if (!phoneNumber) {
                document.getElementById('phoneError').innerText = "Phone number is required.";
                isValid = false;
            } else if (!phoneRegex.test(phoneNumber)) {
                document.getElementById('phoneError').innerText = "Invalid phone number format.";
                isValid = false;
            }

            // Address Validation
            const address = document.getElementById('address').value.trim();
            if (!address) {
                document.getElementById('addressError').innerText = "Address is required.";
                isValid = false;
            }

            //check if password field is empty
            const password = document.getElementById('password').value;
            if (password.length == 0) {
                document.getElementById('passwordError').innerText = 'Enter password to confirm change.';
                isValid=false;
            }

            // New Password Validation
            const newPassword = document.getElementById('newPassword').value;
            if (newPassword && newPassword.length < 6) {
                document.getElementById('newPasswordError').innerText = "New password must be at least 6 characters long.";
                isValid = false;
            }

            // Profile Image Validation
            const profileImg = document.getElementById('profileImg');
            if (profileImg.files.length > 0) {
                const fileType = profileImg.files[0].type;
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(fileType)) {
                    document.getElementById('profileImgError').innerText = "Only JPG, PNG, and GIF formats are allowed.";
                    isValid = false;
                }
            }

            return isValid;
        }

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        document.getElementById('profileImg').addEventListener('change', function() {
            const displayedImg = document.querySelector('.displayedImg');

            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {

                    if (displayedImg) {
                        displayedImg.src = e.target.result;
                    } else {

                        const img = document.createElement('img');
                        img.classList.add('displayedImg');
                        img.src = e.target.result;
                        img.alt = "Selected Profile Image";
                        img.style.maxWidth = "100px";
                        img.style.borderRadius = "5px";
                        img.style.objectFit = "cover";
                        document.querySelector('.file-upload-container').appendChild(img);
                    }
                };

                reader.readAsDataURL(this.files[0]);
            } else {
                if (displayedImg) {
                    displayedImg.src = '../uploads/user/<?php echo htmlspecialchars($row['profileImg']); ?>';
                }
            }
        });

        function togglePasswordVisibility(fieldId) {
            var field = document.getElementById(fieldId);
            var icon = field.nextElementSibling.firstElementChild;
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                field.type = "password";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }

        document.getElementById('cancelBtn').addEventListener('click', () => {
            return window.location.href = 'viewprofile.php';
        })
    </script>

</body>

</html>