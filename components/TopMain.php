<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .top-main {
            padding: 50px 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            margin: 40px auto;
            width: 95%  ;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .top-contents>h1 {
            font-size: 2.5em;
            
            margin-bottom: 20px;
        }

        .top-contents>p {
            font-size: 1.2vw;
            margin-bottom: 20px;
            color: #555;
            font-style: italic;
        }

        .getStartBtn {
            background: linear-gradient(90deg, #3a7bd5, #00d2ff);
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .getStartBtn>a {
            text-decoration: none;
            color: white;
        }

        .getStartBtn:hover {
            background: linear-gradient(90deg, #245c8e, #276d7f);
        }


        @media (min-width:768px) and (max-width:1024px) {
            .top-contents>h1 {
                font-size: 2.5em;
            }

            .top-contents>p {
                font-size: 1.3em;
            }

            .getStartBtn {
                font-size: 1.1em;
                padding: 14px 25px;
            }

        }

        @media (max-width: 767px) {
            .top-contents>h1 {
                font-size: 2.2em;
            }

            .top-contents>p {
                font-size: 1.2em;
            }

            .getStartBtn {
                font-size: 1em;
                padding: 12px 20px;
            }
        }
    </style>
</head>

<body>
    <main class="top-main">
        <div class="top-contents">
            <h1> Welcome to Finderz !!</h1>
            <p>"Discover the hidden gems waiting to be claimed by their owners..."</p>
            <button class="getStartBtn"><a href="../post/viewpost.php">Get Started</a></button>
        </div>
    </main>
</body>

</html>