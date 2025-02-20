<?php
require("../utility/Database.php");
?>
<html>

<head>
    <style>
        * {
            box-sizing: border-box;
            margin: 0px;
            padding: 0px;
        }

        a {
            text-decoration: none;
            color: white;
        }

        .admin-nav {
            width: 20%;
            min-height: 100vh;
            background-color: #1976d2;
            margin-top: 7vw;
            border-radius: 0px;
            padding: 2vw;
            position: fixed;
        }

        .admin-nav>ul {
            list-style-type: none;
            padding: 0;
        }

        .nav-btn {
            width: 100%;
            background-color: #2196f3;
            border: none;
            padding: 15px;
            border-radius: 5px;
            color: white;
            font-size: 1em;
            font-weight: bold;
            margin-bottom: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: flex-start;
        }

        .nav-btn:hover {
            background-color: #1976d2;
        }

        i {
            color: white;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav class="admin-nav">
        <ul>
            <li><button class="nav-btn"><a href="./index.php">
                        Dashboard
                        <i class="fa-solid fa-house"></i>
                    </a></button></li>
            <li><button class="nav-btn"><a href="./users.php">
                        Show all users
                        <i class="fa-solid fa-user"></i>
                    </a></button></li>
            <li><button class="nav-btn"><a href="./posts.php">
                        View all posts
                        <i class="fa-sharp fa-solid fa-envelopes-bulk"></i>
                    </a></button></li>
            <li><button class="nav-btn"><a href="./reviews.php">
                        View Reviews
                        <i class="fa-solid fa-star"></i>
                    </a></button></li>
            <li><button class="nav-btn"><a href="./messages.php">
                        View Messages
                        <i class="fa-solid fa-message"></i>
                    </a></button></li>
        </ul>
    </nav>
</body>

</html>