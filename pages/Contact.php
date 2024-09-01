<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta description="" content="Our contact information and links.">
    <title>Contact</title>
    <style>
        main {
            width: 95%;
            margin: 0 auto;
            background-image: url(../public/bg\ img.jfif);
            background-size: cover;
            background-position: center;
            position: relative;
            padding: 1vw;
        }

        main::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(64, 61, 61, 0.6);
            z-index: 1;
        }

        .allContent-div {
            width: 95%;
            margin: auto;
            min-height: 90vh;
            display: flex;
            flex-direction: column;
            gap: 1vw;
            position: relative;
            z-index: 2;
            color: white;
        }

        .top-div {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 100%;
        }

        .top-div>h1 {
            width: 40%;
            font-size: 6vw;
            text-align: left;
            color: white;
            margin: 0;
        }

        .logo-img {
            width: 40%;
            display: flex;
            margin: auto;
            justify-content: flex-end;
        }

        .logo-img>img {
            width: 8vw;
            height: auto;
        }

        .main-content {
            width: 90%;
            margin: auto;
            padding: 2vw;
            display: flex;
            flex-direction: column;
            background: rgba(169, 166, 166, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 10px;
        }

        .main-content>.contents {
            line-height: 1.5;
            font-size: 2rem;
            color: white;
        }

        .contents > span{
            font-size: 2vw;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .top-div>h1 {
                font-size: 6vw;
            }

            .logo-img>img {
                width: 100px;
            }
        }
    </style>
</head>

<body>
    <?php
    if (file_exists("../components/Navbar.php")) {
        require("../components/Navbar.php");
    } else {
        echo "<div> Navbar cannot be loaded </div>";
    }
    ?>

    <main>
        <div class="allContent-div">
            <div class="top-div">
                <h1> Contact Us</h1>
                <div class="logo-img">
                    <img src="../public/logo.svg" alt="Logo">
                </div>
            </div>
            <div class="main-content">
                <p class="contents">If you need assistance with a lost item, have found something, or simply have
                    questions about our services, we're here to help. Please use the contact details below to get in
                    touch with us. We'll do our best to respond as quickly as possible.</p>
                <p class="contents">Email : <span>lostfound.support@gmail.com</span></p>
                <p class="contents">Telephone: <span>01- xxxxxx</span></p>
                <p class="contents">Address: <span> Panga-03 Kirtipur, Nepal</span></p>
            </div>
        </div>
    </main>


    <?php
    if(file_exists("../components/Footer.php")){
        require("../components/Footer.php");
    }else{
        echo "<div> Footer cannot be loaded </div>";
    }
    ?>

</body>

</html>