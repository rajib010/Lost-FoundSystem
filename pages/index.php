<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
            color: white;
            font-size: 1.2vw;
        }

        .top-main {
            height: 60vh;
            position: relative;
            width: 95%;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black;
        }

        .top-main::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url(../public/bg%20img.jfif);
            background-size: cover;
            background-position: center;
            opacity: 0.6;
            z-index: -1;
        }

        .top-contents {
            position: relative;
            z-index: 1;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
        }

        .top-contents>h1 {
            font-size: 4vw;
            margin-bottom: 2vw;
        }

        .top-contents>p {
            font-style: italic;
            font-size: 1.5vw;
            margin-bottom: 7vw;
        }

        .getStartBtn {
            height: 3vw;
            width: 7vw;
            background-color: #F38402;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            align-items: center;
        }

        .getStartBtn:hover {
            background-color: rgb(3, 83, 3);
        }

        .posts-section {
            width: 95%;
            padding: 2vw 0px;
            margin: auto;
            min-height: 50vh;
        }

        .posts-section>h1 {
            text-align: center;
            font-size: 2.4vw;
            margin-bottom: 2vw;
        }

        .all-posts {
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 1vw;
            flex-wrap: wrap;
        }

        .all-posts>.single-post {
            width: 23%;
            height: auto;
            margin-bottom: 2vw;
            /* Add margin to separate posts vertically */
        }

        .single-post>.post-img {
            width: 100%;
            margin: auto;
            height: 40vh;
            border-radius: 10px;
        }

        .post-img>img {
            width: 100%;
            height: inherit;
            border-radius: 10px;
        }

        .single-post>.post-desc {

            border: 1px dotted black;
            width: 100%;
            height: 9vw;
            margin-top: 0.5vw;
            padding: 1vw;
            border-radius: 1vw;
        }

        .btndiv {
            width: 100%;
            display: flex;
            justify-content: right;
        }

        .viewMoreBtn {
            width: 7vw;
            height: 2.8vw;
            border-radius: 0.4vw;
            background-color: #F38402;

        }

        .viewMoreBtn>a {

            color: white;
        }

        .viewMoreBtn:hover {
            background-color: rgb(3, 83, 3);
            cursor: pointer;
        }


        .review-section {
            width: 95%;
            margin: 2vw auto 3vw 0vw;
            text-align: center;
        }

        .review-section>.review>h1 {
            font-size: 2.4vw;
            padding: 1vw 0vw 3vw 0vw;
        }

        .sliderImage {
            width: 40%;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-bottom: 2vw;
        }

        .sliderImage>.userImage {
            width: 50%;
        }

        .userImage>img {
            width: 100%;
            height: 20vw;

            border-radius: 8px;
        }

        .sliderBtn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 2vw 2vw;
            cursor: pointer;
            font-size: 3vw;
            border-radius: 100%;
            transition: background-color 0.3s ease;
            position: absolute;
            right: -10%;
        }

        .sliderBtn:hover {
            background-color: #0056b3;
        }

        #userReview {
            font-size: 1.5rem;
            margin-bottom: 1vw;
        }

        .fade-out {
            opacity: 0;
        }

        .fade-in {
            opacity: 1;
        }

        .faq-section {
            padding: 4vw 10vw 2vw 10vw;
            width: 90%;
            margin: auto;
        }

        .faq-section>h1 {
            text-align: center;
            font-size: 2.4vw;
            margin-bottom: 3vw;
        }

        .faq-item {
            border-radius: 1vw;
            margin-bottom: 1vw;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .faq-question {
            padding: 1.4vw 1.4vw;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-question p {
            margin: 0;
            font-size: 1.4vw;
        }

        .faq-icon {
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .faq-answer {
            padding: 0 1vw;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }

        .faq-answer p {
            margin: 1.3vw 0;
            font-size: 16px;
            font-style: italic;
        }

        .faq-item.active .faq-answer {
            max-height: 12vw;
            padding: 1.2vw 1.7vw;
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }

        .cta-section {
            text-align: center;
            background-color: white;
            margin: 4vw auto;
            padding: 3vw 0vw;
            border-radius: 1vw;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .cta-section h1 {
            font-size: 2em;
            margin-bottom: 2vw;
            font-weight: bold;
            color: #333;
        }

        .cta-section p {
            font-size: 1.2em;
            margin-bottom: 2vw;
            color: #666;
        }

        .cta-button {
            display: inline-block;
            padding: 1.5vw 2.7vw;
            background-color: #FF8C00;
            color: white;
            text-decoration: none;
            border-radius: 4.6vw;
            font-size: 1.2em;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #e07c00;
        }


        /* for tablet devices */
        @media (min-width: 768px) and (max-width: 1024px) {

            .top-contents>.getStartBtn {
                width: 12vw;
                height: 4.5vw;
            }

            .all-posts>.single-post {
                width: 48%;
            }

            .single-post>.post-desc {
                height: 12vw;
                padding: 1vw 3vw;
            }

            .viewMoreBtn {
                height: 4vw;
                width: 8vw;
            }

            .viewMoreBtn>a {
                font-size: 1.8vw;
            }

            .review-section>.review>h1 {
                font-size: 4vw;
            }

            .sliderImage {
                width: 50%;
            }

            .sliderImage>.userImage {
                width: 70%;
            }

            .userImage>img {
                height: 35vw;
            }

            .sliderBtn {
                padding: 4vw 4vw;
                border-radius: 100%;
                font-size: 3vw;
            }

            #userReview {
                font-size: 1rem;
            }

            #userName {
                font-size: 0.9rem;
            }

            .faq-section>h1 {
                font-size: 4vw;
            }

            .faq-question p {
                font-size: 2.6vw;
            }

            .faq-answer p {
                font-size: 2.4vw;
            }
        }


        /* for mobile devices */
        @media (max-width: 767px) {

            .top-main {
                height: 30vh;
            }

            .top-contents>h1 {
                font-size: 5vw;
            }

            .top-contents>p {
                font-size: 2.5vw;
            }

            .top-contents>.getStartBtn {
                width: 20vw;
                height: 7vw;
            }

            .posts-section>h1 {
                font-size: 4.5vw;
            }

            .all-posts>.single-post {
                width: 80%;
                margin: 1vw auto;
            }

            .single-post>.post-desc {
                height: 20vw;
                padding: 2vw 4vw;
            }

            .btndiv {
                margin-top: 2vw;
                padding-right: 5vw;
            }

            .viewMoreBtn {
                width: 13vw;
                height: 6vw;
            }

            .viewMoreBtn>a {
                font-size: 3vw;
            }

            .review-section>.review>h1 {
                font-size: 4.5vw;
            }

            .sliderImage {
                width: 50%;
            }

            .sliderImage>.userImage {
                width: 70%;
            }

            .userImage>img {
                height: 35vw;
            }

            .sliderBtn {
                padding: 4vw 4vw;
                border-radius: 100%;
                font-size: 3vw;
            }

            #userReview {
                font-size: 1rem;
            }

            #userName {
                font-size: 0.8rem;
            }

            .faq-section>h1 {
                font-size: 4.5vw;
            }

            .faq-question p {
                font-size: 3vw;
            }

            .faq-answer p {
                font-size: 2.6vw;
            }
        }
    </style>
</head>

<body>
    <?php 
        require("../components/Navbar.php");
    ?>

    <main class="top-main">
        <div class="top-contents">
            <h1>Lost Treasures</h1>
            <p>"Discover the hidden gems waiting to be claimed by their owners..."</p>
            <button class="getStartBtn">Get started</button>
        </div>
    </main>
    <section class="posts-section">
        <h1>Latest Finds</h1>
        <div class="all-posts">
            <div class="single-post">
                <div class="post-img">
                    <img src="https://media.istockphoto.com/id/1420676204/photo/portrait-of-a-royal-bengal-tiger-alert-and-staring-at-the-camera-national-animal-of-bangladesh.jpg?s=1024x1024&w=is&k=20&c=WLyTdqemXbqIHvH_Jl8KUig8hnU1Hph76w5XmXaRitg="
                        alt="image">
                </div>
                <div class="post-desc">
                    <h3>This is the title</h3>
                    <p>description</p>
                </div>
            </div>
            <div class="single-post">
                <div class="post-img">
                    <img src="https://media.istockphoto.com/id/1420676204/photo/portrait-of-a-royal-bengal-tiger-alert-and-staring-at-the-camera-national-animal-of-bangladesh.jpg?s=1024x1024&w=is&k=20&c=WLyTdqemXbqIHvH_Jl8KUig8hnU1Hph76w5XmXaRitg="
                        alt="image">
                </div>
                <div class="post-desc">
                    <h3>This is the title</h3>
                    <p>description</p>
                </div>
            </div>
            <div class="single-post">
                <div class="post-img">
                    <img src="https://media.istockphoto.com/id/1420676204/photo/portrait-of-a-royal-bengal-tiger-alert-and-staring-at-the-camera-national-animal-of-bangladesh.jpg?s=1024x1024&w=is&k=20&c=WLyTdqemXbqIHvH_Jl8KUig8hnU1Hph76w5XmXaRitg="
                        alt="image">
                </div>
                <div class="post-desc">
                    <h3>This is the title</h3>
                    <p>description</p>
                </div>
            </div>
            <div class="single-post">
                <div class="post-img">
                    <img src="https://media.istockphoto.com/id/1420676204/photo/portrait-of-a-royal-bengal-tiger-alert-and-staring-at-the-camera-national-animal-of-bangladesh.jpg?s=1024x1024&w=is&k=20&c=WLyTdqemXbqIHvH_Jl8KUig8hnU1Hph76w5XmXaRitg="
                        alt="image">
                </div>
                <div class="post-desc">
                    <h3>This is the title</h3>
                    <p>description</p>
                </div>
            </div>

        </div>
        <div class="btndiv">
            <button class="viewMoreBtn"><a href="">More+</a></button>
        </div>
    </section>

    <section class="review-section">
        <div class="review">
            <h1>Our Happy Users</h1>
            <div class="sliderImage">
                <div class="userImage">
                    <img src="https://variety.com/wp-content/uploads/2023/07/GettyImages-1511418315.jpg?w=250&h=140&crop=1&resize=681%2C383"
                        alt="User Image">
                </div>
                <button class="sliderBtn" onclick="nextUser()">></button>
            </div>
            <p id="userReview">"I found my lost something! This system is a life saver."</p>
            <h3 id="userName">John Doe</h3>
        </div>
    </section>

    <section class="faq-section">
        <h1>Lost & Found FAQs</h1>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <p>How do I report a found item?</p>
                <span class="faq-icon">v</span>
            </div>
            <div class="faq-answer">
                <p>You can report a found item by following the steps outlined on our report page.</p>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <p>What if I lost something?</p>
                <span class="faq-icon">v</span>
            </div>
            <div class="faq-answer">
                <p>If you've lost something, you can post details about the lost item on our platform.</p>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <p>Is there a fee to join?</p>
                <span class="faq-icon">^</span>
            </div>
            <div class="faq-answer">
                <p>Nope! It's absolutely free to join.</p>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <p>Can I post multiple items?</p>
                <span class="faq-icon">v</span>
            </div>
            <div class="faq-answer">
                <p>Yes, you can post multiple items whether you've lost or found them.</p>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <p>How do I contact the finder?</p>
                <span class="faq-icon">v</span>
            </div>
            <div class="faq-answer">
                <p>You can contact the finder by clicking on the contact button provided with the item details.</p>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <h1>Join The Lost & Found Revolution!</h1>
        <p>Sign up today and start finding your lost treasures!</p>
        <a href="#" class="cta-button">Get Started Now</a>
    </section>

    <?php 
        require("../components/Footer.php");
    ?>

    <script>
        let users = [
            {
                image: "https://variety.com/wp-content/uploads/2023/07/GettyImages-1511418315.jpg?w=250&h=140&crop=1&resize=681%2C383",
                review: "I found my lost something! This system is a life saver.",
                name: "John Doe"
            },
            {
                image: "https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/6de659fc-84e5-4b6a-816f-9b6022d687ae/dga1std-cbd38e92-da8c-4864-b86e-fee3bff7b54b.png/v1/fill/w_894,h_894,q_70,strp/tony_stark_ironman_by_purplerhino_dga1std-pre.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9MTAyNCIsInBhdGgiOiJcL2ZcLzZkZTY1OWZjLTg0ZTUtNGI2YS04MTZmLTliNjAyMmQ2ODdhZVwvZGdhMXN0ZC1jYmQzOGU5Mi1kYThjLTQ4NjQtYjg2ZS1mZWUzYmZmN2I1NGIucG5nIiwid2lkdGgiOiI8PTEwMjQifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.Cobo_GbrEKw7_dn_y1rKd69JXZyvZOMOJcnQ9Gmq81c",
                review: "This service is amazing! I found exactly what I needed.",
                name: "Jane Smith"
            },
            // Add more users as needed
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


        function toggleFaq(element) {

            let faqItem = element.parentNode;


            faqItem.classList.toggle('active');


            let allFaqItems = document.querySelectorAll('.faq-item');
            allFaqItems.forEach(item => {
                if (item !== faqItem) {
                    item.classList.remove('active');
                }
            });
        }


    </script>
</body>

</html>