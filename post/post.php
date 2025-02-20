<?php
require("../Navbar.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo 'Invalid post ID';
    die();
}

$id = intval($_GET['id']);
$table = 'posts';

$db = new Database();
$where = "posts.id='$id'";
$join = "user_info ON posts.author_id = user_info.id";
$user_id = $_SESSION['loggedinuserId'];

$result = $db->select($table, 'posts.*, user_info.name,user_info.email,user_info.phone_number', $join, $where, null, null);

$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="../index.css" />
    <style>
        .content-p,
        .post-title {
            margin: 15px auto;
            width: 80%;
            font-size: 1.5vw;

        }

        .imgDiv {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .author,
        .date {
            font-size: 1.2vw;
            margin: 1vw auto;
            width: 90%;
            text-align: right;
        }

        .date {
            line-height: 1.5;
        }

        @media (max-width: 480px) {
            .displayImg {
                max-width: 80vw;
                max-height: 50vh;
            }
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 400px;
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
        }

        button {
            margin: 10px;
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <main class="single-post">
        <?php
        if ($_SESSION['loggedinuserId'] === $row['author_id']) {
            echo '<div class="top-class">
                   <button class="btn" id="editBtn">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                  </div>';
        }
        ?>
        <div class="imgDiv">
            <?php if (!empty($row['image'])) { ?>
                <img src="<?php echo 'http://localhost/finderz/uploads/posts/' . htmlspecialchars($row['image']); ?>" class="displayImg" alt="post image">
            <?php } else { ?>
                <p class="content-p">No image available</p>
            <?php } ?>
        </div>
        <h3 class="post-title"><?= !empty($row['title']) ? htmlspecialchars($row['title']) : 'No title available'; ?></h3>
        <p class="content-p"><?= !empty($row['description']) ? htmlspecialchars($row['description']) : 'No description available'; ?></p>
        <p class="author bold content-p">Posted by: <?= !empty($row['name']) ? htmlspecialchars($row['name']) : 'Unknown'; ?></p>

        <p class="date content-p">
            <?= date('F j, Y', strtotime($row['time'])); ?><br>
            <?= date('g:i a', strtotime($row['time'])); ?>
        </p>

        <?php
        if ($row['author_id'] === $user_id) { ?>
            <button class="btn"><a href="./viewposts.php">Back to Posts</a></button>
        <?php } else { ?>
            <button class="btn" id="claimBtn">Claim Item</button>
        <?php
        }
        ?>
    </main>

    <div id="claimModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="input-content">
                <h2>Ownership Verification</h2>
                <p class="content-p" id="securityQuestion">Loading...</p>
                <div class="form-group">
                    <input type="text" id="answer" name="answer" placeholder="your answer">">
                    <p class="error" id="answerError"></p>
                </div>
                <div class="buttons">
                    <button class="btn" id="submitAnswer">Submit</button>
                    <button class="btn" id="cancelBtn">Cancel</button>
                </div>
            </div>
            <div id="contactDetails" style="display:none;">
                <p class="content-header">Finder's Contact Details</p>
                <p class="content-p"><strong>Finder's Email:</strong> <span id="finderEmail"></span></p>
                <p class="content-p"><strong>Finder's Phone:</strong> <span id="finderPhone"></span></p>
            </div>
        </div>
    </div>


    <div>

    </div>
    </div>

    <?php require("../components/Footer.php"); ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const claimBtn = document.querySelector("#claimBtn");
            const modal = document.querySelector("#claimModal");
            const closeBtn = document.querySelector(".close");
            const cancelButton = document.querySelector("#cancelBtn");
            const submitAnswer = document.querySelector("#submitAnswer");
            
            const inputContent = document.querySelector(".input-content");
            const securityQuestion = document.querySelector("#securityQuestion");
            const answerInput = document.querySelector("#answer");
            const contactDetails = document.querySelector("#contactDetails");
            const finderEmail = document.querySelector("#finderEmail");
            const finderPhone = document.querySelector("#finderPhone");

            const editBtn = document.querySelector("#editBtn");
            if (editBtn) {
                editBtn.addEventListener('click', () => {
                    if (confirm('Do you want to update the post?')) {
                        return window.location.href = "updatepost.php?id=<?php echo $row['id']; ?>";
                    }
                })
            }


            claimBtn.addEventListener("click", function() {
                fetchSecurityQuestion();
                modal.style.display = "flex";
            });

            closeBtn.addEventListener("click", function() {
                modal.style.display = "none";
            });

            cancelButton.addEventListener("click", function() {
                modal.style.display = "none";
            });

            submitAnswer.addEventListener("click", function() {
                verifyAnswer();
            });

            async function fetchSecurityQuestion() {
                await fetch("fetch_security_question.php?post_id=<?php echo $id; ?>")
                    .then(response => response.json())
                    .then(data => {
                        securityQuestion.innerText = data.question;
                    })
                    .catch(error => console.error("Error:", error));
            }

            async function verifyAnswer() {
                const answer = answerInput.value;
                await fetch("verify_answer.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            post_id: parseInt("<?php echo $id; ?>"),
                            answer: answer.trim()
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            contactDetails.style.display = "block";
                            inputContent.style.display = "none";
                            finderEmail.innerText = data.email;
                            finderPhone.innerText = data.phone;
                        } else {
                            alert("Incorrect answer. Please try again.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }
        });
    </script>

</body>

</html>