<?php require_once('common/header.php'); ?>
<?php
require_once("class/main.class.php");
require_once("class/about.class.php");
$info = new Main();
$about = new About();
$allAbout = $about->getAbout();
$pName = $about->presidentName();
$allInfo = $info->getAllInfo();
?>
<style>
    /* Initial opacity for sections */
    .welcome-section,
    .president-message,
    .text-image-section,
    .school-list-section,
    .curriculum-section {
        opacity: 0;
        transform: translateY(20px);
        /* Optional: Adds a slight slide-up effect */
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    /* When the section is visible, change opacity to 1 */
    .section-visible {
        opacity: 1;
        transform: translateY(0);
        /* Resets the slight slide-up effect */
    }

    .welcome-section {
        border: 2px solid rgba(241, 193, 82, .7);
        border-top: none;
        border-right: none;
        border-left: none;
        padding: 50px 0;
    }

    .lead {
        font-size: 22px;
        color: #555;
        font-weight: 600;
    }

    .president-message {
        color: rgba(241, 193, 82, .7);
        padding: 50px 0;
        border: 2px solid rgba(241, 193, 82, .7);
        border-top: none;
        border-right: none;
        border-left: none;


    }

    .president-message h2 {
        text-align: left;
        margin-bottom: 20px;
        color: rgba(241, 193, 82, 1);
        font-size: 40px;
    }

    .president-message p {
        text-align: left;
        margin-top: 0;
        font-size: 18px;
        color: #333;
    }


    .text-image-section {
        padding: 30px 0;
        padding-top: 80px;
        padding-bottom: 80px;
        border: 2px solid rgba(241, 193, 82, .7);
        border-top: none;
        border-right: none;
        border-left: none;

    }

    .text-image-content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .image-content {
        width: 100%;
        text-align: center;
        margin-bottom: 20px;
        margin-left: 15px;
    }

    .image-content img {
        max-width: 100%;
        height: auto;
    }

    .text-content {
        width: 100%;
        text-align: center;
        color: #333;
        font-weight: 500;
    }

    .text-content p {
        margin: 5px 0;
    }

    @media (min-width: 768px) {
        .text-image-content {
            flex-direction: row;
            align-items: stretch;
            /* Make the items stretch to the same height */
        }

        .image-content {
            margin-right: 20px;
            margin-bottom: 0;
            flex: 1;
            /* Allow the image content to grow or shrink to match the text content height */
        }

        .image-content img {
            height: 100%;
            object-fit: cover;
            /* Ensure the image covers its container without stretching */
        }

        .text-content {
            flex: 1;
            text-align: left;
        }
    }


    .school-list-section {
        padding: 30px 0;
        color: #333;
        border: 2px solid rgba(241, 193, 82, .7);
        border-top: none;
        border-right: none;
        border-left: none;

    }

    .section-title {
        text-align: center;
        font-size: 2.5em;
        margin-bottom: 20px;
        font-weight: bold;
        color: rgba(241, 193, 82, 1);
    }

    .school-list-content {
        font-size: 1.3em;
        line-height: 1.1em;
        white-space: pre-wrap;
        text-align: left;
        background: #ffffff;
        padding: 20px;
        border-radius: 5px;
        font-weight: 400;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* Adding transition for smooth effect */
    }

    .school-list-content:hover {
        transform: translateY(-5px);
        /* Moves the content up by 5px on hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        /* Adds a slightly larger shadow on hover */
    }

    .curriculum-section {
        padding: 40px 0;
        color: #333;
        transition: transform 0.3s ease-in-out;
    }

    .section-title {
        text-align: center;
        font-size: 2.5em;
        margin-bottom: 20px;
        font-weight: bold;
        color: rgba(241, 193, 82, 1);
    }

    .curriculum-content {
        font-size: 1.2em;
        line-height: 1.6em;
        text-align: left;
        background: #ffffff;
        padding: 20px;
        border-radius: 5px;
        font-weight: 500;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    /* Transform effect on hover */
    .curriculum-section:hover .curriculum-content {
        transform: translateY(-5px);
        /* Scales up the content by 5% */
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
                        <?php
                        // Assuming $name contains the name string, e.g., "DAU"
                        $name = $allInfo[0]['Name']; // Replace this with the dynamic value if necessary
                        $lastLetter = substr($name, -1); // Get the last letter (e.g., "U")
                        $nameWithoutLastLetter = substr($name, 0, -1); // Get the name without the last letter (e.g., "DA")
                        ?>
                        <h1 class="display-1 text-dark">About
                            <?= $nameWithoutLastLetter ?><span class="text-primary"><?= $lastLetter ?></span>
                        </h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-dark" aria-current="page">About</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->



    <!-- Welcome Section -->
    <section class="welcome-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="img/college7.jpg" alt="Welcome Image" class="img-fluid">
                </div>
                <div class="col-md-6 text-center text-md-left">
                    <p class="lead"><?= nl2br(htmlspecialchars($allAbout[0]['WelcomeStatement'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
                </div>
            </div>
        </div>
    </section>


    <!-- President's Message -->
    <!-- President's Message -->
    <section class="president-message">
        <div class="container">
            <h2 class="mt-4 text-left">A Message from Our President</h2>

            <p><?= nl2br(htmlspecialchars($allAbout[0]['PresidentMessage'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>

        </div>
        <div class="container">
            <p class="text1" style="font-weight:bold;padding-top:15px;"><?= $pName[0]['Username'] ?></p>
            <p class="text2" style="font-weight:bold; ">President, <?= $allInfo[0]['Name'] ?></p>
        </div>
    </section>
    <!-- Image with Text -->

    <section class="text-image-section">
        <div class="container">
            <div class="text-image-content">
                <div class="text-content">
                    <p><?= nl2br(htmlspecialchars($allAbout[0]['History'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
                </div>
                <div class="image-content">
                    <img src="img/college36.webp" alt="Image with Text" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
    <section class="school-list-section">
        <div class="container">
            <h2 class="section-title">Our Schools</h2>
            <div class="school-list-content">
                <p><?= nl2br(htmlspecialchars($allAbout[0]['SchoolsList'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
            </div>
        </div>
    </section>
    <section class="curriculum-section">
        <div class="container">
            <h2 class="section-title">Type of Curriculum</h2>
            <div class="curriculum-content">
                <p><?= nl2br(htmlspecialchars($allAbout[0]['Curriculum'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
            </div>
        </div>
    </section>

    <?php require_once('common/footer.php'); ?>
    <?php require_once('common/script.php'); ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-light back-to-top"><i class="fa fa-arrow-up"></i></a>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sections = document.querySelectorAll('.welcome-section, .president-message, .text-image-section, .school-list-section, .curriculum-section, .footer');

            const observerOptions = {
                root: null, // Observing relative to the viewport
                threshold: 0.4 // Trigger when 10% of the section is visible
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