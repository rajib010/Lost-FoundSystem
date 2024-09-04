<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .posts-section {
            padding: 40px 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            margin: 40px auto;
            max-width: 1200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .posts-section>h1 {
            font-size: 2.5vw;
            color: #ff5722;
            margin-bottom: 30px;
        }

        .all-posts {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }

        .single-post {
            width: calc(25% - 20px);
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: left;
        }

        .post-img img {
            width: 100%;
            height: auto;
        }

        .post-desc {
            padding: 15px;
        }

        .post-desc>h3 {
            font-size: 1.2vw;
            color: #333;
            margin-bottom: 10px;
        }

        .post-desc>p {
            font-size: 1vw;
            color: #555;
        }

        .edit-posts {
            width: 90%;
            margin: auto;
            display: flex;
            gap: 1vw;
            justify-content: right;
        }

        .edit-posts>p>i {
            cursor: pointer;
        }

        .btndiv {
            margin-top: 30px;
        }

        .viewMoreBtn {
            background-color: #ff5722;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
        }

        .viewMoreBtn:hover {
            background-color: #e64a19;
        }

        .viewMoreBtn a {
            color: white;
            text-decoration: none;
        }


        @media (min-width:768px) and (max-width:1024px) {

            .posts-section h1 {
                font-size: 2.2em;
            }

            .post-desc>h3 {
                font-size: 2.5vw;
            }

            .post-desc>p {
                font-size: 2vw;
            }

            .single-post {
                width: calc(33.33% - 20px);
            }
        }

        @media (max-width: 767px) {


            .posts-section>h1 {
                font-size: 5vw;
            }

            .post-desc>h3 {
                font-size: 3vw;
            }

            .post-desc>p {
                font-size: 2.5vw;
            }

            .edit-posts {
                gap: 3vw;
            }

            .single-post {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <section class="posts-section">
        <h1>Your Posts</h1>
        <div class="all-posts">
            <div class="single-post">
                <div class="post-img">
                    <img src="https://media.istockphoto.com/id/1420676204/photo/portrait-of-a-royal-bengal-tiger-alert-and-staring-at-the-camera-national-animal-of-bangladesh.jpg?s=1024x1024&w=is&k=20&c=WLyTdqemXbqIHvH_Jl8KUig8hnU1Hph76w5XmXaRitg=" alt="image">
                </div>
                <div class="edit-posts">
                    <p class="edit"><i class="fa-solid fa-pen"></i></p>
                    <p class="delete"><i class="fa-solid fa-trash"></i></p>
                </div>
                <div class="post-desc">
                    <h3>This is the title</h3>
                    <p>description</p>
                </div>
            </div>
            <div class="single-post">
                <div class="post-img">
                    <img src="https://media.istockphoto.com/id/1420676204/photo/portrait-of-a-royal-bengal-tiger-alert-and-staring-at-the-camera-national-animal-of-bangladesh.jpg?s=1024x1024&w=is&k=20&c=WLyTdqemXbqIHvH_Jl8KUig8hnU1Hph76w5XmXaRitg=" alt="image">
                </div>
                <div class="edit-posts">
                    <p class="edit"><i class="fa-solid fa-pen"></i></p>
                    <p class="delete"><i class="fa-solid fa-trash"></i></p>
                </div>
                <div class="post-desc">
                    <h3>This is the title</h3>
                    <p>description</p>
                </div>
            </div>
            <div class="single-post">
                <div class="post-img">
                    <img src="https://media.istockphoto.com/id/1420676204/photo/portrait-of-a-royal-bengal-tiger-alert-and-staring-at-the-camera-national-animal-of-bangladesh.jpg?s=1024x1024&w=is&k=20&c=WLyTdqemXbqIHvH_Jl8KUig8hnU1Hph76w5XmXaRitg=" alt="image">
                </div>
                <div class="edit-posts">
                    <p class="edit"><i class="fa-solid fa-pen"></i></p>
                    <p class="delete"><i class="fa-solid fa-trash"></i></p>
                </div>
                <div class="post-desc">
                    <h3>This is the title</h3>
                    <p>description</p>
                </div>
            </div>
            <div class="single-post">
                <div class="post-img">
                    <img src="https://media.istockphoto.com/id/1420676204/photo/portrait-of-a-royal-bengal-tiger-alert-and-staring-at-the-camera-national-animal-of-bangladesh.jpg?s=1024x1024&w=is&k=20&c=WLyTdqemXbqIHvH_Jl8KUig8hnU1Hph76w5XmXaRitg=" alt="image">
                </div>
                <div class="edit-posts">
                    <p class="edit"><i class="fa-solid fa-pen"></i></p>
                    <p class="delete"><i class="fa-solid fa-trash"></i></p>
                </div>
                <div class="post-desc">
                    <h3>This is the title</h3>
                    <p>description</p>
                </div>
            </div>
        </div>
    </section>
</body>

</html>