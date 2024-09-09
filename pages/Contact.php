
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta description="" content="Our contact information and links.">
    <title>Contact</title>
    <link rel="stylesheet" href="../styles/Contact.css">
</head>

<body>
    <?php
    if (file_exists("../Navbar.php")) {
        require("../Navbar.php");
    } else {
        echo "<div> Navbar cannot be loaded </div>";
    }
    ?>

    <main>
        <h1 class="top-text">Contact Us</h1>
        <div class="allContent-div">
            <div class="sub-content">
                <h3>Contact Information</h3>
                <p>If you need assistance with a lost item, have found something, or simply have questions about our
                    services, we're here to help. Please use the contact details below to get in touch with us. We'll do
                    our best to respond as quickly as possible.</p>
                <p>Email: <span>lostfound.support@gmail.com</span></p>
                <p>Telephone: <span>01-xxxxxx</span></p>
                <p>Address: <span>Panga-03 Kirtipur, Nepal</span></p>
            </div>

            <div class="sub-content contact-form-div">
                <h3>Send Us a Message</h3>
                <form class="contact-form" action="#" method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
            </div>

            <div class="sub-content map-div">
                <h3>Find Us Here</h3>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.413545795341!2d85.28867757486044!3d27.68644043077414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb199d1c254f09%3A0x4db0b5af7c8c69e4!2sPanga%2C%20Kirtipur%2044600!5e0!3m2!1sen!2snp!4v1693769251218!5m2!1sen!2snp"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </main>

    <?php
    if (file_exists("../components/Footer.php")) {
        require("../components/Footer.php");
    } else {
        echo "<div> Footer cannot be loaded </div>";
    }
    ?>
</body>
</html>
