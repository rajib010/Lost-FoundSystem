<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found System</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 10%;
            background-color: #f4f4f4;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .header .logo {
            font-size: 24px;
            font-weight: bold;
            color: #007BFF;
            text-decoration: none;
        }

        .header nav ul {
            list-style: none;
            display: flex;
        }

        .header nav ul li {
            margin-left: 20px;
        }

        .header nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .header nav ul li a:hover {
            color: #007BFF;
        }

        .header .login-btn {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .header .login-btn:hover {
            background-color: #0056b3;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: url('https://via.placeholder.com/1500x800') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-top: 80px; /* Height of header */
        }

        .hero::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 123, 255, 0.5);
        }

        .hero-content {
            position: relative;
            color: #fff;
            text-align: center;
            max-width: 800px;
            padding: 20px;
        }

        .hero-content h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .hero-content .cta-btn {
            padding: 15px 30px;
            background-color: #fff;
            color: #007BFF;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .hero-content .cta-btn:hover {
            background-color: #007BFF;
            color: #fff;
        }

        /* Sections */
        .section {
            padding: 60px 10%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section:nth-child(even) {
            background-color: #f9f9f9;
        }

        .section h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 32px;
            color: #007BFF;
        }

        .steps, .features, .testimonials, .contact {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .steps .step, .features .feature, .testimonials .testimonial {
            background-color: #fff;
            padding: 20px;
            margin: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }

        .steps .step img, .features .feature img {
            width: 60px;
            height: 60px;
            margin-bottom: 15px;
        }

        .testimonials .testimonial {
            max-width: 600px;
        }

        /* Contact Form */
        .contact form {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 600px;
        }

        .contact form input, .contact form textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .contact form button {
            padding: 12px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .contact form button:hover {
            background-color: #0056b3;
        }

      

        /* Responsive */
        @media (max-width: 768px) {
            .header nav ul {
                flex-direction: column;
                background-color: #f4f4f4;
                position: absolute;
                top: 70px;
                right: 10%;
                width: 200px;
                display: none;
            }

            .header nav ul.active {
                display: flex;
            }

            .header nav ul li {
                margin: 10px 0;
            }

            .header .menu-toggle {
                display: block;
                cursor: pointer;
                font-size: 24px;
            }

            .hero-content h1 {
                font-size: 32px;
            }

            .hero-content p {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

    <!-- Authentication Check (Server-Side) -->
    <!-- 
        Implement server-side logic here to check if the user is logged in.
        If the user is logged in, redirect them to the dashboard or another appropriate page.
        If not, render the landing page below.
    -->

    <!-- Header -->
    <header class="header">
        <a href="#" class="logo">Lost & Found</a>
        <nav>
            <ul id="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">How It Works</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
            <a href="login.html" class="login-btn">Login</a>
        </nav>
        <!-- Mobile Menu Toggle -->
        <div class="menu-toggle" id="mobile-menu">
            &#9776;
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Lost Something? Found Something? We’ve Got You Covered!</h1>
            <p>Connect people with their lost or found items quickly and easily.</p>
            <a href="login.html" class="cta-btn">Login to Report</a>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="section how-it-works">
        <h2>How It Works</h2>
        <div class="steps">
            <div class="step">
                <img src="https://via.placeholder.com/60" alt="Report an Item">
                <h3>Report an Item</h3>
                <p>Submit details about your lost or found item in just a few clicks.</p>
            </div>
            <div class="step">
                <img src="https://via.placeholder.com/60" alt="Match with the Right Owner">
                <h3>Match with the Right Owner</h3>
                <p>Our system connects you with those who reported matching lost or found items.</p>
            </div>
            <div class="step">
                <img src="https://via.placeholder.com/60" alt="Get Your Item Back">
                <h3>Get Your Item Back</h3>
                <p>Once matched, coordinate securely to return or claim the item.</p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section features">
        <h2>Why Use Our System?</h2>
        <div class="features">
            <div class="feature">
                <img src="https://via.placeholder.com/60" alt="Fast and Easy">
                <h3>Fast and Easy</h3>
                <p>Report lost or found items with just a few details.</p>
            </div>
            <div class="feature">
                <img src="https://via.placeholder.com/60" alt="Secure">
                <h3>Secure</h3>
                <p>Your information is kept safe while we help connect you with others.</p>
            </div>
            <div class="feature">
                <img src="https://via.placeholder.com/60" alt="Reliable Matching">
                <h3>Reliable Matching</h3>
                <p>Our matching system ensures you find the right person.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="section testimonials">
        <h2>Success Stories</h2>
        <div class="testimonials">
            <div class="testimonial">
                <p>"I lost my wallet during a trip, and thanks to this system, I got it back within a day! Highly recommend."</p>
                <h4>- Jane Doe</h4>
            </div>
            <div class="testimonial">
                <p>"Found a set of keys and used the platform to return them. The process was seamless."</p>
                <h4>- John Smith</h4>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="section contact">
        <h2>Need Help?</h2>
        <div class="contact">
            <form action="submit_contact_form" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    

    <!-- JavaScript for Mobile Menu Toggle -->
    <script>
        const menuToggle = document.getElementById('mobile-menu');
        const navLinks = document.getElementById('nav-links');

        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    </script>

</body>
</html>

