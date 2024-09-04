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
            max-width: 1200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .review h1 {
            font-size: 2.5em;
            color: #ff5722;
            margin-bottom: 30px;
        }

        .sliderImage {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .userImage img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

        .sliderBtn {
            background-color: #ff5722;
            border: none;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            color: white;
            font-weight: bold;
            font-size: 1.2em;
            margin-left: 10px;
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

        @media (min-width:768px) and (max-width:1024px) {

            .review h1 {
                font-size: 2.2em;
            }

            .userImage img {
                width: 90px;
                height: 90px;
            }

            #userReview {
                font-size: 1.1em;
            }

            #userName {
                font-size: 1.4em;
            }

        }

        @media (max-width: 767px) {

            .review h1 {
                font-size: 2em;
            }

            .userImage img {
                width: 80px;
                height: 80px;
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
        <div class="review">
            <h1>Our Happy Users</h1>
            <div class="sliderImage">
                <div class="userImage">
                    <img src="https://variety.com/wp-content/uploads/2023/07/GettyImages-1511418315.jpg?w=250&h=140&crop=1&resize=681%2C383" alt="User Image">
                </div>
                <button class="sliderBtn" onclick="nextUser()">&#8250</button>
            </div>
            <p id="userReview">"I found my lost something! This system is a life saver."</p>
            <h3 id="userName">John Doe</h3>
        </div>
    </section>
    <script>
        let users = [{
                image: "https://variety.com/wp-content/uploads/2023/07/GettyImages-1511418315.jpg?w=250&h=140&crop=1&resize=681%2C383",
                review: "I found my lost something! This system is a life saver.",
                name: "John Doe"
            },
            {
                image: "https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/6de659fc-84e5-4b6a-816f-9b6022d687ae/dga1std-cbd38e92-da8c-4864-b86e-fee3bff7b54b.png/v1/fill/w_894,h_894,q_70,strp/tony_stark_ironman_by_purplerhino_dga1std-pre.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9MTAyNCIsInBhdGgiOiJcL2ZcLzZkZTY1OWZjLTg0ZTUtNGI2YS04MTZmLTliNjAyMmQ2ODdhZVwvZGdhMXN0ZC1jYmQzOGU5Mi1kYThjLTQ4NjQtYjg2ZS1mZWUzYmZmN2I1NGIucG5nIiwid2lkdGgiOiI8PTEwMjQifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.Cobo_GbrEKw7_dn_y1rKd69JXZyvZOMOJcnQ9Gmq81c",
                review: "This service is amazing! I found exactly what I needed.",
                name: "Jane Smith"
            },
        ];

        let currentIndex = 0;

        function nextUser() {

            let userImage = document.querySelector('.userImage img');
            let userReview = document.getElementById('userReview');
            let userName = document.getElementById('userName');

            userReview.classList.add('fade-out');
            userName.classList.add('fade-out');
            userImage.classList.add('fade-out');

            setTimeout(() => {
                currentIndex = (currentIndex + 1) % users.length;
                userImage.src = users[currentIndex].image;
                userReview.textContent = users[currentIndex].review;
                userName.textContent = users[currentIndex].name;

                userReview.classList.remove('fade-out');
                userName.classList.remove('fade-out');
                userImage.classList.remove('fade-out');
                userReview.classList.add('fade-in');
                userName.classList.add('fade-in');
                userImage.classList.add('fade-in');
            }, 500);
        }
    </script>
</body>

</html>