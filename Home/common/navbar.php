<?php
require_once("class/main.class.php");
$info = new Main();
$allInfo = $info->getAllInfo();
?>

<style>
    .dropdown-item.active {
        background-color: rgba(241, 193, 82, 1);
        color: #fff;
        /* Optionally change the text color for better visibility */
    }
</style>




<!-- Topbar start -->
<div class="container-fluid fixed-top">
    <div class="container topbar d-none d-lg-block">
        <div class="topbar-inner" style="background-color: rgba(255, 255, 255, .5);">
            <div class="row gx-0">
                <div class="col-lg-7 text-start">
                    <div class="h-100 d-inline-flex align-items-center me-4">
                        <span class="fa fa-phone-alt me-2 text-dark"></span>
                        <a href="#" class="text-secondary"><span><?= $allInfo[0]['PhoneNumber'] ?></span></a>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center">
                        <span class="far fa-envelope me-2 text-dark"></span>
                        <a href="#" class="text-secondary"><span><?= $allInfo[0]['Email'] ?></span></a>
                    </div>
                </div>
                <div class="col-lg-5 text-end">
                    <div class="h-100 d-inline-flex align-items-center">
                        <span class="text-body">Follow Us:</span>
                        <a class="text-dark px-2" href="<?= $allInfo[0]['Facebook'] ?>"><i class="fab fa-facebook-f"></i></a>
                        <a class="text-dark px-2" href="<?= $allInfo[0]['Twitter'] ?>"><i class="fab fa-twitter"></i></a>
                        <a class="text-dark px-2" href="<?= $allInfo[0]['Linkedin'] ?>"><i class="fab fa-linkedin-in"></i></a>
                        <a class="text-dark px-2" href="<?= $allInfo[0]['Instagram'] ?>"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <nav class="navbar navbar-light navbar-expand-lg py-3">
            <a href="index.html" class="navbar-brand">
                <?php
                // Assuming $name contains the name string, e.g., "DAU"
                $name = $allInfo[0]['Name']; // Replace this with the dynamic value if necessary
                $lastLetter = substr($name, -1); // Get the last letter (e.g., "U")
                $nameWithoutLastLetter = substr($name, 0, -1); // Get the name without the last letter (e.g., "DA")
                ?>

                <h1 class="mb-0" style="font-size:2.7rem; color:black;">
                    <?= $nameWithoutLastLetter ?><span class="text-primary"><?= $lastLetter ?></span>
                </h1>

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav ms-lg-auto mx-xl-auto">
                    <a href="main.php" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Academic</a>
                        <div class="dropdown-menu m-0 rounded-0">
                            <a href="school.php" class="dropdown-item <?= basename($_SERVER['PHP_SELF']) == 'school.php' ? 'active' : '' ?>">Schools</a>
                            <a href="freshman.php" class="dropdown-item <?= basename($_SERVER['PHP_SELF']) == 'freshman.php' ? 'active' : '' ?>">FreshMan</a>
                        </div>
                    </div>

                    <a href="about.php" class="nav-item nav-link">About</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Careers</a>
                        <div class="dropdown-menu m-0 rounded-0">
                            <a href="offers.php" class="dropdown-item <?= basename($_SERVER['PHP_SELF']) == 'offers.php' ? 'active' : '' ?>">Job Offers</a>
                            <a href="careers.php" class="dropdown-item <?= basename($_SERVER['PHP_SELF']) == 'careers.php' ? 'active' : '' ?>">Apply Now</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Admission</a>
                        <div class="dropdown-menu m-0 rounded-0">
                            <a href="requirements.php" class="dropdown-item <?= basename($_SERVER['PHP_SELF']) == 'requirements.php' ? 'active' : '' ?>">Requirements</a>
                            <a href="transfer.php" class="dropdown-item <?= basename($_SERVER['PHP_SELF']) == 'transfer.php' ? 'active' : '' ?>">Transfer</a>
                        </div>
                    </div>

                    <a href="apply.php" class="nav-item nav-link">Apply Now</a>
                    <a href="calender.php" class="nav-item nav-link">Calendar</a>

                    <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                </div>
                <a href="login.php" class="btn btn-primary py-2 px-4 d-none d-xl-inline-block">Login</a>
            </div>
        </nav>
    </div>
</div>
<!-- Topbar End -->