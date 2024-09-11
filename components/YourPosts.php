<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .posts-section {
            padding: 40px 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            margin: 40px auto;
            max-width: 1200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .posts-section>h1 {
            font-size: 2.5vw;
            color: #ff5722;
            margin-bottom: 30px;
        }

        .all-posts {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }

        .single-post {
            width: calc(25% - 20px);
            background-color: rgb(215 211 211 / 50%);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: left;
        }

        .post-img {
            display: flex;
            justify-content: center;
            border-radius: 10px;
        }

        .post-img img {
            width: 250px;
            height: 200px;
            padding: 2vw 1vw 1vw 1vw ;
            border-radius: 10px;
        }

        .post-desc {
            padding: 15px;
        }

        .post-desc>h3 {
            font-size: 1.2vw;
            color: #333;
            margin-bottom: 10px;
        }

        .post-desc>p,
        .post-desc>h3 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Number of lines to show */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .post-desc>p {
            font-size: 1vw;
            color: #555;
        }

        .edit-posts {
            width: 90%;
            margin: 0.5vw auto;
            display: flex;
            gap: 1vw;
            justify-content: right;
        }

        .edit-posts>p>i {
            cursor: pointer;
        }

        .btndiv {
            margin-top: 30px;
        }

        .viewMoreBtn {
            background-color: #ff5722;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
        }

        .viewMoreBtn:hover {
            background-color: #e64a19;
        }

        .viewMoreBtn a {
            color: white;
            text-decoration: none;
        }


        @media (min-width:768px) and (max-width:1024px) {

            .posts-section h1 {
                font-size: 2.2em;
            }

            .post-desc>h3 {
                font-size: 2.5vw;
            }
            .post-img img{
                padding: 3vw 3vw 3vw 3vw ;
                border-radius: 10px;
            }

            .post-desc>p {
                font-size: 2vw;
            }

            .single-post {
                width: calc(33.33% - 20px);
            }
        }

        @media (max-width: 767px) {

            .posts-section>h1 {
                font-size: 5vw;
            }

            .post-desc>h3 {
                font-size: 3vw;
            }

            .post-desc>p {
                font-size: 2.6vw;
            }

            .edit-posts {
                gap: 3vw;
            }

            .single-post {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <section class="posts-section">

        <script>
            function viewPost(postId) {
                window.location.href = `../post/post.php?id=${postId}`;
            }

            function editPost(postId) {
                window.location.href = `../post/updatepost.php?id=${postId}`;
            }

            function deletePost(postId) {
                if (confirm('Are you sure you want to delete this post?')) {
                    window.location.href = `../post/deletepost.php?id=${postId}`;
                }
            }
        </script>
        <h1>Your Posts</h1>
        <div class="all-posts">
            <?php
            $id = $_SESSION['loggedinuserId'];
            $where = "author_id = '$id'";
            $result = $db->select("posts", "*", null, $where, null, null);
            if ($result->num_rows == 0) {
                echo "<div>You haven't posted anything. <a href='../post/addpost.php'>Tap here to create a new post.</a></div>";
            } else {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="single-post" onclick="viewPost(<?php echo $row['id']; ?>)">
                        <div class="post-img">
                            <img class="image" src="<?php echo 'http://localhost/finderz/uploads/posts/' . htmlspecialchars($row['image']); ?>" alt="image">
                        </div>
                        <div class="edit-posts">
                            <p class="edit" onclick="event.stopPropagation(); editPost(<?php echo $row['id']; ?>)"><i class="fa-solid fa-pen"></i></p>
                            <p class="delete" onclick="event.stopPropagation(); deletePost(<?php echo $row['id']; ?>)"><i class="fa-solid fa-trash"></i></p>
                        </div>
                        <div class="post-desc">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p><?php echo htmlspecialchars($row['description']); ?></p>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </section>
</body>

</html>
