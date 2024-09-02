<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/components/Faqs.css" />
</head>

<body>
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