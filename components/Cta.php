<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        * {
            box-sizing: border-box;
            margin: 0px;
            padding: 0px;
        }

        .cta-section {
            text-align: center;
            background-color: white;
            margin: 4vw auto;
            padding: 3vw 0vw;
            border-radius: 1vw;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .cta-section h1 {
            font-size: 2em;
            margin-bottom: 2vw;
            font-weight: bold;
            color: #ff5722;
        }

        .cta-section p {
            font-size: 1.2em;
            margin-bottom: 2vw;
            color: #666;
        }

        .cta-button {
            height: 6vw;
            width: 15vw;
            padding: 1vw 2vw;
            background-color: #FF8C00;
            color: white;
            text-decoration: none;
            border-radius: 4.6vw;
            font-size: 1.2em;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #e07c00;
        }

        /* for mobile devices */
        @media (max-width: 767px) {
            .cta-section>h1 {
                font-size: 4.5vw;
            }

            .cta-section>p {
                font-size: 2.6vw;
                margin-bottom: 5vw;
            }

            .cta-button {
                height: 12vw;
                padding: 2vw 3vw;
            }

            .cta-section>a {
                font-size: 3vw;
            }
        }
    </style>
</head>

<body>
    <section class="cta-section">
        <h1>Join The Lost & Found Revolution!</h1>
        <p>Sign up today and start finding your lost treasures!</p>
        <a href="../pages/Signup.php" class="cta-button">Get Started Now</a>
    </section>
</body>

</html>