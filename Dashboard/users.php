<?php require("./components/Header.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Users</title>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $db = new Database();
                    $i = 0;
                    $table = 'user_info';
                    $result = $db->select($table, '*', null, null, null, null);
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['address']) ?></td>
                                <td><?= htmlspecialchars($row['phone_number']) ?></td>
                                <td><?= htmlspecialchars($row['user_type'] == 0 ? 'User' : 'Admin') ?></td>
                                <td>
                                    <button class="delete-btn" onclick="navigate(<?= htmlspecialchars($row['id']) ?>, '<?= htmlspecialchars($table) ?>')">Delete</button>
                                    <button class="edit-btn">Edit</button>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='7'>No users found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>