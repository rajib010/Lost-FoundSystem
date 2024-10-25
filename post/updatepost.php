<?php

include_once "../utility/Database.php";
$db = new Database();
$errors = [];

$id = $_GET['id'];
$where = "posts.id = $id";
$result = $db->select("posts", '*', null, $where, null, null);
if ($result->num_rows !== 0) {
    $row = $result->fetch_assoc();
}

// After updates
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['updateBtn'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $location = $_POST['location'];
        $category = $_POST['category'];
        $id = $_GET['id']; //id of the post

        // Validate form
        if (empty($title)) {
            $errors['title'] = "Title is required";
        }
        if (empty($description)) {
            $errors['description'] = "Description is required";
        }
        if (empty($location)) {
            $errors['location'] = "Location is required";
        }
        if (empty($category)) {
            $errors['category'] = "Category is required";
        }

        $fileName = $row['image']; //use current image if no changes
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileType = $_FILES['image']['type'];

            if (!in_array($fileType, $allowedTypes)) {
                $errors['image'] = "Only JPG, PNG, and GIF formats are allowed.";
            } else {
                $fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $fileName = uniqid() . '.' . $fileExtension;
                $uploadDir = '../uploads/posts/';
                $targetFile = $uploadDir . $fileName;

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $errors['image'] = "Failed to upload image.";
                }
            }
        }

        // Proceed to database entry if no errors
        if (empty($errors)) {
            $where = "posts.id = $id";
            $result = $db->update('posts', [
                "title" => $title,
                "description" => $description,
                "location" => $location,
                "category" => $category,
                "image" => $fileName
            ], $where);

            if ($result) {
                header("Location: ./post.php?id=$id");
                exit();
            } else {
                echo "Error during post update";
            }
        }
    }
}
require("../Navbar.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Update your post.">
    <title> Update Post</title>
    <link rel="stylesheet" href="../index.css" />
    <style>
        .form-group {
            width: 80%;
            margin: auto;
            margin-bottom: 20px;
        }
        select{
            width: 20%;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Custom Radio Button Styling */
        .radio-group {
            width: 80%;
            margin: 10px auto;
            display: flex;
            flex-direction: column;
        }

        .radio-group label {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .radio-options {
            display: flex;
            gap: 20px;
        }

        .radio-option {
            position: relative;
            padding-left: 35px;
            cursor: pointer;
            user-select: none;
            font-size: 16px;
        }

        /* Hide the default radio button */
        .radio-option input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .custom-radio {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 20px;
            width: 20px;
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 50%;
            transition: border-color 0.3s, background-color 0.3s;
        }

        .radio-option:hover input~.custom-radio {
            border-color: #007bff;
        }

        .radio-option input:checked~.custom-radio {
            background-color: #007bff;
            border-color: #007bff;
        }

        .custom-radio::after {
            content: "";
            position: absolute;
            display: none;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            height: 10px;
            width: 10px;
            border-radius: 50%;
            background: white;
        }

        .radio-option input:checked~.custom-radio::after {
            display: block;
        }


        .displayedImg {
            max-width: 100px;
            border-radius: 5px;
            object-fit: cover;
        }

        /* Buttons Styling */
        .buttons {
            display: flex;
            justify-content: center;
            gap: 1%;
        }

        /* Responsive Design */
        @media (min-width: 769px) and (max-width: 1050px) {
            select {
                width: 35%;
            }
        }

        @media (max-width: 768px) {
            select {
                width: 50%;
            }

            .displayedImg {
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <section class="updatepost-section">
        <h1 class="content-header">Update Post</h1>
        <form class="form-class" method="post" action="" enctype="multipart/form-data" id="updateForm">
            <div class="form-group">
                <label for="item-title">Item Title</label>
                <input type="text" id="item-title" name="title" value="<?= htmlspecialchars($row['title']) ?>">
                <p class="error"><?= $errors['title'] ?? '' ?></p>
            </div>

            <div class="form-group">
                <label for="item-description">Description</label>
                <textarea id="item-description" name="description" rows="4"><?= htmlspecialchars($row['description']) ?></textarea>
                <p class="error"><?= $errors['description'] ?? '' ?></p>
            </div>

            <div class="form-group">
                <label for="item-location">Location</label>
                <input type="text" id="item-location" name="location" value="<?= htmlspecialchars($row['location']) ?>">
                <p class="error"><?= $errors['location'] ?? '' ?></p>
            </div>

            <div class="form-group">
                <label for="item-category">Category</label>
                <select id="item-category" name="category">
                    <option selected disabled>---Select Category---</option>
                    <option value="electronics" <?= $row['category'] == 'electronics' ? 'selected' : '' ?>>Electronics</option>
                    <option value="animal" <?= $row['category'] == 'animal' ? 'selected' : '' ?>>Animal</option>
                    <option value="jewellery" <?= $row['category'] == 'jewellery' ? 'selected' : '' ?>>Jewellery</option>
                    <option value="document" <?= $row['category'] == 'document' ? 'selected' : '' ?>>Documents</option>
                    <option value="clothing" <?= $row['category'] == 'clothing' ? 'selected' : '' ?>>Clothing</option>
                    <option value="vehicle" <?= $row['category'] == 'vehicle' ? 'selected' : '' ?>>Vehicles</option>
                    <option value="other" <?= $row['category'] == 'other' ? 'selected' : '' ?>>Other</option>
                </select>
                <p class="error"><?= $errors['category'] ?? '' ?></p>
            </div>

            <div class="form-group">
                <div class="file-upload-container">
                    <input type="file" id="image" name="image" style="display: none;" accept="image/*">
                    <button type="button" class="file-btn" onclick="document.getElementById('image').click()">Select Image</button>
                    <?php if (!empty($row['image'])): ?>
                        <img class="displayedImg" src="../uploads/posts/<?php echo htmlspecialchars($row['image']); ?>" alt="Post Image">
                    <?php endif; ?>
                </div>
                <p class="error"><?= $errors['image'] ?? '' ?></p>
            </div>

            <div class="buttons">
                <button type="submit" name="updateBtn" class="btn" id="submitBtn">Update</button>
                <button type="button" class="btn" id="cancelBtn">Cancel</button>
            </div>
        </form>
    </section>

    <?php require("../components/Footer.php");  ?>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            const confirmation = confirm('Are you sure you want to update the post?');
            if (!confirmation) {
                event.preventDefault();
            }
        });

        document.getElementById('cancelBtn').addEventListener('click', () => {
            window.location.href = '../pages/home.php';
        })

        document.getElementById('image').addEventListener('change', function() {
            const displayedImg = this.parentElement.querySelector('.displayedImg');
            if (this.files && this.files.length > 0) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (displayedImg) {
                        displayedImg.src = e.target.result;
                    } else {
                        const img = document.createElement('img');
                        img.classList.add('displayedImg');
                        img.src = e.target.result;
                        img.alt = "Selected Post Image";
                        document.querySelector('.file-upload-container').appendChild(img);
                    }
                };
                reader.readAsDataURL(this.files[0]);
            } else {
                if (displayedImg) {
                    displayedImg.src = '../uploads/posts/<?php echo htmlspecialchars($row['image']); ?>';
                }
            }
        });
    </script>

</body>

</html>

<?php
ob_end_flush();
?>