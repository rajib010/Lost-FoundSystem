<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta description="" content="Our contact information and links.">
    <title>Contact</title>
    <link rel="stylesheet" href="../Contact.css">
    <style>
        .post-title {
            margin-bottom: 8px;
        }
    </style>
</head>

<body>
    <?php
    require("../Navbar.php");
    ?>

    <section class="contact-section">
        <h1 class="content-header">Contact Us</h1>
        <div class="allContent-div">
            <div class="sub-content">
                <h3 class="post-title">Contact Information</h3>
                <p class="content-p">If you need assistance with a lost item, have found something, or simply have questions about our
                    services, we're here to help. Please use the contact details below to get in touch with us. We'll do
                    our best to respond as quickly as possible.</p> <br>
                <p class="content-p">Email: <span class="bold">lostfound.support@gmail.com</span></p> <br>
                <p class="content-p">Telephone: <span class="bold">01-xxxxxx</span></p> <br>
                <p class="content-p">Address: <span class="bold">Panga-03 Kirtipur, Nepal</span></p> <br>
            </div>

            <div class="sub-content">
                <h3 class="post-title">Send Us a Message</h3>
                <form class="form-class" id="contactForm" method="post">
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
                    <button type="submit" class="btn" name="sendBtn">Send Message</button>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('contactForm').addEventListener('submit', async function(event) {
                            event.preventDefault();
                            let formData = new FormData(this);
                            await fetch('../utility/SendMessage.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        alert(data.message);
                                        document.getElementById('contactForm').reset();
                                        window.location.reload();
                                        window.scrollTo(0, 0);
                                    } else {
                                        alert(data.message);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('There was an error submitting your message. Please try again.');
                                });
                        });
                    });
                </script>
            </div>

            <div class="sub-content map-div">
                <h3 class="post-title">Find Us Here</h3> <br>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.413545795341!2d85.28867757486044!3d27.68644043077414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb199d1c254f09%3A0x4db0b5af7c8c69e4!2sPanga%2C%20Kirtipur%2044600!5e0!3m2!1sen!2snp!4v1693769251218!5m2!1sen!2snp"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <?php
    if (file_exists("../components/Footer.php")) {
        require("../components/Footer.php");
    } else {
        echo "<div> Footer cannot be loaded </div>";
    }
    ?>
</body>

</html>