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
                <select name="filterpost" class="selectBox" onchange="this.form.submit()">
                    <option value="time" <?php echo (isset($_GET['filterpost']) && $_GET['filterpost'] == 'time') ? 'selected' : ''; ?>>Recently Posted</option>
                    <option value="electronics" <?php echo (isset($_GET['filterpost']) && $_GET['filterpost'] == 'electronics') ? 'selected' : ''; ?>>Electronics</option>
                    <option value="animal" <?php echo (isset($_GET['filterpost']) && $_GET['filterpost'] == 'animal') ? 'selected' : ''; ?>>Animal</option>
                    <option value="jewellery" <?php echo (isset($_GET['filterpost']) && $_GET['filterpost'] == 'jewellery') ? 'selected' : ''; ?>>Jewellery</option>
                    <option value="documents" <?php echo (isset($_GET['filterpost']) && $_GET['filterpost'] == 'documents') ? 'selected' : ''; ?>>Documents</option>
                    <option value="clothing" <?php echo (isset($_GET['filterpost']) && $_GET['filterpost'] == 'clothing') ? 'selected' : ''; ?>>Clothing</option>
                    <option value="vehicle" <?php echo (isset($_GET['filterpost']) && $_GET['filterpost'] == 'vehicle') ? 'selected' : ''; ?>>Vehicles</option>
                    <option value="other" <?php echo (isset($_GET['filterpost']) && $_GET['filterpost'] == 'other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </form>
        </div>

        <?php
        $category_filter = isset($_GET['filterpost']) ? $_GET['filterpost'] : null;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 8;
        $join = "user_info ON posts.author_id = user_info.id";
        $where = "posts.status = 0";

        if ($category_filter && $category_filter != 'time') {
            $where .= " AND posts.category = '$category_filter'";
        }

        $order = "posts.time DESC";

        $result = $db->select('posts', "posts.*, user_info.name", $join, $where, $order, $limit);

        if ($result->num_rows == 0) {
            echo "<div class='no-items'>
                <h1> Nothing posted till now.</h1>
                <img class='notFoundImg' src='../public/noFound.jpg' alt='no posts found'>
                </div>";
        } else { ?>
            <div id="posts-container" class="post-grid">
                <?php
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="post-item" onclick="viewItem(<?php echo $row['id'] ?>)" title='view post'>
                        <img class="img-item" src="<?php echo 'http://localhost/finderz/uploads/posts/' . htmlspecialchars($row['image']); ?>" alt="Post Image">
                        <p class="post-title"><?php echo htmlspecialchars($row['title']); ?></p>
                        <p class="finder-name">Found by: <?php echo htmlspecialchars($row['name']); ?></p>
                    </div>
                <?php } ?>
            </div>
        <?php
            if ($result->num_rows >= $limit) {
                echo '<div class="footer">
                        <button class="more-btn" onclick="loadMore()">More +</button>
                      </div>';
            }
        } ?>
    </div>

    <?php require("../components/Footer.php"); ?>

    <script>
        let limit = <?php echo $limit; ?>;

        function loadMore() {
            limit += 8; // Increase the limit by 8 (or any number you prefer)
            const filter = "<?php echo $category_filter; ?>";
            
            // AJAX request to fetch more posts
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `ViewPosts.php?limit=${limit}&filterpost=${filter}`, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onload = function () {
                if (this.status === 200) {
                    // Append the new posts to the existing content
                    const newPosts = document.createElement('div');
                    newPosts.innerHTML = this.responseText;
                    document.querySelector('#posts-container').append(...newPosts.querySelectorAll('.post-item'));
                    
                    // Focus on the newly added posts
                    const newlyAddedPost = document.querySelectorAll('.post-item')[limit - 8];
                    newlyAddedPost.scrollIntoView({ behavior: 'smooth' });
                }
            };
            xhr.send();
        }

        function viewItem(id) {
            window.location.href = `post.php?id=${id}`;
        }
    </script>
</body>

</html>
