<?php require("../Navbar.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            margin: 0px;
            padding: 0px;
        }

        main {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 1vw auto;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }


        .imgDiv {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .imgDiv>img {
            width: 20vw;
            height: inherit;
            border-radius: 10px;
        }

        .title {
            width: 100%;
            text-align: center;
            margin: 1vw auto;
            font-size: 1.8vw;
        }

        .description{
            font-size: 1.5vw;
            line-height: 1.5;
        }

        .author, .date{
            font-size: 1.4vw;
            margin: 1vw auto;
            width: 95%;
            text-align: right;
        }

        .author{
            font-weight: bolder;  
        }

        .backBtn{
            
            height: 3vw;
            width: 5vw;
            padding: 0px 10px;
            background-color: #ff5722;
            border: none;
            color: white; 
            font-size: 1.2vw;
            border-radius: 5px;
            cursor: pointer;
        }
        a{
            text-decoration: none;
            color: white;
        }
    </style>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <main>
        <div class="imgDiv">
            <img src="../public/lost.svg" alt="">
        </div>
        <h3 class="title">This is the title.</h3>
        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora iusto dolore numquam voluptas reiciendis maiores quod repellat explicabo officia harum ratione debitis, nesciunt accusamus ullam? Esse ad fuga omnis magni soluta autem accusamus quibusdam, sapiente rem ratione illo modi asperiores atque pariatur cupiditate ipsam velit. Dicta sed eaque eveniet repellat placeat ratione tenetur, error consequatur odio maiores cupiditate molestiae ducimus sit natus laudantium a vero nihil sequi. Praesentium odit cumque architecto expedita nostrum quidem, error quaerat libero, assumenda vitae ut in cupiditate voluptates. Nam vero, mollitia, doloremque sint asperiores et amet facilis consectetur, rerum voluptas vel delectus quasi. Nemo, ut!</p>
        <p class="author">Author Name</p>
        <p class="date">Date and time</p>
        <button class="backBtn"><a href="./viewpost.php">Posts</a></button>
    </main>
    <?php require("../components/Footer.php");  ?>
</body>

</html>