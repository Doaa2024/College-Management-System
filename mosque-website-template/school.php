<?php require_once('common/header.php'); ?>
<?php
require_once("class/schools.class.php");
$schools = new School();
$allSchools = $schools->getSchools();
?>
<style>
    /* Initially hide sections */
    .fade-in-section {
        opacity: 0;
        transition: opacity 1s ease-out;
    }

    .section-visible {
        opacity: 1;
    }

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
        ng: 0;
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

    /* Initially hide sections */
    .fade-in-section {
        opacity: 0;
        transition: opacity 1s ease-out;
    }

    .section-visible {
        opacity: 1;
    }
</style>

<body>
    <?php require_once('common/navbar.php'); ?>
    <!-- Hero Start -->
    <div class="container-fluid hero-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-header-inner animated zoomIn">

                        <h1 class="display-1 text-dark">School

                        </h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-dark" aria-current="page">School</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <?php foreach ($allSchools as $schools) { ?>
        <section class="intro fade-in-section">
            <div class="container">
                <h2><?= nl2br(htmlspecialchars($schools['Schools'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></h2>
                <p><?= nl2br(htmlspecialchars($schools['Description'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
            </div>
        </section>

    <?php } ?>



    <?php require_once('common/footer.php'); ?>
    <?php require_once('common/script.php'); ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-light back-to-top"><i class="fa fa-arrow-up"></i></a>
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