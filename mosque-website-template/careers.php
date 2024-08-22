<?php require_once('common/header.php');
require_once("class/apply.class.php");
$apply = new Apply();
$allAvailableJobs = $apply->getAvailableJobs();
?>
<style>
    h2 {
        color: rgba(241, 193, 82, 1);
        margin-bottom: 2rem;
        font-family: 'Arial', sans-serif;
    }

    .form-group label {
        font-weight: bold;
        color: rgba(0, 0, 0, 0.7);
    }

    .form-control {
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        padding: 0.75rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
        border-color: rgba(241, 193, 82, 0.7);
        box-shadow: 0 0 0 0.2rem rgba(241, 193, 82, 0.25);
    }

    .btn-primary1 {
        background-color: rgba(241, 193, 82, 1);
        border: none;
        border-radius: 40px;
        padding-left: 8rem;
        padding-right: 8rem;
        padding-top: 1rem;
        padding-bottom: 1rem;
        font-size: 20px;
        font-weight: bold;
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .btn-primary1:hover {
        background-color: rgba(241, 193, 82, 0.9);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Responsive Styles */
    @media (max-width: 1200px) {
        .btn-primary1 {
            padding-left: 6rem;
            padding-right: 6rem;
            font-size: 18px;
        }
    }

    @media (max-width: 992px) {
        .btn-primary1 {
            padding-left: 4rem;
            padding-right: 4rem;
            font-size: 16px;
        }
    }

    @media (max-width: 768px) {
        .btn-primary1 {
            padding-left: 3rem;
            padding-right: 3rem;
            padding-top: 0.8rem;
            padding-bottom: 0.8rem;
            font-size: 14px;
        }
    }

    @media (max-width: 576px) {
        .btn-primary1 {
            padding-left: 2rem;
            padding-right: 2rem;
            padding-top: 0.6rem;
            padding-bottom: 0.6rem;
            font-size: 12px;
        }
    }


    .form-group {
        margin-bottom: 1rem;
    }



    .con {
        background-color: #ffffff;
        margin-left: 5%;
        margin-right: 5%;
        padding: 3rem;
        border-radius: 10px;
        border: 1px solid rgba(241, 193, 82, 0.5);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
                        <h1 class="display-1 text-dark">Apply Now</h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-dark" aria-current="page">Apply Now</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <div class="con mt-5">
        <h2 class="text-center">Employee Admission Form</h2>
        <form method="post" action="actions/careers_application.php" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="position_applied">Availbale Jobs <span style="color:red; font-size:large">*</span></label>
                        <select class="form-control" id="position_applied" name="position_applied" required>
                            <?php
                            $jobTitle = isset($_GET['job_title']) ? htmlspecialchars($_GET['job_title'], ENT_QUOTES, 'UTF-8') : 'Select Option';
                            ?>


                            <option value=""><?= $jobTitle ?></option>

                            <?php foreach ($allAvailableJobs as $job): ?>
                                <option value="<?= htmlspecialchars($job['job_title']) ?>">
                                    <?= htmlspecialchars($job['job_title']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cv_path">CV Path <span style="color:red; font-size:large">*</span></label>
                        <input type="file" class="form-control" id="cv_path" name="cv_path[]" multiple required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cover_letter">Cover Letter Path <span style="color:red; font-size:large">*</span></label>
                        <input type="file" class="form-control" id="cover_letter" name="cover_letter[]" multiple required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="additional_files">Additional Documents Path </label>
                        <input type="file" class="form-control" id="additional_files" multiple name="additional_files[]">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="comments">Comments</label>
                        <input type="text" class="form-control" id="comments" name="comments">
                    </div>
                </div>
            </div>

            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-primary1">Submit</button>
            </div>
        </form>
    </div>

    <?php require_once('common/footer.php'); ?>
    <?php require_once('common/script.php'); ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-light back-to-top"><i class="fa fa-arrow-up"></i></a>

</body>

</html>