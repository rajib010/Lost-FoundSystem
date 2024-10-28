<?php require_once('../utility/CheckSession.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../index.css">
    <style>
        .sliderImage {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        #userImage {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            object-fit: cover;
        }

        #userReview {
            width: 80%;
            margin: 8px auto;
        }

        /* Fade-in and fade-out animation classes */
        .fade-out {
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .fade-in {
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        @media (min-width: 768px) and (max-width: 1024px) {
            #userImage {
                width: 275px;
                height: 275px;
            }
        }

        @media (max-width: 767px) {
            .userImage img {
                width: 250px;
                height: 250px;
            }
        }
    </style>
</head>

<body>
    <section class="review-section">
        <h1 class="content-header">Our Happy Users</h1>

        <?php
        require_once("../utility/Database.php");

        $db = new Database();
        $join = "user_info on reviews.author_id=user_info.id";
        $result = $db->select("reviews", "*", $join, null, null, null);

        $reviewsArray = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reviewsArray[] = $row;
            }
        ?>
            <div class="review">
                <div class="sliderImage">
                    <div class="userImage">
                        <img src="" alt="User Image" id="userImage">
                    </div>
                </div>
                <p id="userReview" class="content-p"></p>
                <h3 id="userName" class="post-title"></h3>
            </div>
        <?php
        }
        ?>

        <script>
            let users = <?php echo json_encode($reviewsArray); ?>;
            let currentIndex = 0;

            window.onload = function() {
                updateUserDetails();
                setInterval(nextUser, 3000); // Call nextUser every 3 seconds
            };

            function updateUserDetails() {
                let userImage = document.getElementById('userImage');
                let userReview = document.getElementById('userReview');
                let userName = document.getElementById('userName');

                userImage.src = `http://localhost/finderz/uploads/user/${users[currentIndex].profileImg}`;
                userReview.textContent = `" ${users[currentIndex].message}. "`;
                userName.textContent = users[currentIndex].name;
            }

            function nextUser() {
                let userReview = document.getElementById('userReview');
                let userName = document.getElementById('userName');
                let userImage = document.getElementById('userImage');

                userReview.classList.add('fade-out');
                userName.classList.add('fade-out');
                userImage.classList.add('fade-out');

                setTimeout(() => {
                    currentIndex = (currentIndex + 1) % users.length;
                    updateUserDetails();

                    userReview.classList.remove('fade-out');
                    userName.classList.remove('fade-out');
                    userImage.classList.remove('fade-out');

                    userReview.classList.add('fade-in');
                    userName.classList.add('fade-in');
                    userImage.classList.add('fade-in');
                }, 500);
            }
        </script>
    </section>
</body>

</html>
