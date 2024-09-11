<?php

include_once "../utility/Database.php";
$db = new Database();
$errors = [];

// Fetch the current post data
$id = $_GET['id'];
$where = "posts.id = $id";
$result = $db->select("posts", '*', null, $where, null, null);
if ($result->num_rows !== 0) {
    $row = $result->fetch_assoc();
}

//after updates
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
            $where = "id = $id";
            $result = $db->update('posts', [
                "title" => $title,
                "description" => $description,
                "location" => $location,
                "category" => $category,
                "image" => $fileName,
            ], $where);

            if ($result) {
                header('Location: ../pages/home.php');
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
    <link rel="stylesheet" href="../styles/AddPost.css" />
</head>

<body>
    <section class="form-section">
        <h1>Update Post</h1>

        <form class="found-item-form" method="post" action="" enctype="multipart/form-data" id="updateForm">
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
                <label for="item-image">Item Image</label>
                <input type="file" id="item-image" name="image" style="display: none;">
                <button type="button" class="file-btn" onclick="document.getElementById('item-image').click()">Choose File</button>
                <span id="file-name"><?= !empty($row['image']) ? htmlspecialchars($row['image']) : 'No file selected' ?></span>
                <p class="error"><?= $errors['image'] ?? '' ?></p>

                <?php if (!empty($row['image'])): ?>
                    <img class="displayedImg" src="../uploads/posts/<?= htmlspecialchars($row['image']) ?>" alt="Item Image" style="max-width: 100px;">
                <?php endif; ?>
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

            <button type="submit" name="updateBtn" class="submit-btn" id="submitBtn">Update</button>
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

        document.getElementById('item-image').addEventListener('change', function() {
            var fileName = this.files[0].name;
            document.getElementById('file-name').textContent = fileName;
        });
    </script>

</body>

</html>

<?php
ob_end_flush();

?>