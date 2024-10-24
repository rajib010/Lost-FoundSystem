<?php
require("components/Header.php");
require("./components/Nav.php");
require("../utility/navigate.php");

$db = new Database();
$limit = 8;

// Get the current page or set to 1 if not set
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int) $_GET['page'];
    if ($current_page < 1) {
        $current_page = 1;
    }
} else {
    $current_page = 1;
}

$total_posts = 0;
$count_result = $db->select('user_info', "COUNT(*) as total", null, null, null);
if ($count_result && $count_result->num_rows > 0) {
    $count_row = $count_result->fetch_assoc();
    $total_posts = $count_row['total'];
}
$total_pages = ceil($total_posts / $limit);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Users</title>
    <link rel="stylesheet" href="../index.css">
    <script src="../utility/CreatePagination.js"></script>
</head>

<body>
    <main class="admin-dashboard">
        <div class="container">
            <h1 class="content-header admin-title">Manage Users</h1>
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
                <tbody id="users-container">
                    <!-- User data will be loaded here dynamically -->
                </tbody>
            </table>

            <div id="pagination" class="pagination"></div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            async function loadUsers(page = 1) {
                await fetch(`./api/GetUsers.php?page=${page}`)
                    .then(response => response.json())
                    .then(data => {
                        const usersContainer = document.getElementById('users-container');
                        const paginationContainer = document.getElementById('pagination');

                        usersContainer.innerHTML = '';
                        paginationContainer.innerHTML = '';

                        if (data.status === 'success') {
                            data.users.forEach((user, index) => {
                                const userRow = document.createElement('tr');
                                userRow.innerHTML = `
                                    <td>${(page - 1) * 12 + (index + 1)}</td>
                                    <td>${user.name}</td>
                                    <td>${user.email}</td>
                                    <td>${user.address}</td>
                                    <td>${user.phone_number}</td>
                                    <td>${user.user_type == 0 ? 'User' : 'Admin'}</td>
                                    <td>
                                        <button class="delete-btn" onclick="navigate(${user.id}, 'user_info')">Delete</button>
                                        <button class="edit-btn">Edit</button>
                                    </td>
                                `;
                                usersContainer.appendChild(userRow);
                            });

                            const totalPages = <?php echo $total_pages; ?>;
                            // custom pagination
                            createPagination(totalPages, page, paginationContainer, loadUsers);
                        } else {
                            usersContainer.innerHTML = `<tr><td colspan='7'>${data.message}</td></tr>`;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Load initial users
            const currentPage = new URLSearchParams(window.location.search).get('page') || 1;
            loadUsers(parseInt(currentPage));
        });
    </script>
</body>

</html>