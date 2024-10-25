<?php
require("../Navbar.php");
$db = new Database();
$id = $_SESSION['loggedinuserId'];
$where = "author_id='$id'";
$result = $db->select('reviews', "*", null, $where, null, null);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row['id'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Review</title>
        <link rel="stylesheet" href="../index.css">
        <style>
            .top-class {
                width: 100%;
                margin: -2vw 0px 0px 0px;
                display: flex;
                justify-content: flex-end;
            }

            .question {
                font-weight: bold;
                color: #555;
            }

            .question,
            .answer {
                text-align: left;
            }

            .answer {
                color: #333;
                width: 50%;
            }

            .line {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 15px;
            }

            .date {
                font-size: 14px;
                color: #777;
                margin-top: 20px;
                text-align: right;
            }

            @media (max-width: 768px) {
                .line {
                    display: block;
                    margin-bottom: 20px;
                }

                .question,
                .answer {
                    width: 100%;
                    display: block;
                    margin-bottom: 5px;
                }
            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
    </head>

    <body>
        <section class='view-review'>
            <div class="top-class">
                <button class="btn" onclick="navigate(<?= $id ?>)">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </div>
            <p class="line content-p"><span class="question">Your satisfaction level</span>
                <span class="answer"> <?= $row['satisfaction'] ?? 'Not specified' ?></span>
            </p>
            <p class="line content-p"><span class="question">Did you find your lost item?</span>
                <span class="answer"> <?= isset($row['found']) ? ($row['found'] == 1 ? 'Yes' : 'No') : 'Not specified' ?></span>
            </p>
            <p class="line content-p"><span class="question">Do you want to recommend us to your friends and family?</span>
                <span class="answer"> <?= isset($row['recommend']) ? ($row['recommend'] == 1 ? 'Yes' : 'No') : 'Not specified' ?></span>
            </p>
            <p class="line content-p"><span class="question">Your review:</span>
                <span class="answer"> <?= $row['message'] ?? 'No review provided' ?></span>
            </p>
            <p class="date">
                <?= date('F j, Y', strtotime($row['time'] ?? '')) ?><br>
                <?= date('g:i a', strtotime($row['time'] ?? '')) ?>
            </p>
        </section>

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