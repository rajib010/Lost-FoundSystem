<?php
require("../Navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn more about our team and mission.">
    <title>ViewPosts</title>
    <link rel="stylesheet" href="../styles/ViewPost.css" />
</head>

<body>

    <div class="header">
        <div class="found-item">
            <span>Click here if you have found an item!!!</span>
            <button class="here-btn"><a href="addpost.php" id="here">Here!</a></button>
        </div>
    </div>

    <div class="content">
        <div class="filter">
            <form action="" method="GET">
                <label>Filter items by:</label>
                <select name="filterpost" onchange="this.form.submit()">
                    <option selected disabled>---Select Category---</option>
                    <option value="electronics">Electronics</option>
                    <option value="animal">Animal</option>
                    <option value="jewellery">Jewellery</option>
                    <option value="documents">Documents</option>
                    <option value="clothing">Clothing</option>
                    <option value="vehicle">Vehicles</option>
                    <option value="other">Other</option>
                </select>
            </form>
        </div>
        <h2>Recently Posted...</h2>

        <div class="post-grid">
            <?php 
            
            $category_filter = isset($_GET['filterpost']) ? $_GET['filterpost'] : null;
            $join = "user_info ON posts.author_id = user_info.id";
            $where = $category_filter ? "posts.category = '$category_filter'" : null;
            
            $result = $db->select('posts', "*", $join, $where, "posts.time DESC", 10);
            
            if($result->num_rows == 0){
                echo "<div>No items posted till now</div>";
            } else {
                while($row = $result->fetch_assoc()) { ?>
                    <div class="post-item">
                        <img class="img-item" src="<?php echo 'http://localhost/finderz/uploads/posts/'. $row['image']; ?>" alt="Post Image">
                        <p class="post-title"><?php echo $row['title']; ?></p>
                        <p class="finder-name">Found by: <?php echo $row['name']; ?></p>
                    </div>
                <?php }
            } ?>
        </div>
    </div>

    <div class="footer">
        <button class="more-btn">More +</button>
    </div>

    <?php require("../components/Footer.php"); ?>

    <script>
        function navigatePost(e, i) {
            e.preventDefault();
        }
    </script>
</body>
</html>
