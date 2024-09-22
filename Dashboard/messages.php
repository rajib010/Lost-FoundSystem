<?php require("./components/Header.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Messages</title>
    <link rel="stylesheet" href="./index.css">
</head>

<body>

    <main class="admin-dashboard">
        <?php require("./components/Nav.php");
            require("./utility/navigate.php");
        ?>

        <div class="container">
            <h1>Manage Messages</h1>
            <table>
                <thead>
                    <tr>
                        <th>Sn</th>
                        <th>Name of Sender</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  
                    $db = new Database();
                    $table = 'messages';
                    $result = $db->select($table, '*', null, null, null, null);
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['message']) ?></td>
                                <td>
                                    <button class="delete-btn" onclick="navigate(<?= htmlspecialchars($row['id']) ?>, '<?= htmlspecialchars($table) ?>')">Delete</button>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>No messages found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        
</body>

</html>
