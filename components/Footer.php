<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        footer {
            width: 95%;
            margin: auto;
            margin-top: 0px;
            min-height: 14vw;
            background-color: black;
            color: white;
            padding: 2vw;
            display: flex;
            flex-direction: column;
            gap: 1vw;
            margin-top: 1vw;
        }

        .main-div {
            width: 100%;
            display: flex;
            justify-content: space-between;
            gap: 2vw;
            align-items: center;
        }

        .right-div {
            width: 40%;
            display: flex;
            flex-direction: column;
            gap: 2vw;
            font-size: 1.6rem;
        }

        .left-div {
            width: 60%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 2vw;
            align-items: center;
            padding: 1vw 0;
        }

        .social-div {
            display: flex;
            min-width: 40%;
            margin-left: auto;
            justify-content: space-between;
            padding: 0 1vw;
            font-size: 1.6rem;
        }

        .social-div>p>i {
            cursor: pointer;
        }

        .small {
            font-size: smaller;
        }

        .links-div {
            width: 100%;
            padding: 0 2vw;
            display: flex;
            flex-direction: column;
            gap: 2vw;
            justify-content: flex-end;
        }

        .sub-links {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            gap: 2vw;
        }

        .sub-links>li {
            width: 30%;
            list-style: none;
            margin: 0 0 1vw 0;
            cursor: pointer;
            font-size: 1.4rem;
        }

        .sub-links>li:hover {
            text-decoration: underline;
        }

        .copyright {
            text-align: center;
            font-size: smaller;
            margin: auto;
        }

        /* for screen width between 768px and 1024px */
        @media (min-width: 768px) and (max-width: 1024px) {
            .main-div {
                flex-direction: column;
            }

            .right-div {
                width: 100%;
                font-size: 1.2rem;
                align-items: center;
            }

            .left-div {
                width: 100%;
                align-items: flex-start;
                padding: 1vw 0;
            }

            .social-div {
                width: 100%;
                justify-content: space-around;
                margin-top: 1vw;
                font-size: 1.2rem;
            }

            .links-div {
                width: 100%;
            }

            .sub-links {
                justify-content: center;
                width: 100%;
                gap: 1.5vw;
            }

            .sub-links>li {
                width: auto;
                margin: 0;
                font-size: 1.2rem;
            }
        }

        /* for mobile screens */
        @media (max-width: 767px) {
            .main-div {
                flex-direction: column;
            }

            .right-div {
                width: 100%;
                font-size: 1rem;
                align-items: center;
            }

            .social-div {
                width: 100%;
                justify-content: space-between;
                margin-top: 1vw;
                font-size: 1rem;
            }

            .links-div {
                width: 100%;
            }

            .sub-links {
                justify-content: center;
                width: 100%;
                gap: 1vw;
            }

            .sub-links>li {
                width: 30%;
                margin: 0;
                font-size: 1rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <footer>
        <div class="main-div">
            <div class="right-div">
                <p>For more info</p>
                <p>Send a mail at: finderz@gmail.com</p>
                <p>Toll free number: +977 98xxxxxxxx</p>
            </div>
            <div class="left-div">
                <div class="social-div">
                    <p class="small">social links</p>
                    <p><i class="fa-brands fa-github"></i></p>
                    <p><i class="fa-brands fa-linkedin"></i></p>
                    <p><i class="fa-brands fa-square-x-twitter"></i></p>
                    <p><i class="fa-brands fa-facebook"></i></p>
                </div>
                <div class="links-div">
                    <ul class="sub-links">
                        <li>Privacy</li>
                        <li>Help</li>
                        <li>About</li>
                    </ul>
                    <ul class="sub-links">
                        <li>Contact</li>
                        <li>Reviews</li>
                        <li>Logout</li>
                    </ul>
                </div>
            </div>
        </div>
        <p class="copyright">@2024 Lost & Found. All rights reserved.</p>
    </footer>
</body>

</html>
