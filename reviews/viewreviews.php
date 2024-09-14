<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Review</title>
    <link rel="stylesheet" href="../styles/Review.css">
</head>

<body>
    <?php
    require("../Navbar.php");
    ob_start();
    $db = new Database();
    $result = $db->select('reviews', "*", null, null, null, null);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc()
    ?>
        <main class="main-view-review">
            <section class='view-review'>
                <p class="line"><span class="label">Your satisfaction level</span> <?= $row['satisfaction'] ?></p>
                <p class="line"><span class="label">Did you find your lost item?</span> <?= $row['found'] == 1 ? 'Yes' : 'No' ?></p>
                <p class="line"><span class="label">Do you want to recommend us to your friends and family?</span> <?= $row['recommend'] == 1 ? 'Yes' : 'No' ?></p>
                <p class="line"><span class="label">Your review:</span> <?= $row['message'] ?? '' ?></p>
                <p class="date">
                    <?= date('F j, Y', strtotime($row['time'])); ?><br>
                    <?= date('g:i a', strtotime($row['time'])); ?>
                </p>
            </section>
        </main>
        <?php
        require("../components/Footer.php") ?>
</body>

</html>


<?php } ?>