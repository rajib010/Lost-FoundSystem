<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn more about our team and mission.">
    <title>About Us</title>
    <link rel="stylesheet" href="../index.css" />
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
        <div class="allContent-div">
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