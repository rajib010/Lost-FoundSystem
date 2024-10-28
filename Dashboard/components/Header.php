<?php
session_start();
if (empty($_SESSION['loggedinadmin'])) {
    header('location: ../user/login.php');
}
?>

<html>
<head>
    <link rel="stylesheet" href="../index.css" />
    <style>
        .admin-header {
            width: 100%;
            display: flex;
            position: fixed;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            height: 7vw;
            background-color: #ff5722;
            color: white;
        }
        h1{
            font-size: 2.1vw;
        }
    </style>
</head>

<header class="admin-header">
    <h1>Welcome, Admin</h1>
    <button class="btn logoutItem" id="cancelBtn">
        Log Out
    </button>
</header>

<body>
    <script>
        document.querySelector(".logoutItem").addEventListener('click', function() {
            let userResponse = confirm("Do you want to logout?");
            if (userResponse) {
                window.location.replace("../user/logout.php");
            }
        });
    </script>
</body>

</html>