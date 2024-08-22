<?php require_once('common/header.php');
require_once("class/addmission.class.php");
$transfer = new Addmission();
$allTransfer = $transfer->getTransfer();
?>

<style>
    /* styles.css */
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        color: #333;
    }



    nav {
        padding: 1rem 0;
    }

    nav .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }


    .intro {
        color: #fff;
        padding: 3rem 1rem;
    }

    .intro h2 {
        font-size: 2.8rem;
        margin: 0 0 1rem;
        text-align: left;
        color: rgba(241, 193, 82, 1);
    }

    .intro p {
        font-size: 1.2rem;
        margin: 0;
        color: #333;
    }

    .requirements {
        background-color: #fff;
        padding: 2rem 1rem;
    }

    .requirements h2 {
        font-size: 2rem;
        margin: 0 0 1rem;
        text-align: left;
        color: rgba(241, 193, 82, 1);
    }

    .requirements ul {
        list-style-type: none;
        padding: 0;
        font-size: 1rem;
    }

    .requirements ul li {
        background: rgba(241, 193, 82, 0.1);
        border-left: 5px solid rgba(241, 193, 82, 0.7);
        margin: 0.5rem 0;
        padding: 0.5rem;
        border-radius: 5px;
    }

    .conclusion {
        background-color: #fff;
        padding: 2rem 1rem;
        text-align: left;
    }

    .conclusion p {
        font-size: 1.2rem;
        margin: 0 0 1rem;
    }

    .btn-primary1 {
        background-color: rgba(241, 193, 82, 1);
        color: #fff;
        border: none;
        padding: 0.8rem 1.5rem;
        text-transform: uppercase;
        font-weight: bold;
        font-size: 1rem;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s, transform 0.3s;
    }

    .btn-primary1:hover {
        background-color: rgba(241, 193, 82, 0.9);
        transform: scale(1.05);
    }

    /* styles.css */
    .icons-section {
        background-color: #fff;
        padding: 2rem 1rem;
        text-align: center;
    }

    .icons-section h2 {
        font-size: 2rem;
        margin-bottom: 1.5rem;
        color: rgba(241, 193, 82, 1);
    }

    .icon-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2rem;
    }

    .icon-box {
        background-color: rgba(241, 193, 82, 0.1);
        border: 2px solid rgba(241, 193, 82, 0.7);
        border-radius: 10px;
        padding: 1.5rem;
        width: 220px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, transform 0.3s;
    }

    .icon-box i {
        font-size: 3rem;
        color: rgba(241, 193, 82, 1);
        margin-bottom: 1rem;
    }

    .icon-box h3 {
        font-size: 1.25rem;
        margin: 0.5rem 0;
    }

    .icon-box p {
        font-size: 1rem;
        margin: 0;
    }

    .icon-box:hover {
        background-color: rgba(241, 193, 82, 0.2);
        transform: scale(1.05);
    }

    /* Initially hide sections */
    .fade-in-section {
        opacity: 0;
        transition: opacity 1s ease-out;
    }

    .section-visible {
        opacity: 1;
    }

    /* Additional styling for sections */
    .intro,
    .requirements,
    .conclusion,
    .icons-section {
        padding: 40px 0;
        /* Adjust spacing as needed */
    }

    .icon-grid {
        display: flex;
        gap: 20px;
        /* Space between icon boxes */
    }

    .icon-box {
        text-align: center;
        padding: 20px;
        background: rgba(241, 193, 82, .1);
        /* Light background for icons */
        border-radius: 8px;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .icon-box:hover {
        background: rgba(241, 193, 82, .3);
        /* Darker background on hover */
        transform: translateY(-5px);
        /* Slight lift on hover */
    }
</style>

<body>
    <?php require_once('common/navbar.php'); ?>
    <!-- Spinner Start -->

    <!-- Spinner End -->
    <!-- Hero Start -->
    <div class="container-fluid hero-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-header-inner animated zoomIn">
                        <h1 class="display-1 text-dark">Transfer</h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-dark" aria-current="page">Transfer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <section class="intro fade-in-section">
        <div class="container">
            <h2>Welcome to Your Transfer Journey</h2>
            <p><?= nl2br(htmlspecialchars($allTransfer[0]['FirstParaghraph'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
        </div>
    </section>

    <section class="requirements fade-in-section">
        <div class="container">
            <h2>Required Documents</h2>
            <ul>
                <?php
                // Assuming $allTransfer[0]['DocumentsList'] contains a string with documents separated by new lines
                $documentsList = $allTransfer[0]['DocumentsList']; // Example: "Official Transcripts from Current University\nCompleted Transfer Application Form\n..."
                $documentsArray = explode("\n", $documentsList); // Split string into an array based on new lines
                ?>

                <?php foreach ($documentsArray as $document): ?>
                    <li><?php echo htmlspecialchars($document); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section class="conclusion fade-in-section">
        <div class="container">
            <p><?= nl2br(htmlspecialchars($allTransfer[0]['LastParaghraph'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
            <a href="apply.php" class="btn-primary1">Apply Now</a>
        </div>
    </section>

    <section class="icons-section fade-in-section">
        <div class="container">
            <h2>Key Transfer Steps</h2>
            <div class="icon-grid">
                <div class="icon-box">
                    <i class="fas fa-file-alt"></i>
                    <h3>Submit Documents</h3>
                    <p>Gather and submit all required documents for your transfer.</p>
                </div>
                <div class="icon-box">
                    <i class="fas fa-calendar-check"></i>
                    <h3>Check Deadlines</h3>
                    <p>Make sure you meet all application deadlines.</p>
                </div>
                <div class="icon-box">
                    <i class="fas fa-envelope"></i>
                    <h3>Confirmation Email</h3>
                    <p>Receive a confirmation email once your application is processed.</p>
                </div>
                <div class="icon-box">
                    <i class="fas fa-graduation-cap"></i>
                    <h3>Welcome to Your New University</h3>
                    <p>Prepare for a new academic journey at your new university.</p>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sections = document.querySelectorAll('.fade-in-section');

            const observerOptions = {
                root: null, // Observing relative to the viewport
                threshold: 0.4 // Trigger when 40% of the section is visible
            };

            const observer = new IntersectionObserver(function(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('section-visible');
                        observer.unobserve(entry.target); // Stop observing once it's visible
                    }
                });
            }, observerOptions);

            sections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>
</body>

</html>




<?php require_once('common/footer.php'); ?>
<?php require_once('common/script.php'); ?>


<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-light back-to-top"><i class="fa fa-arrow-up"></i></a>


</body>

</html>