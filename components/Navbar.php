<html>

<head>
    <style>
        * {
            box-sizing: border-box;
        }

        .nav-bar {
            width: 95vw;
            margin: auto;
            height: 7vw;
            background-color: #3EA048;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2vw;
            border-radius: 10vw;
        }

        .logo-div {
            display: flex;
            align-items: center;
            gap: 1vw;
        }

        .img-div {
            width: 5rem;
            background-color: slategrey;
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
            width: 35%;
            justify-content: space-between;
            margin: auto;
            list-style: none;
            font-size: 1.4rem;
        }

        .loginButton {
            width: 7vw;
            height: 3rem;
            margin: auto 0;
            border-radius: 1vw;
            background-color: #F38402;
            cursor: pointer;
            color: white;
            display: none;
        }

        .user-info {
            width: 6vw;
            height: fit-content;

        }

        .user-info>img {
            border-radius: 100%;
            width: 100%;
            height: fit-content;
        }

        .user-info>img :hover .logoutBtn {
            display: block;
        }

        .bar-icons {
            display: none;
        }

        .logoutBtn {
            display: none;
            position: absolute;
            right: 1.7rem;
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
    </style>
</head>

<body>
    <nav class="nav-bar">
        <div class="logo-div">
            <div class="img-div"><img src="../public/logo.svg" alt="logo"></div>
            <h1>lost&found</h1>
        </div>
        <ul class="list-items">
            <li>Post</li>
            <li>about</li>
            <li>contact</li>
            <li>Reviews</li>
            <li>*</li>
        </ul>
        <button class="loginButton">Join now</button>
        <div class="user-info">
            <img src="https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_1280.png" alt="">
            <button class="logOutBtn">Logout</button>
        </div>
        <div class="bar-icons">bars</div>
    </nav>
</body>

</html>