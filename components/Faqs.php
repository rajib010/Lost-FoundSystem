<?php require_once('../utility/CheckSession.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../index.css">
    <style>
        .faq-item,
        .faq-question,
        .faq-answer {
            transition: 0.3s ease;
        }

        .faq-item {
            border-radius: 1vw;
            margin-bottom: 1vw;
            width: 90%;
            margin: 10px auto;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .faq-item:hover {
            transform: translateX(15px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .faq-question {
            padding: 1vw 2vw 0vw 2vw;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f4f6f8;
            border-bottom: 1px solid #ddd;
        }

        .faq-question:hover {
            background-color: #e0e4e9;
        }

        .faq-icon {
            font-size: 25px;
            transform: rotate(-90deg);
        }

        .faq-answer {
            padding: 0 0.5vw;
            max-height: 0;
            overflow: hidden;
            font-style: italic;
            background-color: #f9f9f9;
        }
        .faq-answer>.content-p{
            font-style: italic;
        }

        .faq-item.active .faq-answer {
            max-height: 12vw;
            padding: 1.2vw 1.7vw;
        }

        .faq-item.active .faq-icon {
            transform: rotate(90deg);
        }
    </style>
</head>

<body>
    <section class="faq-section" id='faqs'>
        <h1 class="content-header">Lost & Found FAQs</h1>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <p class="content-p">How do I report a found item?</p>
                <span class="faq-icon">&#8249</span>
            </div>
            <div class="faq-answer">
                <p class="content-p">"You can report a found item by following the steps outlined on our report page."</p>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <p class="content-p">What if I lost something?</p>
                <span class="faq-icon">&#8249</span>
            </div>
            <div class="faq-answer">
                <p class="content-p">"If you've lost something, you can post details about the lost item on our platform."</p>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <p class="content-p">Is there a fee to join?</p>
                <span class="faq-icon">&#8249</span>
            </div>
            <div class="faq-answer">
                <p class="content-p">"Nope! It's absolutely free to join."</p>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <p class="content-p">Can I post multiple items?</p>
                <span class="faq-icon">&#8249</span>
            </div>
            <div class="faq-answer">
                <p class="content-p">"Yes, you can post multiple items whether you've lost or found them."</p>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <p class="content-p">How do I contact the finder?</p>
                <span class="faq-icon">&#8249</span>
            </div>
            <div class="faq-answer">
                <p class="content-p">"You can contact the finder by clicking on the contact button provided with the item details."</p>
            </div>
        </div>
    </section>

    <script>
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