<?php
include_once "utility/Database.php";
ob_start();
session_start();
if (empty($_SESSION['loggedinuserId'])) {
    header('location: ./index.php');
    exit();
}
$db = new Database();
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styles/index.css" />
    <style>
        .nav-bar {
            max-width: 100%;
            height: 7vw;
            background: linear-gradient(90deg, #3a7bd5, #00d2ff);
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
            margin-left: 5%;
        }

        .logo-img {
            width: 80%;
        }

        .list-items {
            display: flex;
            gap: 6vw;
            line-height: 10vw;
            left: 0px;
            justify-content: space-between;
            list-style: none;
            font-size: 1.4rem;
        }


        .user-info {
            max-width: 100px;
            height: 5vw;
            padding-top: 2vw;
            display: block;
            position: relative;

        }

        .user-image {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }

        .user-info:hover .dropdown-menu {
            display: flex;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            min-height: 5vw;
            min-width: 9vw;
            right: -20px;
            top: 150%;
            background: linear-gradient(90deg, #3a7bd5, #00d2ff);
            padding: 1vw;
            border-radius: 0.5vw;
            line-height: 2.5vw;
            list-style: none;
            flex-direction: column;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15);
            transition: box-shadow 0.3s ease-in-out, background-color 0.3s ease-in-out;
        }

        .dropdown-menu>li {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 100%;
            padding: 8px 12px;
            margin-bottom: 6px;
            text-align: center;
            border-radius: 0.4vw;
            border: none;
            box-shadow: inset 0px 0px 5px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            cursor: pointer;
        }

        .dropdown-menu>li:hover {
            background: linear-gradient(90deg, #3a7bd5, #00d2ff);
            box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .dropdown-menu>li>a>i {
            margin-left: 0.5vw;
            color: #555;
            /* Consistent icon color */
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

            .logo-img {
                width: 75%;
            }

            

            .user-image {
                width: 50px;
                height: 50px;
            }

            .dropdown-menu {
                right: -15px;
            }
        }

        /* for mobile devices */
        @media(max-width: 767px) {
            .nav-bar {
                height: 14vw;
                padding: 0px 4vw;
                z-index: 10;
            }

            .logo-img {
                width: 65%;
            }

            .list-items {
                display: none;
                flex-direction: column;
                text-align: center;
                background: linear-gradient(90deg, #81b3e8, #99ecff);
                position: absolute;
                top: 14.2vw;
                width: 100%;
                margin-bottom: 15px;
                cursor: pointer;
                border-radius: 5px;
                gap: 4vw;
                z-index: 9;
                transition: background-color 0.3s ease;
            }

            .list-items>li:hover {
                background-color: #3a7bd5;
            }

            .show-items {
                display: flex;
            }

            .user-info {
                display: flex;
                flex-direction: row;
                align-items: center;
                padding: 6vw 0px;
                width: 100%;
            }

            .user-image {
                margin-left: 43vw;
                width: 55px;
                height: 55px;
            }

            .dropdown-menu {
                width: 25vw;
                height: auto;
                top: -10vw;
                background-color: #81b3e8;
                border-radius: 0.8vw;
                left: 330%;
                padding: 2vw;
                transform: translateX(-50%);
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
                transition: box-shadow 0.3s ease-in-out;
            }

            .dropdown-menu>li {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                width: 100%;
                padding: 8px 10px;
                margin-bottom: 6px;
                text-align: center;
                border-radius: 0.5vw;
                border: none;
                background-color: #3a7bd5;
                box-shadow: inset 0px 0px 5px rgba(0, 0, 0, 0.1);
                transition: background-color 0.3s ease-in-out;
            }

            .dropdown-menu>li:hover {
                background-color: #3a7bd8;
                box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.2);
            }

            .dropdown-menu>li>a>i {
                margin-left: 0.5vw;
                color: #555;
            }


            .bar-icons {
                display: block;
            }

            .bar-button {
                height: 3rem;
                background: linear-gradient(90deg, #81b3e8, #99ecff);
                border-radius: 0.4rem;
                cursor: pointer;
            }

            .bar-button>i {
                font-size: xx-large;
            }
        }
    </style>
</head>

<body>
    <nav class="nav-bar">
        <div class="logo-div">
            <a href="../pages/home.php"><img src="../public/logo.svg" alt="logo" class="logo-img"></a>
        </div>
        <ul class="list-items">
            <li><a href="../post/viewpost.php" class='nav-text'>Post</a></li>
            <li><a href="../pages/about.php" class='nav-text'>About</a></li>
            <li><a href="../pages/contact.php" class='nav-text'>Contact</a></li>
            <li><a href="../reviews/createreview.php" class='nav-text'>Reviews</a></li>
            <li>
                <div class="user-info">
                    <img src="<?php echo 'http://localhost/finderz/uploads/user/' . $_SESSION['userImg'] ?>" class="user-image" alt="User Image">
                    <ul class="dropdown-menu">
                        <li><a href="" class="nav-text nav-nav-text">View</a></li>
                        <li><a href="" class="nav-text nav-nav-text">Edit </a></li>
                        <li class="logoutItem nav-text nav-nav-text">Logout</li>
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
                window.location.replace("../logout.php");
            }
        });
    </script>
</body>

</html>