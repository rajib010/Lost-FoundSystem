<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>

<body>
    <header class="admin-header">
        <h1>Welcome, Admin</h1>
        <button class="logout-btn">Log out</button>
    </header>

    <main class="admin-dashboard">
        <?php require("../components/Nav.php") ?>

        <section class="admin-stats">
            <div class="stat-item">
                <h3>Total no of Posts:</h3>
                <p>xx</p>
            </div>
            <div class="stat-item">
                <h3>Total no of Users:</h3>
                <p>xx</p>
            </div>
            <div class="stat-item">
                <h3>Total Reviews Posted:</h3>
                <p>xx</p>
            </div>
            <div class="stat-item">
                <h3>Total Items Found:</h3>
                <p>xx</p>
            </div>
        </section>
    </main>
</body>

</html>