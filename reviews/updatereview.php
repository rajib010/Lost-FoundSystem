<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("../Navbar.php");

$db = new Database();

$id = intval($_GET['id']);
$where = "id = '$id'";
$result = $db->select('reviews', "*", null, $where, null, null);

// Initialize review data
$satisfaction = $found = $recommend = $message = '';
$errors = [];

// Check if review exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Populate variables with existing review data
    $satisfaction = $row['satisfaction'] ?? '';
    $found = $row['found'] ?? '';
    $recommend = $row['recommend'] ?? '';
    $message = $row['message'] ?? '';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitBtn'])) {
    $satisfaction = $_POST['satisfaction'] ?? '';
    $found = $_POST['found'] ?? '';
    $recommend = $_POST['recommend'] ?? '';
    $message = $_POST['message'] ?? '';

    $updateData = [
        'satisfaction' => $satisfaction,
        'found' => $found,
        'recommend' => $recommend,
        'message' => $message
    ];

    $where = "id = $id";
    $updateResult = $db->update('reviews', $updateData, $where);

    if ($updateResult) {
        echo "<script>alert('Review updated successfully'); window.location.href = 'viewreview.php'</script>";
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
    <style>
        .top-class {
            width: 100%;
            margin: -2vw 0 0;
            display: flex;
            justify-content: flex-end;
        }

        .form-class {
            width: 80%;
            margin: auto;
        }

        .content-p {
            margin-bottom: 10px;
        }

        .satisfaction-slider {
            display: flex;
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: normal;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
</head>

<body>
    <section class="update-review-section">
        <h1 class="content-header">Update your review.</h1>
        <div class="top-class">
            <button class="btn" id="deleteBtn" onclick="navigate(<?= $id ?>)">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
        <form class="form-class" method="post" action="" id="updateReviewForm">
            <label for="satisfaction" class="post-title bold">Your satisfaction</label>
            <div class="satisfaction-slider">
                <span>0</span>
                <input type="range" id="satisfaction" name="satisfaction" min="0" max="10" value="<?= htmlspecialchars($satisfaction) ?>" oninput="updateSatisfactionValue(this.value)">
                <span>10</span>
            </div>
            <p id="satisfactionValue" class="post-title bold"><?= htmlspecialchars($satisfaction) ?></p>
            <p class="error" id="satisfactionError"></p>

            <div class="form-group">
                <p class="content-p bold">Did you find your lost belongings?</p>
                <label class="content-p">
                    <input type="radio" name="found" value="1" <?= $found == '1' ? 'checked' : ''; ?>> Yes
                </label>
                <label class="content-p">
                    <input type="radio" name="found" value="0" <?= $found == '0' ? 'checked' : ''; ?>> No
                </label>
            </div>
            <p class="error" id="foundError"></p>

            <div class="form-group">
                <p class="content-p bold">Will you recommend us to your friends and family?</p>
                <label class="content-p">
                    <input type="radio" name="recommend" value="1" <?= $recommend == '1' ? 'checked' : ''; ?>> Yes
                </label>
                <label class="content-p">
                    <input type="radio" name="recommend" value="0" <?= $recommend == '0' ? 'checked' : ''; ?>> No
                </label>
            </div>
            <p class="error" id="recommendError"></p>

            <div class="form-group">
                <label for="message" class="content-p bold">Message</label>
                <textarea id="message" name="message" rows="4" placeholder="Write your review here..."><?= htmlspecialchars($message) ?></textarea>
            </div>
            <p class="error" id="messageError"></p>

            <div class="buttons">
                <button type="submit" class="btn" name="submitBtn">Update</button>
                <button type="button" class="btn" id="cancelBtn" onclick="back()">Cancel</button>
            </div>

            <script>
                function back() {
                    window.location.href = 'viewreview.php';
                }

                function navigate(id) {
                    if (confirm('Are you sure you want to delete?')) {
                        window.location.href = `deleteReview.php?id=${id}`;
                    }
                }

                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('updateReviewForm').addEventListener('submit', function(event) {
                        if (!validateForm()) {
                            event.preventDefault();
                        } else {
                            const confirmation = confirm('Are you sure to update the review?');
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
        </form>
    </section>
    <?php require("../components/Footer.php"); ?>
</body>

</html>