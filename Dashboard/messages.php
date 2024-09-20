<?php require("./components/Header.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Messages</title>
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

        button.delete-btn:hover {
            background-color: #c0392b;
        }
    </style>
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
