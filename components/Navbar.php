<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/Navbar.css">
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
            <li><button class="loginButton">Join now</button></li>
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
