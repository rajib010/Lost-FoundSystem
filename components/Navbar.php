<?php
session_start();
include "../utility/Database.php";
$db = new Database();
if (empty($_SESSION['loggedinuserId'])) {
    header('location: ./Login.php');
} else {

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            h1>a {
                text-decoration: none;
                color: white;
            }

            .nav-bar {
                max-width: 100%;
                height: 7vw;
                background-color: #ff5722;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0 2vw;
                color: white;
                font-weight: bolder;
                position: relative;
                z-index: 10;
            }

            .logo-div {
                display: flex;
                align-items: center;
                gap: 1vw;
                margin-left: 1%;
            }

            .img-div {
                width: 5rem;
                background-color: #C5BBBB;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 1rem;
                padding: 0.5rem;
            }

            .img-div img {
                max-width: 100%;
                height: auto;
            }

            .list-items {
                display: flex;
                width: 55%;
                line-height: 10vw;
                justify-content: space-between;
                margin-left: auto;
                list-style: none;
                font-size: 1.4rem;
                padding-right: 2vw;
            }

            .list-items>li>a {
                font-family: Georgia, 'Times New Roman', Times, serif;
                text-decoration: none;
                color: white;
                font-size: 1.3vw;
            }

            .list-items>li>a:hover {
                font-size: 1.4vw;
                color: gold;
            }

            .loginButton {
                width: 7vw;
                height: 3rem;
                margin: 2vw auto;
                border-radius: 1vw;
                background-color: #F38402;
                cursor: pointer;
                color: white;
                display: block;
                margin-top: 3vw;
            }

            .user-info {
                width: 6vw;
                height: 7vw;
                padding-top: 2vw;
                display: block;
                position: relative;
            }

            .user-info>img {
                border-radius: 100%;
                width: 100%;
                height: fit-content;
                cursor: pointer;
            }

            .user-info:hover .dropdown-menu {
                display: flex;
            }

            .dropdown-menu {
                position: absolute;
                min-height: 5vw;
                width: 10vw;
                top: 110%;
                right: -2vw;
                background-color: #ff5722;
                text-align: center;
                padding: 1vw;
                border-radius: 5px;
                line-height: 3vw;
                display: none;
                flex-direction: column;
                gap: 0.5vw;

            }

            .dropdown-menu li {
                width: 100%;
                border-bottom: 1px solid white;
                box-shadow: #C5BBBB;
                border-radius: 10px;
                cursor: pointer;
            }

            .dropdown-menu>li>a, .logoutItem {
                text-decoration: none;
                width: 100%;
                color: white;
                font-size: 1.3vw;
            }

            .dropdown-menu>li>a>i {
                margin-left: 0.5vw;
            }

            .bar-icons {
                display: none;
            }

            .bar-button {
                width: 4rem;
                height: 2rem;
                border-radius: 0.2rem;
            }

            /* for tablets */
            @media (min-width:768px)and (max-width:1024px) {
                .nav-bar {
                    height: 9vw;
                }

                .img-div {
                    height: 7vw;
                }

                .img-div img {
                    width: 80%;
                }

                .logo-div h1 {
                    font-size: 2.4vw;
                }

                .list-items li {
                    font-size: 1.1rem;
                }

                .loginButton {
                    width: 9vw;
                    height: 2rem;
                }

                .dropdown-menu {
                    min-width: 12vw;
                }
            }

            /* for mobile devices */
            @media(max-width: 767px) {
                .nav-bar {
                    height: 14vw;
                    padding: 0px 4vw;
                    z-index: 10;
                }

                .img-div {
                    height: 9vw;
                }

                .img-div img {
                    width: 70%;
                }

                .logo-div h1 {
                    font-size: 1.4rem;
                }

                .list-items {
                    display: none;
                    flex-direction: column;
                    text-align: center;
                    background-color: slategray;
                    position: absolute;
                    top: 14.2vw;
                    right: 0.5vw;
                    width: 100vw;
                    padding: 1vw;
                    border-bottom-left-radius: 5vw;
                    border-bottom-right-radius: 5vw;
                    gap: 4vw;
                    z-index: 9;
                }

                .list-items li {
                    border-bottom: 1px solid white;
                }

                .list-items li a {
                    font-size: 3.5vw;
                }

                .show-items {
                    display: flex;
                }

                .loginButton {
                    display: block;
                    margin: -3.5vw auto 0px;
                    width: 19vw;
                }

                .user-info {
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    padding: 6vw 0px;
                    width: 100%;
                }

                .user-info>img {
                    width: 10vw;
                    margin-left: 44vw;
                    margin-top: -2vw;
                }

                .user-info>.dropdown-menu {
                    position: relative;
                    width: 20vw;
                    height: 17vw;
                    top: -1.5vw;
                    gap: 2.3vw;
                    border-radius: 0.5vw;
                    left: 15%;
                    transform: translateX(-50%);
                }

                .dropdown-menu>li {
                    list-style: none;
                }

                .dropdown-menu>li>a {

                    list-style: none;
                }

                .bar-icons {
                    display: block;
                }

                .bar-button {
                    height: 3rem;
                    background-color: #C5BBBB;
                    border-radius: 0.4rem;
                    cursor: pointer;
                }

                .bar-button i {
                    font-size: xx-large;
                }
            }
        </style>
    </head>

    <body>
        <nav class="nav-bar">
            <div class="logo-div">
                <div class="img-div"><img src="../public/logo.svg" alt="logo"></div>
                <h1><a href="../pages/index.php">Home</a></h1>
            </div>
            <ul class="list-items">
                <li><a href="../pages/ViewPosts.php">Post</a></li>
                <li><a href="../pages/About.php">About</a></li>
                <li><a href="../pages/Contact.php">Contact</a></li>
                <li><a href="../pages/CreateReview.php">Reviews</a></li>
                <!-- <li><button class="loginButton"><a href="../pages/Signup.php">Join now</a></button></li> -->
                <li>
                    <div class="user-info">
                        <img src="<?php echo 'http://localhost/finderz/uploads/user/' . $_SESSION['userImg'] ?>" class="user-image" alt="User Image">
                        <ul class="dropdown-menu">
                            <li><a href="">View <i class="fa-solid fa-user"></i></a></li>
                            <li><a href="">Edit<i class="fa-solid fa-pen"></i> </a></li>
                            <li class="logoutItem">Logout<i class="fa-solid fa-right-from-bracket"></i></li>
                        </ul>
                    </div>
                </li>
            </ul>

            <div class="bar-icons">
                <button class="bar-button">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </nav>

        <script>
            document.querySelector(".bar-button").addEventListener("click", function() {
                document.querySelector("ul.list-items").classList.toggle("show-items");
            });

            document.querySelector(".logoutItem").addEventListener('click', function() {
                let userResponse = confirm("Do you want to logout?");
                if (userResponse) {
                    window.location.href('../logout.php');
                }
            })
        </script>
    </body>

    </html>

<?php
}

?>