<?php require_once('common/header.php');
require_once("class/addmission.class.php");
$requirments = new Addmission();
$allRequirments = $requirments->getRequirments();
?>

<style>
    /* styles.css */
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        color: #333;
    }

    header {
        background-color: #fff;
        border-bottom: 2px solid rgba(241, 193, 82, 0.7);
    }

    nav {
        padding: 1rem 0;
    }

    nav .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    nav h1 {
        margin: 0;
        font-size: 2rem;
        color: rgba(241, 193, 82, 1);
    }

    .admission-requirements p {
        font-size: 1.2rem;
    }

    .admission-requirements,
    .requirements-list,
    .curriculum-info,
    .conclusion {
        background-color: #fff;
        padding: 2rem 1rem;

    }

    .admission-requirements h2 {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: rgba(241, 193, 82, 1);
    }

    .requirements-list h2 {
        font-size: 2rem;
        margin-bottom: 0rem;
        color: rgba(241, 193, 82, 1);
    }

    .curriculum-info h2 {
        font-size: 2rem;
        margin-bottom: 1rem;
        margin-top: 5%;
        color: rgba(241, 193, 82, 1);
    }

    .requirements-list ul {
        list-style-type: none;
        padding: 0;
        font-size: 1rem;
    }

    .requirements-list ul li {
        background: rgba(241, 193, 82, 0.1);
        border-left: 5px solid rgba(241, 193, 82, 0.7);
        margin: 0.5rem 0;
        padding: 0.5rem;
        border-radius: 5px;
    }

    .curriculum-info p {
        font-size: 1.2rem;
        margin: 0.5rem 0;
    }

    .conclusion {
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
        color: #666;
        transform: scale(1.05);
    }

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

    .fade-in-section {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 1s ease-out, transform 1s ease-out;
    }

    .section-visible {
        opacity: 1;
        transform: translateY(0);
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
                        <h1 class="display-1 text-dark">Requirements</h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-dark" aria-current="page">Requirements</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
    <section class="admission-requirements fade-in-section">
        <div class="container">
            <h2>Admission Requirements</h2>
            <p><?= nl2br(htmlspecialchars($allRequirments[0]['admission_requirements'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?> </p>
        </div>
    </section>

    <section class="requirements-list fade-in-section">
        <div class="container">
            <h2>Required Documents</h2>
            <?php
            // Assuming $allTransfer[0]['DocumentsList'] contains a string with documents separated by new lines
            $documentsList = $allRequirments[0]['required_documents']; // Example: "Official Transcripts from Current University\nCompleted Transfer Application Form\n..."
            $documentsArray = explode("\n", $documentsList); // Split string into an array based on new lines
            ?>
            <ul>
                <?php foreach ($documentsArray as $document): ?>
                    <li><?php echo htmlspecialchars($document); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section class="curriculum-info ">
        <div class="container">
            <section class="course-section fade-in-section">
                <h2>Courses</h2>
                <p><?= nl2br(htmlspecialchars($allRequirments[0]['courses'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
            </section>

            <section class="curriculum-section fade-in-section">
                <h2>Curriculum</h2>
                <p><?= nl2br(htmlspecialchars($allRequirments[0]['curriculum'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
            </section>

            <section class="credit-hours-section fade-in-section">
                <h2>Credit Hours</h2>
                <p><?= nl2br(htmlspecialchars($allRequirments[0]['credit_hours'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
            </section>

            <section class="major-courses-section fade-in-section">
                <h2>Major Courses</h2>
                <p><?= nl2br(htmlspecialchars($allRequirments[0]['major_courses'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
            </section>

            <section class="major-electives-section fade-in-section">
                <h2>Major Electives</h2>
                <p><?= nl2br(htmlspecialchars($allRequirments[0]['major_electives'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
            </section>

            <section class="core-courses-section fade-in-section">
                <h2>Core Courses</h2>
                <p><?= nl2br(htmlspecialchars($allRequirments[0]['core_courses'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
            </section>

            <section class="general-education-section fade-in-section">
                <h2>General Education</h2>
                <p><?= nl2br(htmlspecialchars($allRequirments[0]['general_education'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
            </section>
        </div>
    </section>


    <section class="conclusion fade-in-section">
        <div class="container">
            <p><?= nl2br(htmlspecialchars($allRequirments[0]['conclusion'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?> </p>
            <a href="apply,php" class="btn-primary1">Apply Now</a>
        </div>
    </section>

    <section class="icons-section fade-in-section">
        <div class="container">
            <h2>Key Information</h2>
            <div class="icon-grid">
                <div class="icon-box">
                    <i class="fas fa-file-signature"></i>
                    <h3>Document Submission</h3>
                    <p>Ensure all required documents are submitted accurately.</p>
                </div>
                <div class="icon-box">
                    <i class="fas fa-calendar-alt"></i>
                    <h3>Deadlines</h3>
                    <p>Be aware of important application and registration deadlines.</p>
                </div>
                <div class="icon-box">
                    <i class="fas fa-check-circle"></i>
                    <h3>Application Status</h3>
                    <p>Track the status of your application through our portal.</p>
                </div>
                <div class="icon-box">
                    <i class="fas fa-graduation-cap"></i>
                    <h3>Program Details</h3>
                    <p>Review program specifics to ensure alignment with your goals.</p>
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

    <?php require_once('common/footer.php'); ?>
    <?php require_once('common/script.php'); ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-light back-to-top"><i class="fa fa-arrow-up"></i></a>


</body>

</html>