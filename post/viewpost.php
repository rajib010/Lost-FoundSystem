<?php
require("../Navbar.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

$limit = 12;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int) $_GET['page'];
    if ($current_page < 1) {
        $current_page = 1;
    }
} else {
    $current_page = 1;
}

$offset = ($current_page - 1) * $limit;

// Retrieve and sanitize the category filter
$category_filter = isset($_GET['filterpost']) ? mysqli_real_escape_string($db->conn, $_GET['filterpost']) : null;

// Define the JOIN condition
$join = "user_info ON posts.author_id = user_info.id";

// Initialize the WHERE clause
$where = "1=1";
if ($category_filter && $category_filter != 'time') {
    $where .= " AND posts.category = '$category_filter'";
}
$order = "posts.time DESC";
$count_sql = "SELECT COUNT(*) as total FROM posts $join WHERE $where";
$count_result = $db->select('posts', "COUNT(*) as total", $join, $where,null,null);
$total_posts = 0;
if ($count_result && $count_result->num_rows > 0) {
    $count_row = $count_result->fetch_assoc();
    $total_posts = $count_row['total'];
}

$total_pages = ceil($total_posts / $limit);

$result = $db->select('posts', "posts.*, user_info.name", $join, $where, $order, $limit);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- (Head content remains the same) -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn more about our team and mission.">
    <title>ViewPosts</title>
    <style>
        .header {
            margin: auto;
            padding: 10px 30px;
            max-width: 550px;
            background: linear-gradient(90deg, #81b3e8, #99ecff);
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 10px;
        }
        .center{
            justify-content: space-evenly;
        }

        .content {
            text-align: center;
            padding: 20px;
        }

        #text {
            padding: 0px 10px;
            color: white;
        }

        .filter {
            width: 97%;
            height: 3vw;
            display: flex;
            justify-content: right;
            align-items: center;
            margin-bottom: 15px;
        }
        .no-items {
            padding: 15px 30px;
        }
        .notFoundImg {
            width: 100%;
        }

        .post-card>.post-title{
            margin: 10px auto;
        }

        
        
    </style>
    <link rel="stylesheet" href="../index.css" />
</head>

<body>
    <main class="main-section">
        <div class="header center">
            <span class="content-p" id="text">Click here if you have found an item!!!</span>
            <button class="btn"><a href="addpost.php" id="here">Here!</a></button>
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
            if ($result && $result->num_rows > 0) { ?>
                <div id="posts-container" class="post-grid">
                    <?php
                    while ($row = $result->fetch_assoc()) { ?>
                        <div class="post-card" onclick="viewItem(<?php echo htmlspecialchars($row['pid']); ?>)" title='view post'>
                            <img class="post-img" src="<?php echo 'http://localhost/finderz/uploads/posts/' . htmlspecialchars($row['image']); ?>" alt="Post Image">
                            <p class="post-title"><?php echo htmlspecialchars($row['title']); ?></p>
                            <p class="content-p">Found by: <?php echo htmlspecialchars($row['name']); ?></p>
                        </div>
                    <?php } ?>
                </div>

                <?php
                // Generate Pagination Links
                if ($total_pages > 1) {
                    echo '<div class="pagination">';

                    // Previous Link
                    if ($current_page > 1) {
                        echo '<a href="?page=' . ($current_page - 1) . '&filterpost=' . urlencode($category_filter) . '">&laquo; Previous</a>';
                    } else {
                        echo '<span class="disabled">&laquo; Previous</span>';
                    }

                    // Page Number Links
                    // Display a maximum of 7 page links for better UX
                    $max_links = 7;
                    $start_page = max(1, $current_page - floor($max_links / 2));
                    $end_page = min($total_pages, $start_page + $max_links - 1);

                    // Adjust start_page if we're near the end
                    if ($end_page - $start_page + 1 < $max_links) {
                        $start_page = max(1, $end_page - $max_links + 1);
                    }

                    for ($i = $start_page; $i <= $end_page; $i++) {
                        if ($i == $current_page) {
                            echo '<span class="active">' . $i . '</span>';
                        } else {
                            echo '<a href="?page=' . $i . '&filterpost=' . urlencode($category_filter) . '">' . $i . '</a>';
                        }
                    }

                    // Next Link
                    if ($current_page < $total_pages) {
                        echo '<a href="?page=' . ($current_page + 1) . '&filterpost=' . urlencode($category_filter) . '">Next &raquo;</a>';
                    } else {
                        echo '<span class="disabled">Next &raquo;</span>';
                    }

                    echo '</div>';
                }
                ?>

            <?php
            } else {
                echo "<div class='no-items'>
                <h1 class='content-header'> Nothing posted till now.</h1>
                <img class='notFoundImg' src='../public/noFound.jpg' alt='no posts found'>
                </div>";
            }
            ?>
        </div>
    </main>

    <?php require("../components/Footer.php"); ?>

    <script>
        function viewItem(id) {
            window.location.href = `post.php?id=${id}`;
        }
    </script>

</body>

</html>
