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

        if (!password_verify($password, $row['password'])) {
            $errors['password'] = 'Incorrect password.';
        }

        if (empty($name) || strlen($name) < 4) {
            $errors['fullName'] = "Please enter a valid name (minimum 4 characters).";
        }

        if (empty($email)) {
            $errors['email'] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format.";
        }

        if (empty($address)) {
            $errors['address'] = "Address is required.";
        }

        if (empty($phone_number)) {
            $errors['phone_number'] = "Phone number is required.";
        } elseif (!preg_match('/^\+?\d{10,15}$/', $phone_number)) {
            $errors['phone_number'] = "Invalid phone number format.";
        }

        // Handle profile image upload
        $fileName = $row['profileImg'];
        if (isset($_FILES['profileImg']) && $_FILES['profileImg']['error'] === 0) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileType = mime_content_type($_FILES['profileImg']['tmp_name']);

            if (!in_array($fileType, $allowedTypes)) {
                $errors['profileImg'] = "Only JPG, PNG, and GIF formats are allowed.";
            } else {
                $fileExtension = pathinfo($_FILES['profileImg']['name'], PATHINFO_EXTENSION);
                $fileName = uniqid('profile_', true) . '.' . $fileExtension;
                $uploadDir = '../uploads/user/';
                $targetFile = $uploadDir . $fileName;

                // Ensure the upload directory exists
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                if (!move_uploaded_file($_FILES['profileImg']['tmp_name'], $targetFile)) {
                    $errors['profileImg'] = "Failed to upload image.";
                } else {
                    // Optionally, delete the old profile image if it's not the default one
                    if (!empty($row['profileImg']) && file_exists($uploadDir . $row['profileImg'])) {
                        unlink($uploadDir . $row['profileImg']);
                    }
                }
            }
        }

        // Proceed to update the database if no errors
        if (empty($errors)) {
            $updateData = [
                "name" => $name,
                "email" => $email,
                "phone_number" => $phone_number,
                "address" => $address,
                "profileImg" => $fileName
            ];

            if (!empty($newPassword)) {
                if (strlen($newPassword) < 6) {
                    $errors['newPassword'] = "New password must be at least 6 characters long.";
                } else {
                    $updateData["password"] = $newPassword;
                }
            }

            if (empty($errors)) {
                $updateResult = $db->update('user_info', $updateData, $where);

                if ($updateResult) {
                    echo "<script>
                        alert('user info updated successfully');
                        window.location.href= './home.php';
                    </script>";
                } else {
                    echo "<script>
                        alert('failed to update user info');
                    </script>";
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
    <link rel="stylesheet" href="../styles/index.css" />
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
        <form action="" class="form-class" method="post" enctype="multipart/form-data" novalidate>
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" class="inputField" name="fullName" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                <p class="error"><?php echo $errors['fullName'] ?? ''; ?></p>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="inputField" name="email" value="<?php echo htmlspecialchars($row['email'] ?? ''); ?>" required>
                <p class="error"><?php echo $errors['email'] ?? ''; ?></p>
            </div>
            <div class="form-group">
                <label for="password">Current Password</label>
                <div class="passwordContainer">
                    <input type="password" placeholder="Enter current password" class="passwordField" name="password" id="password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('password')">
                        <i class="fa-solid fa-eye-slash"></i>
                    </span>
                </div>
                <p class="error"><?php echo $errors['password'] ?? ''; ?></p>
            </div>
            <div class="form-group">
                <label for="newPassword">New Password</label>
                <div class="passwordContainer">
                    <input type="password" placeholder="Enter new password" class="passwordField" name="newPassword" id="newPassword">
                    <span class="toggle-password" onclick="togglePasswordVisibility('newPassword')">
                        <i class="fa-solid fa-eye-slash"></i>
                    </span>
                </div>
                <p class="error"><?php echo $errors['newPassword'] ?? ''; ?></p>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone No</label>
                <input type="text" id="phone_number" class="inputField" name="phone_number" value="<?php echo htmlspecialchars($row['phone_number'] ?? ''); ?>" required>
                <p class="error"><?php echo $errors['phone_number'] ?? ''; ?></p>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" class="inputField" name="address" value="<?php echo htmlspecialchars($row['address'] ?? ''); ?>" required>
                <p class="error"><?php echo $errors['address'] ?? ''; ?></p>
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
                <p class="error"><?php echo $errors['profileImg'] ?? ''; ?></p>
            </div>

            <div class="buttons center">
                <button type="submit" class="btn" name="submitBtn">Update</button>
                <button type="button" class="btn" id="cancelBtn" onclick="navigate()">Cancel</button>
            </div>
        </form>
    </section>
    <?php require("../components/Footer.php") ?>

    <script>
        function navigate() {
            window.location.href = '../pages/home.php';
        }

        document.getElementById('profileImg').addEventListener('change', function() {
            const fileNameSpan = document.getElementById('file-name');
            const displayedImg = this.parentElement.querySelector('.displayedImg');
            if (this.files && this.files.length > 0) {
                const fileName = this.files[0].name;
                fileNameSpan.textContent = fileName;

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
                fileNameSpan.textContent = '';
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
    </script>
</body>

</html>