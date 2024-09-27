<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .review-section {
            padding: 40px 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            margin: 40px auto;
            overflow: hidden;
            width: 95%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .review-section h1 {
            font-size: 2.5em;
            margin-bottom: 30px;
        }

        .sliderImage {
            width: 110%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .userImage img {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            object-fit: cover;
        }

        .sliderBtn {
            background: linear-gradient(90deg, #3a7bd5, #00d2ff);
            border: none;
            width: 5vw;
            height: 5vw;
            border-radius: 100%;
            cursor: pointer;
            color: white;
            font-weight: bold;
            font-size: 2.2em;
            margin-left: 5vw;
            transition: background-color 0.3s ease;
        }

        .sliderBtn:hover {
            background-color: #e64a19;
        }

        #userReview {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 10px;
        }

        #userName {
            font-size: 1.5em;
            color: #333;
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
            .review-section h1 {
                font-size: 2.2em;
            }

            .userImage img {
                width: 275px;
                height: 275px;
            }

            .sliderBtn {
                width: 8vw;
                height: 8vw;
            }

            #userReview {
                font-size: 1.1em;
            }

            #userName {
                font-size: 1.4em;
            }
        }

        @media (max-width: 767px) {
            .review-section h1 {
                font-size: 2em;
            }

            .userImage img {
                width: 250px;
                height: 250px;
            }

            .sliderBtn {
                width: 8vw;
                height: 8vw;
            }

            #userReview {
                font-size: 1em;
            }

            #userName {
                font-size: 1.2em;
            }
        }
    </style>
</head>

<body>
    <section class="review-section">
        <h1>Our Happy Users</h1>

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
                    <button class="sliderBtn" onclick="nextUser()">&#8250;</button> <!-- Added missing semicolon -->
                </div>
                <p id="userReview"></p>
                <h3 id="userName"></h3>
            </div>
        <?php
        }
        ?>

        <script>
            let users = <?php echo json_encode($reviewsArray); ?>;
            let currentIndex = 0;

            window.onload = function () {
                updateUserDetails();
            };

            function updateUserDetails() {
                let userImage = document.getElementById('userImage');
                let userReview = document.getElementById('userReview');
                let userName = document.getElementById('userName');

                userImage.src = `http://localhost/finderz/uploads/user/${users[currentIndex].profileImg}`;
                userReview.textContent = users[currentIndex].message;
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
