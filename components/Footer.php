<?php require_once('../utility/CheckSession.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../index.css">
    <style>
        /* Footer */
        .footer {
            background-color: black;
            color: #fff;
            padding: 40px 10%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .footer-items {
            list-style: none;
        }

        .footer-section {
            flex: 1 1 200px;
            margin: 10px;
        }

        .footer-section>.post-title {
            color: white;
            margin-bottom: 15px;
        }


        .footer-section>.footer-items {
            flex-direction: column;
            gap: 10px;
            line-height: 2vw;
        }

        .footer-section .nav-text:hover {
            color: transparent;
            background: linear-gradient(90deg, #3a7bd5, #00d2ff);
            -webkit-background-clip: text;
            background-clip: text;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }


        .footer .footer-bottom {
            text-align: center;
            width: 100%;
            margin-top: 20px;
            font-size: 14px;
            border-top: 1px solid #444;
            padding-top: 20px;
        }

        @media (min-width: 768px) and (max-width: 1024px) {
            .footer-section>.footer-items {
                line-height: 2vw;
            }
        }

        @media (max-width: 768px) {
            .footer-section>.footer-items {
                line-height: 5vw;
            }

        }
    </style>
</head>
<footer class="footer">
    <div class="footer-section">
        <h3 class="post-title">Lost & Found</h3>
        <p class="content-p">Your trusted platform to recover lost items or return found ones.</p>
    </div>
    <div class="footer-section">
        <h3 class="post-title">Quick Links</h3>
        <ul class="footer-items">
            <li><a href="../pages/home.php" class="nav-text">Home</a></li>
            <li><a href="../pages/about.php" class="nav-text">About Us</a></li>
            <li><a href="#faqs" class="nav-text">How It Works</a></li>
            <li><a href="../pages/contact.php" class="nav-text">Contact Us</a></li>
        </ul>
    </div>
    <div class="footer-section">
        <h3 class="post-title">Legal</h3>
        <ul class="footer-items">
            <li><a href="#" class="nav-text">Terms of Service</a></li>
            <li><a href="#" class="nav-text">Privacy Policy</a></li>
        </ul>
    </div>
    <div class="footer-section">
        <h3 class="post-title">Follow Us</h3>
        <ul class="footer-items">
                <li><a href="https://www.facebook.com" target="_blank" class="nav-text">Facebook</a></li>
                <li><a href="https://www.twitter.com" target="_blank" class="nav-text">Twitter</a></li>
                <li><a href="https://www.instagram.com" target="_blank" class="nav-text">Instagram</a></li>
            </ul>
    </div>
    <div class="footer-bottom">
        © 2024 Lost & Found System. All rights reserved.
    </div>
</footer>


</html>