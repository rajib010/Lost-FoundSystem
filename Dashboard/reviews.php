<?php require("./components/Header.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Reviews</title>
    <link rel="stylesheet" href="./index.css">
</head>

<body>

    <main class="admin-dashboard">
        <?php
        require("./components/Nav.php");
        require("./utility/navigate.php");
        ?>

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
                    <?php
                    $db = new Database();
                    $i=0;
                    $table = 'reviews';
                    $join ="join user_info on reviews.author_id=user_info.id";
                    $result = $db->select($table, "*", null, null, null, null);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><?= ?></td>
                                <td><?= $row['message']?></td>
                                

                                <td><button class="delete-btn">Delete</button></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
</body>

</html>