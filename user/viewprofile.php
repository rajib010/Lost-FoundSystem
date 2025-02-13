<?php
require("../Navbar.php");

$db = new Database();
$id = $_SESSION['loggedinuserId'];
$where = "user_info.id='$id'";
$join = 'posts on posts.author_id=user_info.id';

$result = $db->select('user_info', '*,COUNT(*) as totalposts', $join, $where, null, null);

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

        .data-p{
            margin: 10px 43.5%;
            width: 50%;
            text-align: left;

        }
        .info-div{
            width: 40%;
            margin: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        @media (max-width: 767px) {
            .content-p {
                width: 60%;
            }
            .info-div{
                width: 45%;
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

        <div class="info-div">
            <p class="data-p"><span class="bold">Email: </span><?= htmlspecialchars($row['email']) ?></p>
            <p class="data-p"><span class="bold">Contact: </span><?= htmlspecialchars($row['phone_number']) ?></p>
            <p class="data-p"><span class="bold">From: </span><?= htmlspecialchars($row['address']) ?></p>
            <p class="data-p"><span class="bold">Total Posts: </span><?= htmlspecialchars($row['totalposts']) ?></p>

        </div>
    </main>
    <?php require("../components/Footer.php") ?>
</body>

</html>