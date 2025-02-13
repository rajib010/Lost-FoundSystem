<?php
session_start();

if (isset($_SESSION['loggedinuserId'])) {
    if (file_exists('../pages/home.php')) {
        header('location: ../pages/home.php');
        exit();
    } else {
        header('location: ./pages/home.php');
        exit();
    }
}
session_write_close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found System</title>
    <link rel="stylesheet" href="./index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        img {
            z-index: 40;
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .error{
            margin: 5px 0px;
        }

        .btn {
            background: linear-gradient(90deg, #00d2ff, #3a7bd5);
        }

        .space {
            margin-top: 15px;
        }

        .top {
            width: 60%;
            margin: auto;
            margin-bottom: 15px;
        }

        .post-title {
            margin-bottom: 20px;
        }

        .post-description {
            line-height: 1.6;
        }

        footer {
            background-color: #1e1e1e;
            color: #fff;
            padding: 20px;
            text-align: center;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
            position: relative;
            bottom: 0;
            width: 100%;
            font-family: 'Roboto', sans-serif;
        }

        footer div {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        footer p {
            margin: 0;
            font-size: 14px;
            color: #bbb;
            letter-spacing: 0.5px;

            &:hover {
                color: #fff;
                transition: color 0.3s ease;
            }
        }
    </style>

</head>

<body>


    <nav class="nav-bar">
        <div class="logo-div">
            <a href="#">
                <img src="./public/logo.png" alt="logo" class="logo-img">
            </a>
        </div>
        <a href="./user/login.php" class="btn">Login</a>
    </nav>

    <!-- Hero Section -->
    <section class="home-section">
        <h1 class="content-header top">Lost Something? Found Something? We’ve Got You Covered!</h1>
        <p class=".content-p">Connect people with their lost or found items quickly and easily.</p>
        <button class="btn space">
            <a href="./user/signup.php">Get Started</a>
        </button>
    </section>

    <!-- How It Works Section -->
    <section class="home-section">
        <h2 class="content-header">How It Works</h2>
        <div class="about-container">
            <div class="card">
                <img src="./public/report.png" class='card-img' alt="Fast and Easy">
                <h3 class='post-title'>Report an Item</h3>
                <p class='card-description'>Submit details about your lost or found item in just a few clicks.</p>
            </div>
            <div class="card">
                <img src="./public/match.png" class='card-img' alt="Fast and Easy">
                <h3 class='post-title'>Match with the Right Owner</h3>
                <p class='card-description'>Our system connects you with those who reported matching lost or found items.</p>
            </div>
            <div class="card">
                <img src="./public/give.png" class='card-img' alt="Fast and Easy">
                <h3 class='post-title'>Get/Give Item Back</h3>
                <p class='card-description'>Once matched, coordinate securely to return or claim the item.</p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="home-section" id="requirement">
        <h2 class="content-header">Why Use Our System?</h2>
        <div class="about-container">
            <div class="card">
                <img src="./public/fast&easy.png" class='card-img' alt="Fast and Easy">
                <h3 class='post-title'>Fast and Easy</h3>
                <p class='card-description'>Report lost or found items with just a few details.</p>
            </div>
            <div class="card">
                <img src="./public/secure.png" class='card-img' alt="Secure">
                <h3 class='post-title'>Secure</h3>
                <p class='card-description'>Your information is kept safe while we help connect you with others.</p>
            </div>
            <div class="card">
                <img src="./public/reliable.png" class='card-img' alt="Reliable Matching">
                <h3 class='post-title'>Reliable Matching</h3>
                <p class='card-description'>Our matching system ensures you find the right person.</p>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="home-section" id="contact">
        <h2 class="content-header">Need Help?</h2>

        <form class="form-class" id="contactForm" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <p class="error" id="nameError"></p>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <p class="error" id="emailError"></p>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
                <p class="error" id="messageError"></p>
            </div>
            <button type="submit" class="btn" name="sendBtn">Send Message</button>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('contactForm').addEventListener('submit', async function(event) {
                    if (!validateForm()) {
                        event.preventDefault();
                        return;
                    }
                    event.preventDefault();
                    let formData = new FormData(this);
                    await fetch('./utility/SendMessage.php', {
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

            function validateForm() {
                let isValid = true;

                let messageError = document.getElementById('messageError');
                let nameError = document.getElementById('nameError');
                let emailError = document.getElementById('emailError');

                messageError.innerText = ''
                nameError.innerText = ''
                emailError.innerText = ''

                let message = document.getElementById('message').value.trim();
                let email = document.getElementById('email').value;
                let name = document.getElementById('name').value;

                const fullnamePattern = /^[A-Za-z]{3,} [A-Za-z]{3,}$/
                if (!fullnamePattern.test(name)) {
                    nameError.innerText = 'Enter a valid name';
                    isValid = false
                }

                const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (!emailPattern.test(email)) {
                    emailError.innerText = "Invalid email address";
                    isValid = false;
                }

                if (message.length < 5) {
                    messageError.innerText = 'Please enter a valid message';
                    isValid = false;
                }

                return isValid;
            }
        </script>
    </section>


    <footer>
        <div>
            <p>&copy; 2024 Lost & Found System. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>