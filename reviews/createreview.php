<?php
ob_start();
require("../Navbar.php");
$db = new Database();
$userId = $_SESSION['loggedinuserId'];

$where = " author_id= '$userId'";
$rev = $db->select('reviews', '*', null, $where, null, null);
if ($rev->num_rows > 0) {
    header('location: viewreview.php');
    exit();
}
ob_end_flush();

$satisfaction = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submitBtn'])) {
        $authorId = $_SESSION['loggedinuserId'];
        $satisfaction = $_POST['satisfaction'] ?? '';
        $found = $_POST['found'] ?? '';
        $recommend = $_POST['recommend'] ?? '';
        $message = $_POST['message'] ?? '';
        $dateTime = date('Y-m-d H:i:s');

        $result = $db->insert('reviews', [
            'author_id' => $authorId,
            'satisfaction' => $satisfaction,
            'found' => $found,
            'recommend' => $recommend,
            'message' => $message,
            'time' => $dateTime
        ]);

        if ($result) {
            echo '<script>
                        alert("Thank you for the review. Enjoy using our application");
                        window.location.href = document.referrer;
                    </script>';
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn more about our team and mission.">
    <title>Review</title>
    <link rel="stylesheet" href="../index.css" />
    <style>
        .form-class {
            width: 80%;
            margin: auto;
        }

        .content-p {
            margin-bottom: 10px;
            font-weight: normal;
        }

        .satisfaction-slider {
            display: flex;
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('reviewForm').addEventListener('submit', function(event) {
                if (!validateForm()) {
                    event.preventDefault();
                } else {
                    const confirmation = confirm('Are you sure to give the review?');
                    if (!confirmation) {
                        event.preventDefault();
                    }
                }
            });
        });

        function updateSatisfactionValue(val) {
            document.getElementById('satisfactionValue').innerText = val;

            if (val > 0) {
                document.getElementById('satisfactionError').innerText = '';
            }
        }

        function validateForm() {
            let isValid = true;

            // Clear previous errors
            document.getElementById('satisfactionError').innerText = '';
            document.getElementById('foundError').innerText = '';
            document.getElementById('recommendError').innerText = '';
            document.getElementById('messageError').innerText = '';

            const satisfaction = parseInt(document.getElementById('satisfaction').value.trim(), 10);
            const found = document.querySelector('input[name="found"]:checked');
            const recommend = document.querySelector('input[name="recommend"]:checked');
            const message = document.getElementById('message').value.trim();

            // Satisfaction Validation
            if (satisfaction <= 0) { 
                document.getElementById('satisfactionError').innerText = "Satisfaction rating is required and must be greater than 0.";
                isValid = false;
            }

            // Found Validation
            if (!found) {
                document.getElementById('foundError').innerText = "Please select whether you found your belongings.";
                isValid = false;
            }

            // Recommend Validation
            if (!recommend) {
                document.getElementById('recommendError').innerText = "Please select if you recommend us.";
                isValid = false;
            }

            // Message Validation
            if (message.length < 10) {
                document.getElementById('messageError').innerText = "Review message must be at least 10 characters long.";
                isValid = false;
            }

            return isValid;
        }
    </script>

</head>

<body>
    <section class="review-form-section">
        <h1 class="content-header">Found us Useful? Send a review</h1>
        <form class="form-class" method="post" action="" id="reviewForm">
            <label for="satisfaction" class="post-title bold">Your satisfaction</label>
            <div class="satisfaction-slider">
                <span>0</span>
                <input type="range" id="satisfaction" name="satisfaction" min="0" max="10" value="<?= htmlspecialchars($satisfaction) ?? ''; ?>" oninput="updateSatisfactionValue(this.value)">
                <span>10</span>
            </div>
            <p id="satisfactionValue" class="post-title"><?= htmlspecialchars($satisfaction) ?? ''; ?></p>
            <p class="error" id="satisfactionError"></p>

            <div class="form-group">
                <p class="content-p bold">Did you find your lost belongings?</p>
                <label class="content-p">
                    <input type="radio" name="found" value="1" <?= isset($found) && $found == '1' ? 'checked' : ''; ?>> Yes
                </label>
                <label class="content-p">
                    <input type="radio" name="found" value="0" <?= isset($found) && $found == '0' ? 'checked' : ''; ?>> No
                </label>
            </div>
            <p class="error" id="foundError"></p>

            <div class="form-group">
                <p class="content-p bold">Will you recommend us to your friends and family?</p>
                <label class="content-p">
                    <input type="radio" name="recommend" value="1" <?= isset($recommend) && $recommend == '1' ? 'checked' : ''; ?>> Yes
                </label>
                <label class="content-p">
                    <input type="radio" name="recommend" value="0" <?= isset($recommend) && $recommend == '0' ? 'checked' : ''; ?>> No
                </label>
            </div>
            <p class="error" id="recommendError"></p>

            <div class="form-group">
                <label class="content-p" for="message">Message</label>
                <textarea id="message" name="message" rows="4" placeholder="Write your review here..."><?= htmlspecialchars($_POST['message'] ?? ""); ?></textarea>
            </div>
            <p class="error" id="messageError"></p>

            <button type="submit" class="btn" name="submitBtn">Submit</button>
        </form>
    </section>

    <?php require("../components/Footer.php") ?>
</body>

</html>