<?php
require("../Navbar.php");

// Validate and sanitize the 'id' to prevent SQL injection
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo 'Invalid post ID';
    die();
}

$id = intval($_GET['id']); // Ensure the id is an integer

$db = new Database();
$where = "posts.id='$id'";
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
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        main {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 1vw auto;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .imgDiv {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .imgDiv>img {
            width: 20vw;
            height: inherit;
            border-radius: 10px;
        }

        .title {
            text-align: center;
            margin: 1vw auto;
            font-size: 1.8vw;
        }

        .description {
            font-size: 1.5vw;
            line-height: 1.5;
            text-align: left;
            width: 90%;
            margin: auto;
        }

        .author,
        .date {
            font-size: 1.2vw;
            margin: 1vw auto;
            width: 90%;
            text-align: right;
        }

        .author {
            font-weight: bold;
        }

        .backBtn {
            height: 3vw;
            width: 10vw;
            padding: 0 10px;
            background-color: #ff5722;
            border: none;
            color: white;
            font-size: 1.2vw;
            border-radius: 5px;
            cursor: pointer;
        }

        .backBtn a {
            text-decoration: none;
            color: white;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <main>
        <div class="imgDiv">
            <?php if (!empty($row['image'])) { ?>
                <img src="<?php echo 'http://localhost/finderz/uploads/posts/' . htmlspecialchars($row['image']); ?>" class="displayImg" alt="post image">
            <?php } else { ?>
                <p>No image available</p>
            <?php } ?>
        </div>
        <h3 class="title"><?= !empty($row['title']) ? htmlspecialchars($row['title']) : 'No title available'; ?></h3>
        <p class="description"><?= !empty($row['description']) ? htmlspecialchars($row['description']) : 'No description available'; ?></p>
        <p class="author">Posted by: <?= !empty($row['name']) ? htmlspecialchars($row['name']) : 'Unknown'; ?></p>
        <p class="date">
        <p class="date">
            <?= date('F j, Y', strtotime($row['time'])); ?><br>
            <?= date('g:i a', strtotime($row['time'])); ?>
        </p>
        </p>
        <button class="backBtn"><a href="./viewpost.php">Back to Posts</a></button>
    </main>

    <?php require("../components/Footer.php"); ?>
</body>

</html>