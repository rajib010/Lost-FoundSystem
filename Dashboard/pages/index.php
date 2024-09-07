<?php
include "../../utility/Database.php";
session_start();
if (empty($_SESSION['loggedinadmin'])) {
    header('location: ../../pages/Login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <style>
        .admin-dashboard {
            display: flex;
        }

        .admin-stats {
            flex-grow: 1;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .stat-item {
            background-color: #e0e0e0;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .stat-item h3 {
            margin: 0 0 10px;
            color: #333;
            font-size: 1.2em;
        }

        .stat-item p {
            font-size: 1.5em;
            font-weight: bold;
            color: #ff5722;
        }
    </style>

</head>

<body>

    <?php require("../components/Header.php") ?>
    <main class="admin-dashboard">
        <?php require("../components/Nav.php") ?>

        <section class="admin-stats">
            <div class="stat-item">
                <h3>Total no of Posts:</h3>
                <p>xx</p>
            </div>
            <div class="stat-item">
                <h3>Total no of Users:</h3>
                <p>xx</p>
            </div>
            <div class="stat-item">
                <h3>Total Reviews Posted:</h3>
                <p>xx</p>
            </div>
            <div class="stat-item">
                <h3>Total Items Found:</h3>
                <p>xx</p>
            </div>
        </section>
    </main>
</body>

</html>