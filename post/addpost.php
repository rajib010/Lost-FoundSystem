<?php
require("../Navbar.php");

$db = new Database();

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submitBtn'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $location = $_POST['location'];
        $category = $_POST['category'];
        $authorId = $_SESSION["loggedinuserId"];

        //validate form
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

        if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
            $errors['image'] = "Item image is required or failed to upload";
        } else {
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

        //procced to database entry
        if (empty($errors)) {
            $result = $db->insert("posts", [
                'title' => $title,
                'author_id' => $authorId,
                'description' => $description,
                'location' => $location,
                'image' => $fileName,
                'category' => $category
            ]);
            if ($result) {
                echo "<script>
                        if (confirm('Post added successfully. Click yes to redirect to ViewPosts.')) {
                            window.location.href = './ViewPosts.php';
                        }
                      </script>";
                exit();
            } else {
                echo "Error during post";
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
    <meta name="description" content="Learn more about our team and mission.">
    <title>Add Posts</title>
    <link rel="stylesheet" href="../styles/AddPost.css" />
</head>

<body>
    <?php ?>
    <section class="form-section">
        <h1>Provide Information of the Found Item</h1>
        <form class="found-item-form" method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="item-title">Item Title</label>
                <input type="text" id="item-title" name="title" value="<?php $_POST['title'] ?? ''; ?>">
                <p class="error"><?php $errors['title'] ?? '' ?></p>
            </div>

            <div class="form-group">
                <label for="item-description">Description</label>
                <textarea id="item-description" name="description" rows="4" value="<?php $_POST['description'] ?? ''; ?>"></textarea>
                <p class="error"><?php $errors['description'] ?? '' ?></p>
            </div>

            <div class="form-group">
                <label for="item-location">Location</label>
                <input type="text" id="item-location" name="location" value="<?php $_POST['location'] ?? ''; ?>">
                <p class="error"><?php $errors['location'] ?? '' ?></p>
            </div>

            <div class="form-group">
                <label for="item-image">Item Image</label>
                <input type="file" id="item-image" name="image">
                <p class="error"><?php $errors['image'] ?? '' ?></p>
            </div>

            <div class="form-group">
                <label for="item-category">Category</label>
                <select id="item-category" name="category">
                    <option value="" disabled selected>Select Category</option>
                    <option value="electronics">Electronics</option>
                    <option value="clothing">Clothing</option>
                    <option value="jewelry">Jewelry</option>
                    <option value="documents">Documents</option>
                    <option value="other">Other</option>
                </select>
                <p class="error"><?php $errors['category'] ?? '' ?></p>
            </div>

            <button type="submit" name="submitBtn" class="submit-btn">Submit</button>
        </form>
    </section>

    <?php require("../components/Footer.php");  ?>
</body>

</html>