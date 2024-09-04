<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn more about our team and mission.">
    <title>Add Posts</title>
    <link rel="stylesheet" href="../styles/pages/AddPost.css" />

</head>

<body>
    <?php require("../components/Navbar.php"); ?>
    <section class="form-section">
        <h1>Provide Information of the Found Item</h1>
        <form class="found-item-form">
            <div class="form-group">
                <label for="item-title">Item Title</label>
                <input type="text" id="item-title" name="item-title" placeholder="Enter the item title" required>
            </div>

            <div class="form-group">
                <label for="item-description">Description</label>
                <textarea id="item-description" name="item-description" rows="4" placeholder="Describe the item" required></textarea>
            </div>

            <div class="form-group">
                <label for="item-location">Location</label>
                <input type="text" id="item-location" name="item-location" placeholder="Where did you find the item?" required>
            </div>

            <div class="form-group">
                <label for="item-picture">Item Picture</label>
                <input type="file" id="item-picture" name="item-picture" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="item-category">Category</label>
                <select id="item-category" name="item-category" required>
                    <option value="" disabled selected>Select Category</option>
                    <option value="electronics">Electronics</option>
                    <option value="clothing">Clothing</option>
                    <option value="jewelry">Jewelry</option>
                    <option value="documents">Documents</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </section>

    <?php require("../components/Footer.php");  ?>
</body>

</html>