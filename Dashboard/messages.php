<?php
require("components/Header.php");
require("components/Nav.php");

$db = new Database();
$limit = 8;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int) $_GET['page'];
    if ($current_page < 1) {
        $current_page = 1;
    }
} else {
    $current_page = 1;
}

$total_messages = 0;
$count_result = $db->select('messages', "COUNT(*) as total", null, null, null);
if ($count_result && $count_result->num_rows > 0) {
    $count_row = $count_result->fetch_assoc();
    $total_messages = $count_row['total'];
}
$total_pages = ceil($total_messages / $limit);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Messages</title>
    <link rel="stylesheet" href="../index.css">
    <script src="../utility/CreatePagination.js"></script>
    <script src='../utility/navigate.js'></script>
    <style>
        body {
            top: 0vw;
        }
    </style>
</head>

<body>
    <main class="admin-dashboard">
        <div class="container">
            <h1 class="content-header admin-title">Manage Messages</h1>
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
                <tbody id="messages-container">
                    <!-- table content here -->
                </tbody>
            </table>
            <div id="pagination" class="pagination">
                <!-- pagination code here -->
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                async function loadMessages(page = 1) {
                    await fetch(`api/GetMessages.php?page=${page}`)
                        .then(response => response.json())
                        .then(data => {
                            const messagesContainer = document.getElementById('messages-container');
                            const paginationContainer = document.getElementById('pagination');
                            messagesContainer.innerHTML = '';
                            paginationContainer.innerHTML = '';

                            if (data.status === 'success') {
                                data.messages.forEach((message, index) => {
                                    const messageRow = document.createElement('tr');
                                    messageRow.innerHTML = `
                                        <td>${(page - 1) * 8 + (index + 1)}</td>
                                        <td>${message.name}</td>
                                        <td>${message.email}</td>
                                        <td>${message.message}</td>
                                        <td>
                                            <button class="edit-btn" onClick="replyMessage('${message.email}')">Reply</button>
                                            <button class="delete-btn" onClick="navigate(${message.id}, 'messages')">Delete</button>
                                        </td>
                                         `;

                                    messagesContainer.appendChild(messageRow);
                                });

                                //for pagination using custom pagination
                                const totalPages = <?php echo $total_pages; ?>;
                                createPagination(totalPages, page, paginationContainer, loadMessages)


                            } else {
                                messagesContainer.innerHTML = `<tr><td colspan='5'>${data.message}</td></tr>`;
                            }
                        })
                        .catch(error => console.error('Error:', error))
                        .finally(
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            })
                        );
                }

                // Load initial messages
                const currentPage = new URLSearchParams(window.location.search).get('page') || 1;
                loadMessages(parseInt(currentPage));
            });

            function replyMessage(email) {
                window.location.href = `mail.php?receiver=${email}`;
            }
        </script>

</body>

</html>