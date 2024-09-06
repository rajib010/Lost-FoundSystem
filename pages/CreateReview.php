<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn more about our team and mission.">
    <title>Review</title>
    <link rel="stylesheet" href="../styles/Review.css" />
</head>

<body>
    <?php
    if (file_exists("../components/Navbar.php")) {
        require("../components/Navbar.php");
    } else {
        echo "<div class='navbar'>Navbar could not be loaded.</div>";
    }
    ?>
    <section class="review-form-section">
        <h1>Found us Useful? Send a review</h1>
        <form class="review-form">
            <label for="satisfaction">Your satisfaction</label>
            <div class="satisfaction-slider">
                <span>0</span>
                <input type="range" id="satisfaction" name="satisfaction" min="0" max="10">
                <span>10</span>
            </div>

            <div class="form-group">
                <p>Did you find your lost belongings?</p>
                <label>
                    <input type="radio" name="found" value="yes"> Yes
                </label>
                <label>
                    <input type="radio" name="found" value="no"> No
                </label>
                <label>
                    <input type="radio" name="found" value="on_the_way"> On the way
                </label>
            </div>

            <div class="form-group">
                <p>Will you recommend us to your friends and family?</p>
                <label>
                    <input type="radio" name="recommend" value="yes"> Yes
                </label>
                <label>
                    <input type="radio" name="recommend" value="no"> No
                </label>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" placeholder="Write your review here..."></textarea>
            </div>

            <button type="submit" class="submit-btn">Send</button>
        </form>
    </section>


    <?php
    if (file_exists("../components/Footer.php")) {
        require("../components/Footer.php");
    } else {
        echo "<div class='footer'>Footer could not be loaded.</div>";
    }
    ?>
</body>

</html>