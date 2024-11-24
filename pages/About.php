<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn more about our team and mission.">
    <title>About Us</title>
    <link rel="stylesheet" href="../index.css" />
    <style>
        .post-title {
            margin-bottom: 8px;
        }

        .semi-container {
            max-width: 100%;
            padding: 3vw 0vw 0vw 0vw;
            margin: 1vw 0px 2vw;
        }

        .semi-container>h2 {
            margin-bottom: 3vw;
        }

        @media (max-width:768px) {
            .semi-container>h2 {
                margin-bottom: 5vw;
            }
        }
    </style>
</head>

<body>
    <?php
    if (file_exists("../Navbar.php")) {
        require("../Navbar.php");
    } else {
        echo "<div class='navbar'>Navbar could not be loaded.</div>";
    }
    ?>

    <section class="about-section">
        <h1 class="content-header">Welcome to Lost & Found</h1>
        <div class="about-container">

            <div class="sub-content">
                <h3 class="post-title">About us</h3>
                <p class="content-p">Welcome to Lost & Found, your trusted partner in reuniting lost items with their rightful owners. Our
                    mission is simple: to help people find what they've lost and to ensure that lost items are safely
                    returned.</p>
            </div>
            <div class="sub-content">
                <h3 class="post-title">Our Story</h3>
                <p class="content-p">Founded in 2024, Lost & Found was born out of a desire to address the growing need for a centralized
                    and efficient system for lost and found items. Our team is dedicated to creating a user-friendly
                    platform where individuals can report lost items, search for found items, and connect with others to
                    recover their possessions.</p>
            </div>
            <div class="sub-content">
                <h3 class="post-title">Our Mission</h3>
                <p class="content-p">At Lost & Found, our goal is to make the process of finding lost items as smooth and stress-free as
                    possible. We understand how important personal belongings can be, and we're committed to providing a
                    reliable service that maximizes the chances of recovery. Our platform offers a comprehensive
                    database where users can report lost items, browse found items, and receive updates on their
                    inquiries.</p>
            </div>
        </div>

        <div class="semi-container">
            <h2 class="content-header">How It Works</h2>
            <div class="about-container">
                <div class="card">
                    <img src="../public/report.avif" class='card-img' alt="Fast and Easy">
                    <h3 class='post-title'>Report an Item</h3>
                    <p class='card-description'>Submit details about your lost or found item in just a few clicks.</p>
                </div>
                <div class="card">
                    <img src="../public/match.avif" class='card-img' alt="Fast and Easy">
                    <h3 class='post-title'>Match with the Right Owner</h3>
                    <p class='card-description'>Our system connects you with those who reported matching lost or found items.</p>
                </div>
                <div class="card">
                    <img src="../public/give.avif" class='card-img' alt="Fast and Easy">
                    <h3 class='post-title'>Get/Give Item Back</h3>
                    <p class='card-description'>Once matched, coordinate securely to return or claim the item.</p>
                </div>
            </div>
        </div>


        <div class="semi-container">
            <h2 class="content-header">Why Use Our System?</h2>
            <div class="about-container">
                <div class="card">
                    <img src="../public/fast&easy.avif" class='card-img' alt="Fast and Easy">
                    <h3 class='post-title'>Fast and Easy</h3>
                    <p class='card-description'>Report lost or found items with just a few details.</p>
                </div>
                <div class="card">
                    <img src="../public/secure.avif" class='card-img' alt="Secure">
                    <h3 class='post-title'>Secure</h3>
                    <p class='card-description'>Your information is kept safe while we help connect you with others.</p>
                </div>
                <div class="card">
                    <img src="../public/reliable.avif" class='card-img' alt="Reliable Matching">
                    <h3 class='post-title'>Reliable Matching</h3>
                    <p class='card-description'>Our matching system ensures you find the right person.</p>
                </div>
            </div>
        </div>
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