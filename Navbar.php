<?php
include_once "utility/Database.php";
ob_start();
session_start();
if (empty($_SESSION['loggedinuserId'])) {
    header('location: ../user/login.php');
    exit();
}
$db = new Database();
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./index.css" />
</head>

<body>
    <nav class="nav-bar">
        <div class="logo-div">
            <a href="../pages/home.php"><img src="../public/logo.svg" alt="logo" class="logo-img"></a>
        </div>
        <ul class="list-items">
            <li><a href="../post/viewposts.php" class='nav-text'>Post</a></li>
            <li><a href="../pages/about.php" class='nav-text'>About</a></li>
            <li><a href="../pages/contact.php" class='nav-text'>Contact</a></li>
            <li><a href="../reviews/createreview.php" class='nav-text'>Reviews</a></li>
            <li>
                <div class="user-info">
                    <img src="<?php echo 'http://localhost/finderz/uploads/user/' . $_SESSION['userImg'] ?>" class="user-image" alt="User Image">
                    <ul class="dropdown-menu">
                        <li><a href="../user/viewprofile.php" class="nav-text nav-nav-text">View</a></li>
                        <li><a href="../user/edituser.php" class="nav-text nav-nav-text">Edit </a></li>
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
                window.location.replace("../user/logout.php");
            }
        });
    </script>
</body>

</html>