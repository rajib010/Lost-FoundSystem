<?php
require('./components/Header.php');
require('./components/Nav.php');
// require('../utility/Database.php');

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

$total_reviews = 0;
$count_result = $db->select('reviews', "COUNT(*) as total", null, null, null);
if ($count_result && $count_result->num_rows > 0) {
    $count_row = $count_result->fetch_assoc();
    $total_reviews = $count_row['total'];
}
$total_pages = ceil($total_reviews / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Reviews</title>
    <link rel="stylesheet" href="../index.css">
    <script src="../utility/CreatePagination.js"></script>
</head>

<body>
    <main class="admin-dashboard">
        <div class="container">
            <h1 class="content-header admin-title">Manage Reviews</h1>
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
                <tbody id="reviews-container">
                    <!-- reviews will be dynamically here -->
                </tbody>
            </table>
            <div id="pagination" class="pagination">
                <!-- pagination code here  -->
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                async function loadReviews(page = 1) {
                    await fetch(`api/GetReviews.php?page=${page}`)
                        .then(response => response.json())
                        .then(data => {
                            const reviewsContainer = document.getElementById('reviews-container');
                            const paginationContainer = document.getElementById('pagination');
                            reviewsContainer.innerHTML = '';
                            paginationContainer.innerHTML = '';

                            if (data.status === 'success') {
                                data.reviews.forEach((review, index) => {
                                    const reviewRow = document.createElement('tr');
                                    //image to be loaded
                                    reviewRow.innerHTML = `
                                    <td>${(page - 1) * 12 + (index + 1)}</td>
                                    <td>${review.name}</td>
                                    <td>${review.message}</td>
                                    <td>${review.satisfaction}</td>
                                    <td>${review.found===1?'Found':'Not Found'}</td>
                                    <td>${review.recommend===1?'Yes':'No'}</td>
                                    <td>
                                        <button class="delete-btn" onclick="navigate(${review.rid}, 'reviews')">Delete</button>
                                    </td>
                                `;
                                    reviewsContainer.appendChild(reviewRow);
                                });

                                //for pagination
                                const totalPages = <?php echo $total_pages; ?>;
                                createPagination(totalPages, page, paginationContainer, loadReviews)
                            } else {
                                reviewsContainer.innerHTML = `<tr><td colspan='5'>${data.message}</td></tr>`;
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Load initial reviews
                const currentPage = new URLSearchParams(window.location.search).get('page') || 1;
                loadReviews(parseInt(currentPage));
            });
        </script>
</body>

</html>