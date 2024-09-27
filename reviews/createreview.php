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
$errors = [];
$satisfaction = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submitBtn'])) {
        $authorId = $_SESSION['loggedinuserId'];
        $satisfaction = $_POST['satisfaction'] ?? '';
        $found = $_POST['found'] ?? '';
        $recommend = $_POST['recommend'] ?? '';
        $message = $_POST['message'] ?? '';
        $dateTime = date('Y-m-d H:i:s');

        // Validate fields
        if (empty($satisfaction)) {
            $errors['satisfaction'] = 'Drag the cursor to select your satisfaction level';
        }
        if (empty($found)) {
            $errors['found'] = 'Please select one option';
        }
        if (empty($recommend)) {
            $errors['recommend'] = 'Please select one option';
        }
        if (empty($message)) {
            $errors['message'] = 'Message field cannot be empty';
        }

        if (empty($errors)) {
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
                        window.location.href = "../pages/home.php";
                    </script>';
                exit();
            }
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
    <link rel="stylesheet" href="../styles/index.css" />
    <style>
        .form-class {
            width: 80%;
            margin: auto;
        }
        
        .content-p{
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
        function updateSatisfactionValue(val) {
            document.getElementById('satisfactionValue').innerText = val;
        }
    </script>
</head>

<body>
    <section class="review-form-section">
        <h1 class="content-header">Found us Useful? Send a review</h1>
        <form class="form-class" method="post" action="">
            <label for="satisfaction" class="post-title bold">Your satisfaction</label>
            <div class="satisfaction-slider">
                <span>0</span>
                <input type="range" id="satisfaction" name="satisfaction" min="0" max="10" value="<?= htmlspecialchars($satisfaction) ?? ''; ?>" oninput="updateSatisfactionValue(this.value)">
                <span>10</span>
            </div>
            <p id="satisfactionValue" class="post-title"><?= htmlspecialchars($satisfaction) ?? ''; ?></p>
            <p class="error"><?= htmlspecialchars($errors['satisfaction'] ?? ''); ?></p>

            <div class="form-group">
                <p class="content-p bold">Did you find your lost belongings?</p>
                <label class="content-p">
                    <input type="radio" name="found" value="1" <?= isset($found) && $found == '1' ? 'checked' : ''; ?>> Yes
                </label>
                <label class="content-p">
                    <input type="radio" name="found" value="0" <?= isset($found) && $found == '0' ? 'checked' : ''; ?>> No
                </label>
                <label class="content-p">
                    <input type="radio" name="found" value="2" <?= isset($found) && $found == '2' ? 'checked' : ''; ?>> On the way
                </label>
            </div>
            <p class="error"><?= htmlspecialchars($errors['found'] ?? ''); ?></p>

            <div class="form-group">
                <p class="content-p bold">Will you recommend us to your friends and family?</p>
                <label class="content-p">
                    <input type="radio" name="recommend" value="1" <?= isset($recommend) && $recommend == '1' ? 'checked' : ''; ?>> Yes
                </label>
                <label class="content-p">
                    <input type="radio" name="recommend" value="0" <?= isset($recommend) && $recommend == '0' ? 'checked' : ''; ?>> No
                </label>
            </div>
            <p class="error"><?= htmlspecialchars($errors['recommend'] ?? ''); ?></p>

            <div class="form-group">
                <label class="content-p" for="message">Message</label>
                <textarea id="message" name="message" rows="4" placeholder="Write your review here..."><?= htmlspecialchars($_POST['message'] ?? ""); ?></textarea>
            </div>
            <p class="error"><?= htmlspecialchars($errors['message'] ?? ''); ?></p>

            <button type="submit" class="btn" name="submitBtn">Submit</button>
        </form>
    </section>

    <?php require("../components/Footer.php") ?>

</body>

</html>