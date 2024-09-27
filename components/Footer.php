<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/index.css">
    <style>
        footer {
            width: 100%;
            margin: auto;
            min-height: 14vw;
            background-color: black;
            color: white;
            padding: 2vw;
            display: flex;
            flex-direction: column;
            gap: 1vw;
        }

        .main-div {
            width: 95%;
            margin: auto;
            display: flex;
            justify-content: space-between;
            gap: 2vw;
            align-items: center;
        }

        .right-div,
        .left-div {
            display: flex;
            flex-direction: column;
            gap: 2vw;
        }

        .right-div {
            width: 40%;
            font-size: 1.6rem;
        }

        .left-div {
            width: 60%;
            align-items: center;
            padding: 1vw 0;
        }

        .social-div {
            display: flex;
            min-width: 40%;
            margin-left: auto;
            justify-content: space-between;
            gap: 1vw;
            padding: 0 1vw;
            font-size: 1.6rem;
        }

        .links-div {
            width: 100%;
            padding: 0 2vw;
            display: flex;
            flex-direction: column;
            gap: 2vw;
        }

        .sub-links {
            display: flex;
            justify-content: flex-start;
            list-style: none;
            gap: 10vw;
        }

        .copyright {
            text-align: center;
            font-size: smaller;
            margin: auto;
        }

        /* Tablet view */
        @media (max-width: 1024px) {
            .main-div {
                flex-direction: column;
            }

            .right-div,
            .left-div {
                width: 100%;
                font-size: 1.2rem;
            }

            .social-div {
                width: 60%;
                margin: auto;
                font-size: 1.2rem;
            }

            .sub-links {
                justify-content: center;
                width: 100%;
                gap: 1.5vw;
            }
        }

        /* Mobile view */
        @media (max-width: 767px) {
            .main-div {
                flex-direction: column-reverse;
            }

            .right-div {
                width: 100%;
                font-size: 1rem;
                align-items: center;
            }

            .social-div {
                width: 70%;
                justify-content: space-between;
                font-size: 1rem;
            }
            .links-div{
                width: 100%;
            }

            .sub-links {
                width: 100%;
                justify-content: space-around;
                margin-bottom: 3vw;
            }
        }
    </style>
</head>
<footer>
    <div class="main-div">
        <div class="right-div">
            <p class="nav-text">For more info</p>
            <p class="nav-text">Send a mail at: finderz@gmail.com</p>
            <p class="nav-text">Toll free number: +977 98xxxxxxxx</p>
        </div>
        <div class="left-div">
            <div class="social-div">
                <p class="nav-text">Connect Us</p>
                <p><i class="fa-brands fa-github"></i></p>
                <p><i class="fa-brands fa-linkedin"></i></p>
                <p><i class="fa-brands fa-square-x-twitter"></i></p>
                <p><i class="fa-brands fa-facebook"></i></p>
            </div>
            <div class="links-div">
                <ul class="sub-links">
                    <li class="nav-text"><a href="">Privacy</a></li>
                    <li class="nav-text"><a href="">Help</a></li>
                    <li class="nav-text"><a href="./about.php">About</a></li>
                </ul>
                <ul class="sub-links">
                    <li class="nav-text"><a href="./contact.php">Contact</a></li>
                    <li class="nav-text"><a href="">Profile</a></li>
                    <li class="nav-text"><a href="../logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <p class="copyright">@2024 Lost & Found. All rights reserved.</p>
</footer>


</html>