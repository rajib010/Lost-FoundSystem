<?php
require("components/Header.php");
require("./components/Nav.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Users</title>
    <link rel="stylesheet" href="../index.css">
    <script src="../utility/CreatePagination.js"></script>
    <style>
        body {
            top: 0vw;
        }
    </style>
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
                        <th>Status</th>
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
                await fetch(`api/GetUsers.php?page=${page}`)
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
                                    <td>${(page - 1) * 8 + (index + 1)}</td>
                                    <td>${user.name}</td>
                                    <td>${user.email}</td>
                                    <td>${user.address}</td>
                                    <td>${user.phone_number}</td>
                                    <td>${user.user_type == 0 ? 'User' : 'Admin'}</td>
                                    <td>${user.status}</td>
                                    <td>
                                        ${user.status === 'active' ? 
                                            `<button class="delete-btn" onClick='suspend(${user.id})'>Suspend</button>` : 
                                            `<button class="edit-btn" onClick='unsuspend(${user.id})'>Unsuspend</button>`
                                        }
                                    </td>

                                `;
                                usersContainer.appendChild(userRow);
                            });

                            const totalPages = data.totalPages;
                            // custom pagination
                            createPagination(totalPages, page, paginationContainer, loadUsers);
                        } else {
                            usersContainer.innerHTML = `<tr><td colspan='7'>${data.message}</td></tr>`;
                        }
                    })
                    .catch(error => console.error('Error in fetching user info:', error))
                    .finally(
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        })
                    );
            }

            // Load initial users
            const currentPage = new URLSearchParams(window.location.search).get('page') || 1;
            loadUsers(parseInt(currentPage));
        });

        const suspend = (id) => {
            if (confirm('Are you sure you want to suspend the user?')) {
                window.location.href = `./api/ChangeStatus.php?id=${id}&action=suspend`;
            }
        };

        const unsuspend = (id) => {
            if (confirm('Are you sure you want to unsuspend the user?')) {
                window.location.href = `./api/ChangeStatus.php?id=${id}&action=unsuspend`;
            }
        };
    </script>
</body>

</html>