<html>
<head>
    <style>
        *{
            box-sizing: border-box;
            margin: 0px;
            padding: 0px;
        }
        a {
            text-decoration: none;
            color: white;
        }

        .admin-nav {
            width: 25%;
            background-color:#1976d2;
            border-radius: 0px;
            padding: 2vw;
            
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
        }

        .nav-btn:hover {
            background-color: #1976d2;
        }
    </style>
</head>

<body>
    <nav class="admin-nav">
        <ul>
            <li><button class="nav-btn"><a href="./Users.php">Show all users</a></button></li>
            <li><button class="nav-btn"><a href="./Posts.php">View all posts</a></button></li>
            <li><button class="nav-btn"><a href="./Mail.php">Send Mail</a></button></li>
            <li><button class="nav-btn"><a href="./Reviews.php">View Reviews</a></button></li>
            <li><button class="nav-btn"><a href="./Messages.php">View Messages</a></button></li>
        </ul>
    </nav>
</body>

</html>