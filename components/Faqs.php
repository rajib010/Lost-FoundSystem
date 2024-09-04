<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        * {
            box-sizing: border-box;
            margin: 0px;
            padding: 0px;
        }

        .faq-section {
            padding: 4vw 10vw 2vw 10vw;
            width: 90%;
            margin: auto;
            margin-bottom: 5vw;
        }

        .faq-section>h1 {
            text-align: center;
            font-size: 2.4vw;
            color: #ff5722;
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
            font-size: 25.7px;
            transition: transform 0.3s ease;
            transform: rotate(-90deg);

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
            transform: rotate(90deg);
        }

        /* for tablet devices */
        @media (min-width: 768px) and (max-width: 1024px) {
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

        @media (max-width: 767px) {
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


<section class="faq-section">
    <h1>Lost & Found FAQs</h1>
    <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
            <p>How do I report a found item?</p>
            <span class="faq-icon">&#8249</span>
        </div>
        <div class="faq-answer">
            <p>You can report a found item by following the steps outlined on our report page.</p>
        </div>
    </div>
    <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
            <p>What if I lost something?</p>
            <span class="faq-icon">&#8249</span>
        </div>
        <div class="faq-answer">
            <p>If you've lost something, you can post details about the lost item on our platform.</p>
        </div>
    </div>
    <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
            <p>Is there a fee to join?</p>
            <span class="faq-icon">&#8249</span>
        </div>
        <div class="faq-answer">
            <p>Nope! It's absolutely free to join.</p>
        </div>
    </div>
    <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
            <p>Can I post multiple items?</p>
            <span class="faq-icon">&#8249</span>
        </div>
        <div class="faq-answer">
            <p>Yes, you can post multiple items whether you've lost or found them.</p>
        </div>
    </div>
    <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)">
            <p>How do I contact the finder?</p>
            <span class="faq-icon">&#8249</span>
        </div>
        <div class="faq-answer">
            <p>You can contact the finder by clicking on the contact button provided with the item details.</p>
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


</html>