<?php
require("../Navbar.php");

$db = new Database();
$limit = 12;

// Get the current page or set to 1 if not set
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int) $_GET['page'];
    if ($current_page < 1) {
        $current_page = 1;
    }
} else {
    $current_page = 1;
}

$category_filter = isset($_GET['filterpost']) ? mysqli_real_escape_string($db->conn, $_GET['filterpost']) : null;
$join = "user_info ON posts.author_id = user_info.id";

$where = "posts.status=1";
if ($category_filter && $category_filter != 'time') {
    $where .= " AND posts.category = '$category_filter'";
}


$order = "posts.time DESC";

$count_result = $db->select('posts', "COUNT(*) as total", $join, $where, $order, $limit);
$total_posts = 0;
if ($count_result && $count_result->num_rows > 0) {
    $count_row = $count_result->fetch_assoc();
    $total_posts = $count_row['total'];
}

$total_pages = ceil($total_posts / $limit);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View posts about lost items.">
    <title>View Posts</title>
    <style>
        .header {
            margin: auto;
            max-width: 550px;
        }

        .center {
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

        .post-card>.post-title {
            margin: 10px auto;
        }

        #text {
            display: inline-block;
            padding: 10px 20px;
            font-size: 18px;
            color: #ffffff;
            background-color: #007bff;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            animation: bounce 2s infinite, colorChange 4s infinite;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes colorChange {
            0% {
                background-color: #007bff;
            }

            25% {
                background-color: #28a745;
            }

            50% {
                background-color: #ffc107;
            }

            75% {
                background-color: #dc3545;
            }

            100% {
                background-color: #007bff;
            }
        }

        #text:hover {
            animation: shake 0.5s infinite, colorChange 4s infinite;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            50% {
                transform: translateX(5px);
            }
        }


        @media (max-width: 767px) {
            .filter {
                width: 100%;
                margin: 15px 0px;
            }

            #text {
                padding: 0px;
            }
        }
    </style>
    <link rel="stylesheet" href="../index.css" />
    <script src="../utility/CreatePagination.js"></script>
</head>

<body>
    <main class="main-section">
        <div class="header center">
            <span class="content-p" id="text">
                <a href="addpost.php" id="here">Click here if you have found an item!!!</a>
            </span>
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

            <div id="posts-container" class="post-grid">
                <!-- Posts will be loaded here via AJAX -->
            </div>

            <div id="pagination" class="pagination">
                <!-- Pagination links will be dynamically generated -->
            </div>
        </div>
    </main>

    <?php require("../components/Footer.php"); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to load posts
            async function loadPosts(page = 1) {
                const filterpost = new URLSearchParams(window.location.search).get('filterpost') || 'time';

                // Fetch posts based on the current page and filter
                await fetch(`../utility/LoadmorePosts.php?page=${page}&filterpost=${filterpost}`)
                    .then(response => response.json())
                    .then(data => {
                        const postsContainer = document.getElementById('posts-container');
                        const paginationContainer = document.getElementById('pagination');

                        // Clear existing posts and pagination
                        postsContainer.innerHTML = '';
                        paginationContainer.innerHTML = '';

                        if (data.status === 'success') {
                            // Populate posts
                            data.posts.forEach(post => {
                                const postCard = document.createElement('div');
                                postCard.className = 'post-card';
                                postCard.onclick = () => viewItem(post.id);
                                postCard.title = 'View Post';

                                const postImg = document.createElement('img');
                                postImg.className = 'post-img';
                                postImg.src = `http://localhost/finderz/uploads/posts/${post.image}`;
                                postImg.alt = 'Post Image';

                                const postTitle = document.createElement('p');
                                postTitle.className = 'post-title';
                                postTitle.textContent = post.title;

                                const postAuthor = document.createElement('p');
                                postAuthor.className = 'content-p';
                                postAuthor.textContent = `Found by: ${post.name}`;

                                postCard.appendChild(postImg);
                                postCard.appendChild(postTitle);
                                postCard.appendChild(postAuthor);
                                postsContainer.appendChild(postCard);
                            });

                            // Generate pagination links
                            const totalPages = <?php echo $total_pages; ?>;
                            createPagination(totalPages, page, paginationContainer, loadPosts);
                        } else {
                            postsContainer.innerHTML = `<div class='no-items'><h1 class='content-header'>${data.message}</h1></div>`;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Function to view an individual post
            function viewItem(id) {
                window.location.href = `post.php?id=${id}`;
            }

            // Load initial posts
            const currentPage = new URLSearchParams(window.location.search).get('page') || 1;
            loadPosts(parseInt(currentPage));
        });
    </script>

</body>

</html>