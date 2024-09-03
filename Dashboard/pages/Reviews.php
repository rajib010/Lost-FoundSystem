<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/tables.css">
</head>

<body>
    <header class="admin-header">
        <h1>Welcome, Admin</h1>
        <button class="logout-btn">Log out</button>
    </header>

    <main class="admin-dashboard">
        <?php require("../components/Nav.php") ?>

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