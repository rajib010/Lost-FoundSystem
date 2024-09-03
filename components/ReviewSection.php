<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/components/ReviewSection.css">   
</head>

<body>
    <section class="review-section">
        <div class="review">
            <h1>Our Happy Users</h1>
            <div class="sliderImage">
                <div class="userImage">
                    <img src="https://variety.com/wp-content/uploads/2023/07/GettyImages-1511418315.jpg?w=250&h=140&crop=1&resize=681%2C383" alt="User Image">
                </div>
                <button class="sliderBtn" onclick="nextUser()">></button>
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