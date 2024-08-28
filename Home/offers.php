<?php require_once('common/header.php');
require_once("class/offers.class.php");
$offers = new Offers();
$allJobsOffers = $offers->getJobsOffers();
?>
<style>
    body {
        color: #333;
        font-family: 'Arial', sans-serif;
    }

    .job-listing {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 20px 0;
        padding: 20px;
        border: 2px solid rgba(241, 193, 82, 0.8);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .job-listing:hover {
        border-color: rgba(241, 193, 82, 0.7);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .job-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px solid rgba(241, 193, 82, 0.6);
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .job-header h2 {
        font-size: 1.8rem;
        color: rgba(241, 193, 82, .8);
    }

    .job-header .company-logo {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid rgba(241, 193, 82, 1);
    }

    .job-details {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .job-details h4 {
        margin-bottom: 10px;
        color: rgba(241, 193, 82, 1);
    }

    .job-description {
        margin-bottom: 20px;
    }

    .apply-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: rgba(241, 193, 82, 0.9);
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
        font-size: 1rem;
        transition: background-color 0.3s, transform 0.2s;
        border: 2px solid rgba(241, 193, 82, 1);
    }

    .apply-button:hover {
        background-color: rgba(241, 193, 82, 0.9);
        color: #fff;
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .apply-button:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(241, 193, 82, 0.5);
    }

    .company-info {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .company-info h5 {
        margin-bottom: 10px;
        color: rgba(241, 193, 82, 1);
    }

    .company-info p {
        margin-bottom: 5px;
    }

    .company-info a {
        color: rgba(241, 193, 82, 1);
        text-decoration: none;
    }

    .company-info a:hover {
        text-decoration: underline;
    }

    .custom-btn-show-more {
        display: inline-block;
        padding: 10px 20px;
        background-color: rgba(241, 193, 82, 0.9);
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
        font-size: 1rem;
        transition: background-color 0.3s, transform 0.2s;
        border: 2px solid rgba(241, 193, 82, 1);
    }

    .custom-btn-show-more:hover {
        background-color: rgba(241, 193, 82, 0.9);
        color: #fff;
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .custom-btn-show-more:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(241, 193, 82, 0.5);
    }

    /* CSS */
    .fade-in-section {
        opacity: 0;
        transition: opacity 0.6s ease-in-out;
    }

    .fade-in-section.section-visible {
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
                        <h1 class="display-1 text-dark">Job Offers</h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-dark" aria-current="page">Job Offers</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
    <div class="container">
        <h1 class="my-4 text-center" style="color:rgba(241, 193, 82, 1); font-size:3rem; text-align:center;">Current Job Offers</h1>
        <?php foreach ($allJobsOffers as $job): ?>
            <!-- Job Listing -->
            <div class="job-listing fade-in-section fade-in-<?= $job['job_id'] ?>">
                <div class="job-header">
                    <h2><?= $job['job_title'] ?></h2>
                    <!-- <img src="company-logo.png" alt="Company Logo" class="company-logo"> -->
                </div>
                <div class="job-details">
                    <h4>Location:</h4>
                    <p><?= $job['job_location'] ?></p>
                    <h4>Salary Range:</h4>
                    <p><?= $job['salary_range'] ?></p>
                    <h4>Job Type:</h4>
                    <p><?= $job['job_type'] ?></p>
                    <!-- Collapse Button -->
                    <div>
                        <button class="custom-btn-show-more" type="button" data-toggle="collapse" data-target="#details-<?= $job['job_id'] ?>" aria-expanded="false" aria-controls="details-<?= $job['job_id'] ?>">
                            Show More
                        </button>
                    </div>
                    <!-- Collapsible Section -->
                    <div class="collapse" id="details-<?= $job['job_id'] ?>">
                        <div class="job-description mt-3">
                            <h4 style="color:rgba(241, 193, 82, 1)">Job Description:</h4>
                            <p><?= nl2br(htmlspecialchars($job['job_description'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
                        </div>
                        <div class="job-description mt-3">
                            <h4 style="color:rgba(241, 193, 82, 1)">Job Qualifications:</h4>
                            <p><?= nl2br(htmlspecialchars($job['required_qualifications'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
                        </div>
                        <!-- Apply Now Button -->
                        <a href="careers.php?job_title=<?= urlencode($job['job_title']) ?>" class="apply-button">Apply Now</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>

    <?php require_once('common/footer.php'); ?>
    <?php require_once('common/script.php'); ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-light back-to-top"><i class="fa fa-arrow-up"></i></a>
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Using event delegation to handle multiple buttons
        document.querySelectorAll('.custom-btn-show-more').forEach(button => {
            button.addEventListener('click', function() {
                this.style.display = 'none';
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            // Query all unique fade-in sections
            const sections = document.querySelectorAll('.fade-in-section');

            const observerOptions = {
                root: null,
                threshold: 0.4
            };

            const observer = new IntersectionObserver(function(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('section-visible');
                        observer.unobserve(entry.target);
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