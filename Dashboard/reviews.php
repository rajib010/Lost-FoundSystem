<?php require("./components/Header.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Reviews</title>
    <link rel="stylesheet" href="./index.css">
    <style>
        .admin-dashboard {
            display: flex;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        button.delete-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        button.edit-btn {
            background-color: rgb(56, 56, 182);
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        button.delete-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>

    <main class="admin-dashboard">
        <?php require("./components/Nav.php") ?>

        <div class="container">
            <h1>Manage Users</h1>
            <table>
                <thead>
                    <tr>
                        <th>Sn</th>
                        <th>Name of Sender</th>
                        <th>Message</th>
                        <th>Satisfaction level</th>
                        <th>found?</th>
                        <th>Will recommend?</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>001</td>
                        <td>Rajib</td>
                        <td>this is the message</td>
                        <td>8</td>
                        <td>Yes</td>
                        <td>Yes</td>

                        <td><button class="delete-btn">Delete</button></td>
                    </tr>

                </tbody>
            </table>
        </div>
</body>

</html>