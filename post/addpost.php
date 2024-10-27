<?php
require("../Navbar.php");

$db = new Database();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submitBtn'])) {
        // Collect form data
        $title = $_POST['title'];
        $description = $_POST['description'];
        $location = $_POST['location'];
        $category = $_POST['category'];
        $authorId = $_SESSION["loggedinuserId"];
        $currentDateTime = date('Y-m-d H:i:s');

        // Image upload and validation
        $fileName = $row['image']; // Retain existing image if no new image is uploaded

        if (isset($_FILES['itemImage']) && $_FILES['itemImage']['error'] == 0) {
            $fileExtension = pathinfo($_FILES['itemImage']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid() . '.' . $fileExtension;
            $uploadDir = '../uploads/posts/';
            $targetFile = $uploadDir . $fileName;

            if (!move_uploaded_file($_FILES['itemImage']['tmp_name'], $targetFile)) {
                $errors['image'] = "Failed to upload image.";
            }
        }

        // Proceed to database entry if no errors
        if (empty($errors)) {
            $result = $db->insert("posts", [
                'title' => $title,
                'author_id' => $authorId,
                'description' => $description,
                'location' => $location,
                'image' => $fileName,
                'category' => $category,
                'time' => $currentDateTime
            ]);
            if ($result) {
                echo "<script>
                        if (confirm('Post added successfully. Click yes to redirect to ViewPosts.')) {
                            window.location.href = './viewposts.php';
                        }
                      </script>";
                exit();
            } else {
                echo "<p>Error: Unable to insert post. Please check database connection or SQL query.</p>";
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
    <link rel="stylesheet" href="../index.css" />
    <style>
        #item-category {
            width: 250px;
        }

        #section {
            width: 90%;
        }
    </style>
</head>

<body>
    <section class="add-post-section" id="section">
        <h1 class="content-header">Provide Information of the Found Item</h1>
        <form class="form-class" method="post" action="" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="item-title">Item Title</label>
                <input type="text" id="item-title" name="title" value="<?php echo htmlspecialchars($_POST['title'] ?? '', ENT_QUOTES); ?>">
                <p class="error" id="titleError"></p>
            </div>
            <div class="form-group">
                <label for="item-description">Description</label>
                <textarea id="item-description" name="description" rows="4"><?php echo htmlspecialchars($_POST['description'] ?? '', ENT_QUOTES); ?></textarea>
                <p class="error" id="descriptionError"></p>
            </div>
            <div class="form-group">
                <label for="item-location">Location</label>
                <input type="text" id="item-location" name="location" value="<?php echo htmlspecialchars($_POST['location'] ?? '', ENT_QUOTES); ?>">
                <p class="error" id="locationError"></p>
            </div>
            <div class="form-group">
                <label for="profileImg">Item Image</label>
                <div class="file-upload-container">
                    <input type="file" id="itemImage" name="itemImage" style="display: none;" accept="image/*" onchange="previewImage(event)">
                    <button type="button" class="file-btn" onclick="document.getElementById('itemImage').click()">Choose Image</button>
                </div>
                <img class="displayedImg" style="display:none; max-width: 100px; margin-top: 10px;">
                <p class="error" id="itemImageError"><?php echo $errors['image'] ?? ''; ?></p>
            </div>
            <div class="form-group">
                <label for="item-category">Category</label>
                <select id="item-category" name="category">
                    <option selected>---Select Category---</option>
                    <option value="electronics">Electronics</option>
                    <option value="animal">Animal</option>
                    <option value="jwellery">Jwellery</option>
                    <option value="document">Documents</option>
                    <option value="clothing">Clothing</option>
                    <option value="vehicle">Vehicles</option>
                    <option value="other">Other</option>
                </select>
                <p class="error" id="categoryError"></p>
            </div>
            <button type="submit" name="submitBtn" class="btn">Submit</button>
        </form>
    </section>

    <?php require("../components/Footer.php");  ?>

    <script>
        function validateForm() {
            let isValid = true;

            // Clear previous errors
            document.getElementById('titleError').innerText = '';
            document.getElementById('descriptionError').innerText = '';
            document.getElementById('locationError').innerText = '';
            document.getElementById('categoryError').innerText = '';
            document.getElementById('itemImageError').innerText = '';

            // Get values from form fields
            const title = document.getElementById('item-title').value.trim();
            const description = document.getElementById('item-description').value.trim();
            const location = document.getElementById('item-location').value.trim();
            const category = document.getElementById('item-category').value;
            const itemImg = document.getElementById('itemImage').files[0];

            // Title Validation
            if (title.length === 0) {
                document.getElementById('titleError').innerText = "Item title cannot be empty";
                isValid = false;
            }

            // Description Validation
            if (description.length < 10) {
                document.getElementById('descriptionError').innerText = "Description should be at least 10 characters";
                isValid = false;
            }

            // Location Validation
            if (location.length === 0) {
                document.getElementById('locationError').innerText = "Location cannot be empty";
                isValid = false;
            }

            // Category Validation
            if (category === "---Select Category---") {
                document.getElementById('categoryError').innerText = "Please select a category";
                isValid = false;
            }

            // Item Image Validation
            if (!itemImg) {
                document.getElementById('itemImageError').innerText = "Item image is required";
                isValid = false;
            } else {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(itemImg.type)) {
                    document.getElementById('itemImageError').innerText = "Only JPG, PNG, and GIF formats are allowed.";
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