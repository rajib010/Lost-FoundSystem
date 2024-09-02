<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta description="" content="Our contact information and links.">
    <title>Contact</title>
    <link rel="stylesheet" href="../styles/pages/Contact.css"/>

    
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