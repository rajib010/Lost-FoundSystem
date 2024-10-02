<?php
require("../Navbar.php");

$db = new Database();
$id = $_SESSION['loggedinuserId'];
$where = "id='$id'";
$join = 'posts on posts.author_id=user_info.id';

$result = $db->select('user_info', 'user_info.*,', $join, $where, null, null);

$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link rel="stylesheet" href="../index.css" />
    <style>
        .post-title {
            margin-top: 10px;
        }

        .content-p {
            margin: 10px 43.5%;
            width: 50%;
            text-align: left;

        }

        @media (max-width: 767px) {
            .content-p {
                width: 60% ;
            }
        }
    </style>

</head>

<body>
    <main class="viewprofile-section">
        <div class="top-class">
            <button class="btn">
                <a href="./edituser.php">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
            </button>
        </div>
        <div class="imgDiv">

            <?php if (!empty($row['profileImg'])) { ?>
                <img src="<?php echo 'http://localhost/finderz/uploads/user/' . htmlspecialchars($row['profileImg']); ?>" class="displayImg" alt="profile image">
            <?php } else { ?>
                <p class="content-p">No image available</p>
            <?php } ?>
        </div>
        <h3 class="post-title"><?= htmlspecialchars($row['name']); ?></h3>

        <p class="content-p"><span class="bold">Email: </span><?= htmlspecialchars($row['email']) ?></p>
        <p class="content-p"><span class="bold">Contact: </span><?= htmlspecialchars($row['phone_number']) ?></p>
        <p class="content-p"><span class="bold">From: </span><?= htmlspecialchars($row['address']) ?></p>

    </main>
    <?php require("../components/Footer.php") ?>
</body>

</html>