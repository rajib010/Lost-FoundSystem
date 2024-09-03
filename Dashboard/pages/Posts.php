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
            <h1>Manage Posts</h1>
            <table>
                <thead>
                    <tr>
                        <th>Sn</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Author</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                    <tr>
                        <td>001</td>
                        <td>Lostitemfound</td>
                        <td>this is the message</td>
                        <td>rajib</td>
                        <td>Yes</td>

                        <td><button class="delete-btn">Delete</button></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
</body>

</html>