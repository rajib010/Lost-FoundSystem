<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../Navbar.php");

$db = new Database();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if ID is valid
if ($id <= 0) {
    die("Invalid review ID");
}

// Prepare the where condition
$where = "id = $id"; // Directly using $id here is safe due to intval

// Fetch the review from the database
$result = $db->select('reviews', "*", null, $where, null, null);

// Initialize review data
$satisfaction = $found = $recommend = $message = '';
$errors = [];

// Check if the review exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Populate variables with existing review data
    $satisfaction = $row['satisfaction'] ?? '';
    $found = $row['found'] ?? '';
    $recommend = $row['recommend'] ?? '';
    $message = $row['message'] ?? '';
} else {
    die("Review not found");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitBtn'])) {
    // Sanitize form inputs
    $satisfaction = isset($_POST['satisfaction']) ? intval($_POST['satisfaction']) : '';
    $found = isset($_POST['found']) ? intval($_POST['found']) : '';
    $recommend = isset($_POST['recommend']) ? intval($_POST['recommend']) : '';
    $message = trim($_POST['message']) ?? '';

    $updateData = [
        'satisfaction' => $satisfaction,
        'found' => $found,
        'recommend' => $recommend,
        'message' => $message
    ];

    $updateResult = $db->update('reviews', $updateData, $where);

    if ($updateResult) {
        echo "<script>
            window.location.href = 'viewreview.php'
         </script>";
        exit();
    } else {
        echo "<script>alert('Failed to update review')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Review</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
    <style>
        .star-rating {
            display: flex;
            direction: row-reverse;
            font-size: 2rem;
        }

        .star-rating input {
            display: none;
        }

        .star-rating input:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #f5b301;
        }

        .form-class {
            width: 80%;
            margin: auto;
        }

        .content-p {
            margin-bottom: 10px;
        }

        .form-group label {
            font-weight: normal;
        }
    </style>
</head>

<body>
    <section class="update-review-section">
        <h1 class="content-header">Update your review</h1>
        <div class="top-class">
            <button class="btn" id="deleteBtn" onclick="navigate(<?= $id ?>)">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
        <form class="form-class" method="post" action="" id="updateReviewForm">

            <div class="form-group">
                <label for="satisfaction" class="post-title bold">Your satisfaction</label>
                <div class="star-rating">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <input type="radio" id="star-<?= $i ?>" name="satisfaction" value="<?= $i + 1 ?>" <?= $satisfaction == ($i + 1) ? 'checked' : ''; ?> class="star-input" onchange="fillStars(this.value - 1)">
                        <label for="star-<?= $i ?>" title="<?= $i + 1 ?> stars" class="star">&#9733;</label>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="form-group">
                <p class="content-p bold">Did you find your lost belongings?</p>
                <label class="content-p">
                    <input type="radio" name="found" value="1" <?= $found == '1' ? 'checked' : ''; ?>> Yes
                </label>
                <label class="content-p">
                    <input type="radio" name="found" value="0" <?= $found == '0' ? 'checked' : ''; ?>> No
                </label>
            </div>

            <div class="form-group">
                <p class="content-p bold">Will you recommend us to your friends and family?</p>
                <label class="content-p">
                    <input type="radio" name="recommend" value="1" <?= $recommend == '1' ? 'checked' : ''; ?>> Yes
                </label>
                <label class="content-p">
                    <input type="radio" name="recommend" value="0" <?= $recommend == '0' ? 'checked' : ''; ?>> No
                </label>
            </div>

            <div class="form-group">
                <label for="message" class="content-p bold">Message</label>
                <textarea id="message" name="message" rows="4" placeholder="Write your review here..."><?= htmlspecialchars($message) ?></textarea>
            </div>

            <div class="buttons">
                <button type="submit" class="btn" name="submitBtn">Update</button>
                <button type="button" class="btn" id="cancelBtn">Cancel</button>
            </div>
        </form>
    </section>
    <?php require("../components/Footer.php"); ?>

    <script>
        function fillStars(index) {
            const stars = document.querySelectorAll('.star');
            stars.forEach((star, i) => {
                star.style.color = i <= index ? '#f5b301' : 'gray';
            });
        }

        document.querySelector("#cancelBtn").addEventListener('click', () => {
            window.location.href = document.referrer;
        })

        document.addEventListener('DOMContentLoaded', () => {
            const checkedStar = document.querySelector('input[name="satisfaction"]:checked');
            if (checkedStar) {
                fillStars(checkedStar.value - 1);
            }
        });
    </script>
</body>

</html>