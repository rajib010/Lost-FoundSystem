<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        * {
            box-sizing: border-box;
        }

        .nav-bar {
            width: 95%;
            margin: 1vw auto;
            height: 7vw;
            background-color: #3EA048;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2vw;
            border-radius: vw;
            color: white;
            font-weight: bolder;
            position: relative;
            z-index: 10;
        }

        .logo-div {
            display: flex;
            align-items: center;
            gap: 1vw;
            margin-left: 7vw;
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
            width: 65%;
            line-height: 10vw;
            justify-content: space-between;
            margin-left: auto;
            list-style: none;
            font-size: 1.4rem;
            padding-right: 2vw;
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
        }

        .user-info>img {
            border-radius: 100%;
            width: 100%;
            height: fit-content;
        }

        .logoutBtn {
            display: none;
            position: absolute;
            top: 5vw;
            right: 1.5rem;
            transform: translateX(-50%);
            background-color: #F38402;
            color: white;
            border: none;
            border-radius: 1vw;
            padding: 0.5rem 1rem;
            cursor: pointer;
        }

        .user-info:hover .logoutBtn {
            display: block;
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

            .logoutBtn {
                margin-left: 10vw;
                padding: 1vw;
                right: 1vw;
                top: 5vw;
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
                right: 1vw;
                width: 90vw;
                padding: 1vw;
                border-bottom-left-radius: 5vw;
                border-bottom-right-radius: 5vw;
                gap: 4vw;
                z-index: 9;
            }

            .list-items li {
                border-bottom: 1px solid white;
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
                margin-left: 38vw;
                margin-top: -2vw;
            }

            .user-info .logoutBtn {
                display: none;
                position: relative;
                padding: 2vw;
               top: 1vw;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav class="nav-bar">
        <div class="logo-div">
            <div class="img-div"><img src="../public/logo.svg" alt="logo"></div>
            <h1>lost&found</h1>
        </div>
        <ul class="list-items">
            <li>Post</li>
            <li>About</li>
            <li>Contact</li>
            <li>Reviews</li>
            <li>*</li>
            <li><button class="loginButton">Join now</button></li>
            <!-- <li>
                <div class="user-info">
                    <img src="https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_1280.png" class="user-image" alt="">
                    <button class="logoutBtn">Logout</button>
                </div>
            </li> -->
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
    </script>
</body>

</html>