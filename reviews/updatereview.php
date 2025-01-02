<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../Navbar.php");
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
    <!-- php code to update the review -->
    <?php
    $db = new Database();

    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($id <= 0) {
        die("Invalid review ID");
    }

    $where = "id = $id";

    $result = $db->select('reviews', "*", null, $where, null, null);

    $satisfaction = $found = $recommend = $message = '';
    $errors = [];


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $satisfaction = $row['satisfaction'] ?? '';
        $found = $row['found'] ?? '';
        $recommend = $row['recommend'] ?? '';
        $message = $row['message'] ?? '';
    } else {
        header('location: createreview.php');
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

    <section class="update-review-section">
        <h1 class="content-header">Update your review</h1>
        <div class="top-class">
            <button class="btn" id="deleteBtn" onclick="navigate(<?= $id ?>)">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
        <form class="form-class" method="post" action="" id="updateReviewForm" onsubmit="return validateForm()">

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
                <p class="error" id="foundError"></p>
            </div>

            <div class="form-group">
                <p class="content-p bold">Will you recommend us to your friends and family?</p>
                <label class="content-p">
                    <input type="radio" name="recommend" value="1" <?= $recommend == '1' ? 'checked' : ''; ?>> Yes
                </label>
                <label class="content-p">
                    <input type="radio" name="recommend" value="0" <?= $recommend == '0' ? 'checked' : ''; ?>> No
                </label>
                <p class="recommendError"></p>
            </div>

            <div class="form-group">
                <label for="message" class="content-p bold">Message</label>
                <textarea id="message" name="message" rows="4" placeholder="Write your review here..."><?= htmlspecialchars($message) ?></textarea>
                <p class="error" id="messageError"></p>
            </div>

            <div class="buttons">
                <button type="submit" class="btn" name="submitBtn" id="updateBtn">Update</button>
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

        function navigate(id) {
            if (confirm('Are you sure to delete this review?')) {
                return window.location = `deleteReview.php?id=${id}`;
            }
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


        function validateForm() {
            let isValid = true;

            const message = document.getElementById('message').value.trim();
            const foundRadio = document.getElementsByName('found');
            const recommendRadio = document.getElementsByName('recommend');

            const messageError = document.getElementById('messageError');
            const foundError = document.getElementById('foundError');
            const recommendError = document.getElementById('recommendError');

            messageError.innerText = '';
            foundError.innerText = '';
            recommendError.innerText = '';

            const messagePattern = /^(?=.*[a-zA-Z].*[a-zA-Z].*[a-zA-Z].*[a-zA-Z].*[a-zA-Z])[a-zA-Z0-9\s\-,:.]{5,}$/;
            if (!messagePattern.test(message)) {
                document.getElementById('messageError').innerText = "Message should be alphanumeric and at least 8 characters";
                isValid = false;
            }

            const isFoundSelected = Array.from(foundRadio).some(radio => radio.checked);
            if (!isFoundSelected) {
                foundError.innerText = 'Please select if you found your belongings.';
                isValid = false;
            }

            const isRecommendSelected = Array.from(recommendRadio).some(radio => radio.checked);
            if (!isRecommendSelected) {
                recommendError.innerText = 'Please select if you recommend us.';
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>

</html>