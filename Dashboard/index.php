<?php require('./components/Header.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <main class="admin-dashboard">

        <?php require('./components/Nav.php') ?>
        <div class="admin-panel">
            <h1 class="content-header center">Welcome to Lost & Found System</h1>
            <div class="dashborad-cards">
                <div class="admin-card">
                    <h2 class="post-title">Total Users</h2>
                    <span class="content-p" id="usersCount">xx</span>
                </div>
                <div class="admin-card">
                    <h2 class="post-title">Total Posts</h2>
                    <span class="content-p" id="postsCount">xx</span>
                </div>
                <div class="admin-card">
                    <h2 class="post-title">Total Reviews</h2>
                    <span class="content-p" id="reviewsCount">xx</span>
                </div>
                <div class="admin-card">
                    <h2 class="post-title">Total Messages</h2>
                    <span class="content-p" id="messagesCount">xx</span>
                </div>
            </div>
            <div class="dashborad-cards">
                <div class="admin-card">
                    <h2 class="post-title">Top Category</h2>
                    <span class="content-p" id="topCategory">xx</span>
                </div>
                <div class="admin-card">
                    <h2 class="post-title">Top Finder</h2>
                    <span class="content-p" id="topFinder">xxxx</span>
                </div>
                <div class="admin-card">
                    <h2 class="post-title">Blocked Posts</h2>
                    <span class="content-p" id="blockedPost">xx</span>
                </div>
                <div class="admin-card">
                    <h2 class="post-title">Suspended Users</h2>
                    <span class="content-p" id="suspendedUsers">xx</span>
                </div>
            </div>
        </div>
    </main>
    <script>
        function getElement(id) {
            return document.getElementById(id)
        }

        document.addEventListener('DOMContentLoaded', () => {
            async function getDetails() {

                await fetch('./api/GetDashboardDetails.php')
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Object.entries(data).map(([key, value]) => {
                                if (key !== 'status') {
                                    return getElement(key).innerText = value
                                }
                            })
                        } else {
                            console.error('Failed to fetch details:', data.message);
                        }

                    })
                    .catch(err => console.error('Error fetching details:', err));
            }

            getDetails();
        })
    </script>
</body>

</html>