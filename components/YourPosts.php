<?php require_once('../utility/CheckSession.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../index.css">
    <style>
        .content-p {
            margin-top: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Number of lines to show */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            font-style: normal;
        }

        .edit-posts {
            width: 97%;
            margin: 10px 0 10px 0;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 0 1vw;
        }

        .edit-posts p {
            margin: 0;
            line-height: 1;
        }


        .edit,
        .delete {
            cursor: pointer;
            border-radius: 5px;
            padding: 8px;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .edit i,
        .delete i {
            color: #ffff;
            font-size: 1.2rem;
        }

        .edit {
            background: linear-gradient(90deg, #3a7bd5, #00d2ff);
        }

        .edit:hover {
            background: linear-gradient(90deg, #245c8e, #276d7f);

        }

        .delete:hover {
            background: linear-gradient(90deg, #8e2424, #7f2727);

        }

        .delete {
            background: linear-gradient(90deg, #d53a3a, #ff7b7b);
        }

        .edit:hover,
        .delete:hover {
            background-color: rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <section class="posts-section">
        <h1 class="content-header">Your Posts</h1>
        <div class="post-grid">
            <?php
            $id = $_SESSION['loggedinuserId'];
            $where = "author_id = '$id'";
            $result = $db->select("posts", "*", null, $where, null, null);
            if ($result->num_rows == 0) {
                echo "<div>You haven't posted anything. <a href='../post/addpost.php'>Tap here to create a new post.</a></div>";
            } else {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="post-card" onclick="viewPost(<?php echo $row['id']; ?>)">
                        <img class="post-img" src="<?php echo 'http://localhost/finderz/uploads/posts/' . htmlspecialchars($row['image']); ?>" alt="image">
                        <div class="edit-posts">
                            <p class="edit" onclick="event.stopPropagation(); editPost(<?php echo $row['id']; ?>)"><i class="fa-solid fa-pen-to-square"></i></p>
                            <p class="delete" onclick="event.stopPropagation(); deletePost(<?php echo $row['id']; ?>)"><i class="fa-solid fa-trash"></i></p>
                        </div>

                        <h3 class="post-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p class="content-p"><?php echo htmlspecialchars($row['description']); ?></p>

                    </div>
            <?php
                }
            }
            ?>
        </div>
    </section>

    <script>
        function viewPost(postId) {
            window.location.href = `../post/post.php?id=${postId}`;
        }

        function editPost(postId) {
            window.location.href = `../post/updatepost.php?id=${postId}`;
        }

        function deletePost(postId) {
            if (confirm('Are you sure you want to delete this post?')) {
                window.location.href = `../post/delete.php?id=${postId}`;
            }
        }
    </script>
</body>

</html>