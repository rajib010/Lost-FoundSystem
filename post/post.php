<?php
require("../Navbar.php");

// Validate and sanitize the 'id' to prevent SQL injection
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo 'Invalid post ID';
    die();
}

$id = intval($_GET['id']); // Ensure the id is an integer

$db = new Database();
$where = "posts.pid='$id'";
$join = "user_info ON posts.author_id = user_info.id";

// Fetch post details from the database
$result = $db->select('posts', 'posts.*, user_info.name', $join, $where, null, null);
// if ($result->num_rows == 0) {
//     echo 'Failed to display the post or post does not exist.';
//     die();
// }

$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="../styles/index.css" />
    <style>
        .content-p, .post-title{
            margin: 15px auto;
            width: 80%;
            font-size: 1.5vw;
            
        }
        .imgDiv {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .displayImg{
            width: 40vw;
            height: inherit;
            border-radius: 10px;
        }
        .author,
        .date {
            font-size: 1.2vw;
            margin: 1vw auto;
            width: 90%;
            text-align: right;
        }


        @media (min-width:767px) and (max-width:1024px) {
            .displayImg{
                width: 50vw;
            }
        }
        @media (max-width:768px){
            .displayImg{
                width: 60vw;
            }
        }

        
    </style>
</head>

<body>
    <main class="single-post">
        <div class="imgDiv">
            <?php if (!empty($row['image'])) { ?>
                <img src="<?php echo 'http://localhost/finderz/uploads/posts/' . htmlspecialchars($row['image']); ?>" class="displayImg" alt="post image">
            <?php } else { ?>
                <p>No image available</p>
            <?php } ?>
        </div>
        <h3 class="post-title"><?= !empty($row['title']) ? htmlspecialchars($row['title']) : 'No title available'; ?></h3>
        <p class="content-p"><?= !empty($row['description']) ? htmlspecialchars($row['description']) : 'No description available'; ?></p>
        <p class="author bold content-p">Posted by: <?= !empty($row['name']) ? htmlspecialchars($row['name']) : 'Unknown'; ?></p>
        <p class="date content-p">
            <?= date('F j, Y', strtotime($row['time'])); ?><br>
            <?= date('g:i a', strtotime($row['time'])); ?>
        </p>
        
        <button class="btn"><a href="./viewpost.php">Back to Posts</a></button>
    </main>

    <?php require("../components/Footer.php"); ?>
</body>

</html>