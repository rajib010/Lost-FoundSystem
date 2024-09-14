<?php
require("../Navbar.php");
$db = new Database();
$result = $db->select('reviews', "*", null, null, null, null);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row['rid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Review</title>
    <link rel="stylesheet" href="../styles/Review.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
</head>

<body>
    <main class="main-view-review">
        <section class='view-review'>
            <div class="top-class">
                <button class="submit-btn view-edit-btn" onclick="navigate(<?= $id ?>)">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </div>
            <p class="line"><span class="label">Your satisfaction level</span> <?= $row['satisfaction'] ?? 'Not specified' ?></p>
            <p class="line"><span class="label">Did you find your lost item?</span> <?= isset($row['found']) ? ($row['found'] == 1 ? 'Yes' : 'No') : 'Not specified' ?></p>
            <p class="line"><span class="label">Do you want to recommend us to your friends and family?</span> <?= isset($row['recommend']) ? ($row['recommend'] == 1 ? 'Yes' : 'No') : 'Not specified' ?></p>
            <p class="line"><span class="label">Your review:</span> <?= $row['message'] ?? 'No review provided' ?></p>
            <p class="date">
                <?= date('F j, Y', strtotime($row['time'] ?? '')) ?><br>
                <?= date('g:i a', strtotime($row['time'] ?? '')) ?>
            </p>
        </section>
    </main>

    <script>
        function navigate(id) {
            window.location.href = `updatereview.php?id=${id}`;
        }
    </script>

    <?php
    require("../components/Footer.php");
    ?>
</body>

</html>

<?php } ?>
