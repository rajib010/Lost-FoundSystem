<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/components/Navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav class="nav-bar">
        <div class="logo-div">
            <div class="img-div"><img src="../public/logo.svg" alt="logo"></div>
            <h1><a href="../pages/index.php">lost&found</a></h1>
        </div>
        <ul class="list-items">
            <li><a href="../pages/ViewPosts.php">Post</a></li>
            <li><a href="../pages/About.php">About</a></li>
            <li><a href="../pages/Contact.php">Contact</a></li>
            <li><a href="../pages/CreateReview.php">Reviews</a></li>
            <li><button class="loginButton"><a href="../pages/Signup.php">Join now</a></button></li>
        </ul>

        <div class="theme-switch-wrapper">
            <label class="theme-switch">
                <input type="checkbox" id="theme-toggle">
                <span class="slider round"></span>
            </label>
        </div>

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

        // Theme toggle functionality
        document.getElementById('theme-toggle').addEventListener('change', function () {
            if (this.checked) {
                document.body.classList.add('dark-mode');
            } else {
                document.body.classList.remove('dark-mode');
            }
        });
    </script>
</body>

</html>
