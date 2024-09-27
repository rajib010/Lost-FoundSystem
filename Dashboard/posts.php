<?php require("./components/Header.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Posts</title>
    <link rel="stylesheet" href="./index.css">
</head>

<body>
    <main class="admin-dashboard">
        <?php require("./components/Nav.php");
        require("./utility/navigate.php");
        ?>

        <div class="container">
            <h1>Manage Posts</h1>
            <table>
                <thead>
                    <tr>
                        <th>Sn</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Assuming $db is an instance of your Database class
                    // SELECT * from posts join user_info on user_info.id = posts.author_id;
                    $db = new Database();
                    $table = 'posts';
                    $i = 0;
                    $join = "user_info on user_info.id = posts.author_id";
                    $result = $db->select($table, "*", $join, null, null, null);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['title']) ?></td>
                                <td><?= htmlspecialchars($row['description']) ?></td>
                                <td><?= htmlspecialchars($row['location']) ?></td>
                                <td><img src="<?= 'http://localhost/finderz/uploads/posts/'.htmlspecialchars($row['image']) ?>" alt="image" class="image-item" /></td>
                                <td><?= htmlspecialchars($row['category']) ?></td>
                                <td><?= htmlspecialchars($row['status']==0?'notfound':'found') ?></td>
                                <td>
                                    <button class="delete-btn" onclick="navigate(<?= htmlspecialchars($row['id']) ?>, '<?= htmlspecialchars($table) ?>')">Delete</button>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='8'>No posts found.</td></tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
</body>

</html>