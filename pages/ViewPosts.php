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
    <?php  require("../components/Navbar.php"); ?>


    <div class="header">
        <div class="found-item">
            <span>Click here if you have found an item!!!</span>
            <button class="here-btn"><a href="./AddPost.php">Here!</a></button>
        </div>
    </div>

    <div class="content">
        <h2>Recently Posted...</h2>
        <div class="post-grid">
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
</body>

</html>