<?php
session_start();
if(empty($_SESSION['loggedinadmin'])){
    header('location: ../index.php');
}
?>

<html>
<head>
    <style>

        *{
            box-sizing: border-box;
            margin: 0px;
            padding: 0px;
        }
         .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            height: 7vw;
            background-color: #ff5722;
            color: white;
        }

        .admin-header h1 {
            font-size: 1.8em;
            
        }

        .logout-btn {
            background-color: #ffc107;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1em;
            color: #333;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #ff9800;
        }
    </style>
</head>

    <header class="admin-header">
        <h1>Welcome, Admin</h1>
        <button class="logout-btn"><a href="../logout.php">Log out</a></button>
    </header>

</html>