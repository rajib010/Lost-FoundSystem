<?php
require("../Navbar.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo 'Invalid post ID';
    die();
}

$id = intval($_GET['id']);
$table = 'posts';

$db = new Database();
$where = "posts.id='$id'";
$join = "user_info ON posts.author_id = user_info.id";

$result = $db->select($table, 'posts.*, user_info.name', $join, $where, null, null);

$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="../index.css" />
    <style>
        .content-p,
        .post-title {
            margin: 15px auto;
            width: 80%;
            font-size: 1.5vw;

        }

        .imgDiv {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .author,
        .date {
            font-size: 1.2vw;
            margin: 1vw auto;
            width: 90%;
            text-align: right;
        }

        @media (max-width: 480px) {
            .displayImg {
                max-width: 80vw;
                max-height: 50vh;
            }
        }
    </style>
</head>

<body>
    <main class="single-post">
        <?php
        if ($_SESSION['loggedinuserId'] === $row['author_id']) {
            echo '<div class="top-class">
                   <button class="btn" id="editBtn">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                  </div>';
        }
        ?>
        <div class="imgDiv">
            <?php if (!empty($row['image'])) { ?>
                <img src="<?php echo 'http://localhost/finderz/uploads/posts/' . htmlspecialchars($row['image']); ?>" class="displayImg" alt="post image">
            <?php } else { ?>
                <p class="content-p">No image available</p>
            <?php } ?>
        </div>
        <h3 class="post-title"><?= !empty($row['title']) ? htmlspecialchars($row['title']) : 'No title available'; ?></h3>
        <p class="content-p"><?= !empty($row['description']) ? htmlspecialchars($row['description']) : 'No description available'; ?></p>
        <p class="author bold content-p">Posted by: <?= !empty($row['name']) ? htmlspecialchars($row['name']) : 'Unknown'; ?></p>
        <p class="date content-p">
            <?= date('F j, Y', strtotime($row['time'])); ?><br>
            <?= date('g:i a', strtotime($row['time'])); ?>
        </p>

        <button class="btn"><a href="./viewposts.php">Back to Posts</a></button>
    </main>

    <?php require("../components/Footer.php"); ?>
    <script>
        document.querySelector("#editBtn").addEventListener('click', () => {
            if(confirm('Do you want to update the post?')){
                return window.location.href = `updatepost.php?id=${<?php echo $row['id']; ?>}`;
            }
        })
    </script>

</body>

</html>