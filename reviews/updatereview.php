<?php
require("../Navbar.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Review</title>
    <link rel="stylesheet" href="../styles/index.css">
    <style>
        .top-class {
            width: 100%;
            margin: -2vw 0px 0px 0px;
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
            font-weight: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
</head>

<body>
    <?php
    $db = new Database();
    $id = $_GET['id'];
    $where = "rid = '$id'";
    $result = $db->select('reviews', "*", null, $where, null, null);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }

    $satisfaction = $_POST['satisfaction'] ?? $row['satisfaction'] ?? '';
    $found = $_POST['found'] ?? $row['found'] ?? '';
    $recommend = $_POST['recommend'] ?? $row['recommend'] ?? '';
    $message = $_POST['message'] ?? $row['message'] ?? '';
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitBtn'])) {
        // Validation
        if (empty($satisfaction)) $errors['satisfaction'] = 'Please select satisfaction level';
        if (!isset($found) || $found === '') $errors['found'] = 'Please indicate if you found your item';
        if (!isset($recommend) || $recommend === '') $errors['recommend'] = 'Please indicate if you recommend us';
        if (empty($message)) $errors['message'] = 'Please provide a message';

        // Update database if no errors
        if (empty($errors)) {
            $updateData = [
                'satisfaction' => $satisfaction,
                'found' => $found,
                'recommend' => $recommend,
                'message' => $message
            ];
            $where = "rid = $id";
            $updateResult = $db->update('reviews', $updateData, $where);

            if ($updateResult) {
                echo '<script>alert("Review updated successfully"); window.location.href = "viewreview.php";</script>';
            }
        }
    }
    ?>
    <section class="update-review-section">
        <h1 class="content-header">Update your review.</h1>
        <div class="top-class">
            <button class="btn" id="deleteBtn" onclick="navigate(<?= $id ?>)">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
        <form class="form-class" method="post" action="">
            <label for="satisfaction" class="post-title bold">Your satisfaction</label>
            <div class="satisfaction-slider">
                <span>0</span>
                <input type="range" id="satisfaction" name="satisfaction" min="0" max="10" value="<?= $satisfaction ?>" oninput="updateSatisfactionValue(this.value)">
                <span>10</span>
            </div>
            <p id="satisfactionValue" class="post-title bold"><?= htmlspecialchars($satisfaction) ?? ''; ?></p>
            <p class="error"><?= htmlspecialchars($errors['satisfaction'] ?? ''); ?></p>

            <div class="form-group">
                <p class="content-p bold">Did you find your lost belongings?</p>
                <label class="content-p">
                    <input type="radio" name="found" value="1" <?= $found == '1' ? 'checked' : ''; ?>> Yes
                </label>
                <label class="content-p">
                    <input type="radio" name="found" value="0" <?= $found == '0' ? 'checked' : ''; ?>> No
                </label>
                <label class="content-p">
                    <input type="radio" name="found" value="2" <?= $found == '2' ? 'checked' : ''; ?>> On the way
                </label>
            </div>
            <p class="error"><?= htmlspecialchars($errors['found'] ?? ''); ?></p>

            <div class="form-group">
                <p class="content-p bold">Will you recommend us to your friends and family?</p>
                <label class="content-p">
                    <input type="radio" name="recommend" value="1" <?= $recommend == '1' ? 'checked' : ''; ?>> Yes
                </label>
                <label class="content-p">
                    <input type="radio" name="recommend" value="0" <?= $recommend == '0' ? 'checked' : ''; ?>> No
                </label>
            </div>
            <p class="error"><?= htmlspecialchars($errors['recommend'] ?? ''); ?></p>

            <div class="form-group">
                <label for="message" class="content-p bold">Message</label>
                <textarea id="message" name="message" rows="4" placeholder="Write your review here..."><?= htmlspecialchars($message); ?></textarea>
            </div>
            <p class="error"><?= htmlspecialchars($errors['message'] ?? ''); ?></p>

            <div class="buttons">
                <button type="submit" class="btn" name="submitBtn">Update</button>
                <button type="button" class="btn" id="cancelBtn" onclick="navigate()">Cancel</button>
            </div>

            <script>
                function navigate() {
                    window.location.href = `viewreview.php`;
                }
                function navigate(id) {
                    if (confirm('Are you sure you want to delete?')) {
                        window.location.href = `deleteReview.php?id=${id}`;
                    }
                }
                function updateSatisfactionValue(val) {
                    document.getElementById('satisfactionValue').textContent = val;
                }
            </script>
        </form>
    </section>
    <?php
    require("../components/Footer.php");
    ?>
</body>

</html>