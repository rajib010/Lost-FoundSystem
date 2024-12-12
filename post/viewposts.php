<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View posts about lost items.">
    <title>View Posts</title>
    <link rel="stylesheet" href="../index.css" />
    <script src="../utility/CreatePagination.js"></script>
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
</head>

<body>
    <?php require_once('../Navbar.php') ?>
    <main class="main-section">
        <div class="header center">
            <span class="content-p" id="text">
                <a href="addpost.php" id="here">Click here if you have found an item!!!</a>
            </span>
        </div>

        <div class="content">
            <div class="filter">
                <select name="filterpost" id="filterpost" class="selectBox">
                    <option value="time">Recently Posted</option>
                    <option value="electronics">Electronics</option>
                    <option value="animal">Animal</option>
                    <option value="jewellery">Jewellery</option>
                    <option value="documents">Documents</option>
                    <option value="clothing">Clothing</option>
                    <option value="vehicle">Vehicles</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div id="posts-container" class="post-grid">
                <!-- posts will be loaded here -->
            </div>

            <div id="pagination" class="pagination">
                <!-- pagination links will be loaded here -->
            </div>
        </div>
    </main>

    <?php require("../components/Footer.php"); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterDropdown = document.getElementById('filterpost');
            const postsContainer = document.getElementById('posts-container');
            const paginationContainer = document.getElementById('pagination');

            // Function to load posts
            async function loadPosts(filter = 'time', page = 1) {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
                const url = `../utility/LoadmorePosts.php?filterpost=${filter}&page=${page}`;
                try {
                    const response = await fetch(url);
                    const data = await response.json();
                    console.log(data);

                    // Clear containers
                    postsContainer.innerHTML = '';
                    paginationContainer.innerHTML = '';

                    if (data.status === 'success') {
                        // Render posts dynamically
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

                        createPagination(data.total_pages, page, paginationContainer, loadPosts, savedFilter);
                    } else {
                        postsContainer.innerHTML = `<div class="no-items"><h1 class='header-content'>${data.message}</h1></div>`;
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            function viewItem(id) {
                window.location.href = `post.php?id=${id}`;
            }

            filterDropdown.addEventListener('change', () => {
                const selectedFilter = filterDropdown.value;
                localStorage.setItem('selectedFilter', selectedFilter);
                loadPosts(selectedFilter, 1);
            });

            // Initial load
            const savedFilter = localStorage.getItem('selectedFilter');
            const initialFilter = savedFilter ? savedFilter : 'time';
            filterDropdown.value = initialFilter;
            const initialPage = 1;
            loadPosts(initialFilter, initialPage);
        });
    </script>
</body>

</html>