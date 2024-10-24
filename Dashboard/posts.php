<?php
require("components/Header.php");
require("components/Nav.php");
require("../utility/navigate.php");

$db = new Database();
$limit = 8;

// Get the current page or set to 1 if not set
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int) $_GET['page'];
    if ($current_page < 1) {
        $current_page = 1;
    }
} else {
    $current_page = 1;
}

$total_posts = 0;
$count_result = $db->select('posts', "COUNT(*) as total", null, null, null);
if ($count_result && $count_result->num_rows > 0) {
    $count_row = $count_result->fetch_assoc();
    $total_posts = $count_row['total'];
}
$total_pages = ceil($total_posts / $limit);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Posts</title>
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <main class="admin-dashboard">
        <div class="container">
            <h1 class="content-header admin-title">Manage Posts</h1>
            <table>
                <thead>
                    <tr>
                        <th>Sn</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="posts-container">
                    <!-- Posts data will be loaded here dynamically -->
                </tbody>
            </table>
            <div id="pagination" class="pagination"></div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                async function loadPosts(page = 1) {
                    await fetch(`api/GetPosts.php?page=${page}`)
                        .then(response => response.json())
                        .then(data => {
                            const postsContainer = document.getElementById('posts-container');
                            const paginationContainer = document.getElementById('pagination');
                           console.log(data);
                            postsContainer.innerHTML = '';
                            paginationContainer.innerHTML = '';

                            if (data.status === 'success') {
                                data.posts.forEach((post, index) => {
                                    const postRow = document.createElement('tr');
                                    //image to be loaded
                                    postRow.innerHTML = `
                                    <td>${(page - 1) * 12 + (index + 1)}</td>
                                    <td>${post.name}</td>
                                    <td>${post.title}</td>
                                    <td>${post.description}</td>
                                    <td>${post.location}</td>
                                    <td>${post.category}</td>
                                    <td>${post.category==1?'Lost':'Found'}</td>
                                    <td>
                                        <button class="delete-btn" onclick="navigate(${post.id}, 'posts')">Delete</button>
                                        <button class="edit-btn">Edit</button>
                                    </td>
                                `;
                                    postsContainer.appendChild(postRow);
                                });

                                // Generate pagination links

                                const totalPages = <?php echo $total_pages; ?>;
                                console.log(totalPages);

                                for (let i = 1; i <= totalPages; i++) {
                                    const pageLink = document.createElement('a');
                                    pageLink.href = '#';
                                    pageLink.textContent = i;

                                    if (i === page) {
                                        pageLink.classList.add('active');
                                    }

                                    pageLink.onclick = (e) => {
                                        e.preventDefault();
                                        loadPosts(i);
                                    };

                                    paginationContainer.appendChild(pageLink);
                                }
                            } else {
                                postsContainer.innerHTML = `<tr><td colspan='9'>${data.message}</td></tr>`;
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Load initial posts
                const currentPage = new URLSearchParams(window.location.search).get('page') || 1;
                loadPosts(parseInt(currentPage));
            });
        </script>
</body>

</html>