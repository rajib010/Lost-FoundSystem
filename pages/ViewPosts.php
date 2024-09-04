<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn more about our team and mission.">
    <title>ViewPosts</title>
    <link rel="stylesheet" href="../styles/pages/ViewPost.css" />

</head>

<body>
    <?php require("../components/Navbar.php"); ?>


    <div class="header">
        <div class="found-item">
            <span>Click here if you have found an item!!!</span>
            <button class="here-btn"><a href="./AddPost.php" id="here">Here!</a></button>
        </div>
    </div>

    <div class="content">
        <div class="filter">
            <form action="" method="">
                <label>Filter items by:</label>
                <select name="filterpost">
                    <option selected disabled>---Select Category---</option>
                    <option value="electronics">Electronics</option>
                    <option value="animal">Animal</option>
                    <option value="jwellery">Jwellery</option>
                    <option value="documents">Documents</option>
                    <option value="clothing">Clothing</option>
                    <option value="other">Other</option>
                </select>
            </form>
        </div>
        <h2>Recently Posted...</h2>

        <div class="post-grid" onclick="">
            <div class="post-item">
                <img src="https://via.placeholder.com/150" alt="Post Image">
                <p class="post-title">Title of the post</p>
                <p class="finder-name">Finder name</p>
            </div>
            <div class="post-item">
                <img src="https://via.placeholder.com/150" alt="Post Image">
                <p class="post-title">Title of the post</p>
                <p class="finder-name">Finder name</p>
            </div>
            <div class="post-item">
                <img src="https://via.placeholder.com/150" alt="Post Image">
                <p class="post-title">Title of the post</p>
                <p class="finder-name">Finder name</p>
            </div>
            <div class="post-item">
                <img src="https://via.placeholder.com/150" alt="Post Image">
                <p class="post-title">Title of the post</p>
                <p class="finder-name">Finder name</p>
            </div>
            <div class="post-item">
                <img src="https://via.placeholder.com/150" alt="Post Image">
                <p class="post-title">Title of the post</p>
                <p class="finder-name">Finder name</p>
            </div>
            <div class="post-item">
                <img src="https://via.placeholder.com/150" alt="Post Image">
                <p class="post-title">Title of the post</p>
                <p class="finder-name">Finder name</p>
            </div>
            <div class="post-item">
                <img src="https://via.placeholder.com/150" alt="Post Image">
                <p class="post-title">Title of the post</p>
                <p class="finder-name">Finder name</p>
            </div>
            <div class="post-item">
                <img src="https://via.placeholder.com/150" alt="Post Image">
                <p class="post-title">Title of the post</p>
                <p class="finder-name">Finder name</p>
            </div>
            <div class="post-item">
                <img src="https://via.placeholder.com/150" alt="Post Image">
                <p class="post-title">Title of the post</p>
                <p class="finder-name">Finder name</p>
            </div>
        </div>
    </div>

    <div class="footer">
        <button class="more-btn">More +</button>
    </div>


    <?php require("../components/Footer.php");  ?>

    <script>
        function navigatePost(e, i) {
            e.preventDefault();
        }
    </script>
</body>

</html>