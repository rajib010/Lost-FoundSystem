<?php require("./components/Header.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Users</title>
    <style>
        .admin-dashboard {
            padding: 0px;
            display: flex;
        }

        .container {
            width: 90%;
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
        <?php
        require("./components/Nav.php");
        require("./utility/navigate.php");
        ?>

        <div class="container">
            <h1>Manage Users</h1>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
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
                    $table = 'user_info';
                    $result = $db->select($table, '*', null, null, null, null);
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
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