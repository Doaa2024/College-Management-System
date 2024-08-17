<?php
require_once("class/main.class.php");
$info = new Main();
$allInfo = $info->getAllInfo();
$allDetails = $info->getAllDetails();
$allEvents = $info->getEvents();
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('common/header.php'); ?>

<body>
    <?php require_once('common/navbar.php'); ?>
    <!-- Hero Start -->
    <div class="container-fluid hero-header" style="background: url('img/college1.png') ;  background-size: cover;background-position: center;background-repeat: no-repeat; ">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-header-inner animated zoomIn">
                        <p class="fs-4 text-dark">WELCOME TO <?= $allInfo[0]['Name'] ?></p>
                        <h1 class="display-1 mb-5 text-dark" style="font-size:45px;"><?= $allInfo[0]['welcomeStatement'] ?></h1>
                        <a href="" class="btn btn-primary py-3 px-5">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- About Satrt -->
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5 mb-5">
                <div class="col-xl-6">
                    <div class="row g-4">
                        <div class="col-6">
                            <img src="img/college13.webp" class="img-fluid h-100 wow zoomIn" data-wow-delay="0.1s" alt="">
                        </div>
                        <div class="col-6">
                            <img src="img/college14.jpeg" class="img-fluid pb-3 wow zoomIn" data-wow-delay="0.1s" alt="">
                            <img src="img/college16.jpg" class="img-fluid pt-3 wow zoomIn" data-wow-delay="0.1s" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeIn" data-wow-delay="0.5s">
                    <p class="fs-5 text-uppercase text-primary">About <?= $allInfo[0]['Name'] ?></p>
                    <h1 class="display-5 pb-4 m-0"><?= $allDetails[0]['Title1'] ?></h1>
                    <p class="pb-4"><?= $allDetails[0]['Title2'] ?></p>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="ps-3 d-flex align-items-center justify-content-start">
                                <span class="bg-primary btn-md-square rounded-circle mt-4 me-2"><i class="fa fa-eye text-dark fa-4x mb-5 pb-2"></i></span>
                                <div class="ms-4">
                                    <?php
                                    // Example data
                                    $description = $allDetails[0]['Description']; // e.g., "Section 1. Section 2. Section 3."
                                    $details = $allDetails[0]['Details']; // e.g., "Detail 1, Detail 2, Detail 3, Detail 4"

                                    // Split the description by periods (.)
                                    $descriptionParts = explode('.', $description);

                                    // Split the details by commas (,)
                                    $detailsParts = explode(',', $details);
                                    ?>
                                    <h5>Our Vision</h5>
                                    <p><?= $descriptionParts[0] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="ps-3 d-flex align-items-center justify-content-start">
                                <span class="bg-primary btn-md-square rounded-circle mt-4 me-2"><i class="fa fa-flag text-dark fa-4x mb-5 pb-2"></i></span>
                                <div class="ms-4">
                                    <h5>Our Mission</h5>
                                    <p><?= $descriptionParts[1] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <p class="mb-2"><i class="fa fa-check text-primary me-3"></i><?= $detailsParts[0] ?></p>
                            <p class="mb-0"><i class="fa fa-check text-primary me-3"></i><?= $detailsParts[1] ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><i class="fa fa-check text-primary me-3"></i><?= $detailsParts[2] ?></p>
                            <p class="mb-0"><i class="fa fa-check text-primary me-3"></i><?= $detailsParts[3] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container text-center bg-primary py-5 wow fadeIn" data-wow-delay="0.1s">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-2">
                        <i class="fa fa-graduation-cap fa-4x text-dark"></i>

                    </div>
                    <div class="col-lg-7 text-center text-lg-start">
                        <h1 class="mb-0">Everyone deserve to have his chance with learning</h1>
                    </div>
                    <div class="col-lg-3">
                        <a href="" class="btn btn-light py-2 px-4">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Activities Start -->
    <div class="container-fluid activities py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <p class="fs-5 text-uppercase text-primary">Details</p>
                <h1 class="display-3">Here Are Some Details</h1>
            </div>
            <?php
            // Example data
            $title = $allDetails[1]['Description']; // e.g., "Section 1. Section 2. Section 3."
            $definition = $allDetails[1]['Details']; // e.g., "Detail 1, Detail 2, Detail 3, Detail 4"

            // Split the description by periods (.)
            $titleParts = explode(',', $title);

            // Split the details by commas (,)
            $definitionParts = explode('/', $definition);
            ?>
            <div class="row g-4">
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.1s">
                        <i class="fa fa-graduation-cap fa-4x text-dark"></i>

                        <div class="ms-4">
                            <h4 style="font-size:20px;"><?= $titleParts[0] ?></h4>
                            <p class="mb-4"><?= $definitionParts[0] ?></p>
                            <a href="" class="btn btn-primary px-3">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.3s">
                        <i class="fa fa-exchange-alt fa-4x text-dark"></i>

                        <div class="ms-4">
                            <h4><?= $titleParts[1] ?></h4>
                            <p class="mb-4"><?= $definitionParts[1] ?></p>
                            <a href="" class="btn btn-primary px-3">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-user-graduate fa-4x text-dark"></i>

                        <div class="ms-4">
                            <h4><?= $titleParts[2] ?></h4>
                            <p class="mb-4"><?= $definitionParts[2] ?></p>
                            <a href="" class="btn btn-primary px-3">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.1s">
                        <i class="fa fa-dollar-sign fa-4x text-dark"></i>


                        <div class="ms-4">
                            <h4><?= $titleParts[3] ?></h4>
                            <p class="mb-4"><?= $definitionParts[3] ?></p>
                            <a href="" class="btn btn-primary px-3">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.3s">
                        <i class="fa fa-award fa-4x text-dark"></i>



                        <div class="ms-4">
                            <h4><?= $titleParts[4] ?></h4>
                            <p class="mb-4"><?= $definitionParts[4] ?></p>
                            <a href="" class="btn btn-primary px-3">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-users fa-4x text-dark"></i>

                        <div class="ms-4">
                            <h4><?= $titleParts[5] ?></h4>
                            <p class="mb-4"><?= $definitionParts[5] ?></p>
                            <a href="" class="btn btn-primary px-3">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Activities Start -->


    <!-- Events Start -->
    <div class="container-fluid event py-5">
        <div class="container py-5">
            <h1 class="display-3 mb-5 wow fadeIn" data-wow-delay="0.1s">Some <span class="text-primary">Events</span></h1>
            <div class="row g-4 event-item wow fadeIn" data-wow-delay="0.1s">
                <div class="col-3 col-lg-2 pe-0">
                    <div class="text-center border-bottom border-dark py-3 px-2">
                        <h6><?= $allEvents[0]['EventDate'] ?></h6>
                        <p class="mb-0"><?= $allEvents[0]['StartTime'] ?></p>
                    </div>
                </div>
                <div class="col-9 col-lg-6 border-start border-dark pb-5">
                    <div class="ms-3">
                        <h4 class="mb-3"><?= $allEvents[0]['EventName'] ?></h4>
                        <p class="mb-4"><?= $allEvents[0]['Description'] ?> </p>
                        <a href="#" class="btn btn-primary px-3">Join Now</a>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="overflow-hidden mb-5">
                        <img src="img/college17.jpg" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
            <div class="row g-4 event-item wow fadeIn" data-wow-delay="0.3s">
                <div class="col-3 col-lg-2 pe-0">
                    <div class="text-center border-bottom border-dark py-3 px-2">
                        <h6><?= $allEvents[1]['EventDate'] ?></h6>
                        <p class="mb-0"><?= $allEvents[1]['StartTime'] ?></p>
                    </div>
                </div>
                <div class="col-9 col-lg-6 border-start border-dark pb-5">
                    <div class="ms-3">
                        <h4 class="mb-3"><?= $allEvents[1]['EventName'] ?></h4>
                        <p class="mb-4"><?= $allEvents[1]['Description'] ?> </p>
                        <a href="#" class="btn btn-primary px-3">Join Now</a>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="overflow-hidden mb-5">
                        <img src="img/college18.jpg" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
            <div class="row g-4 event-item wow fadeIn" data-wow-delay="0.5s">
                <div class="col-3 col-lg-2 pe-0">
                    <div class="text-center border-bottom border-dark py-3 px-2">
                        <h6><?= $allEvents[2]['EventDate'] ?></h6>
                        <p class="mb-0"><?= $allEvents[2]['StartTime'] ?></p>
                    </div>
                </div>
                <div class="col-9 col-lg-6 border-start border-dark pb-5">
                    <div class="ms-3">
                        <h4 class="mb-3"><?= $allEvents[2]['EventName'] ?></h4>
                        <p class="mb-4"><?= $allEvents[2]['Description'] ?></p>
                        <a href="#" class="btn btn-primary px-3">Join Now</a>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="overflow-hidden mb-5">
                        <img src="img/college19.jpg" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Events End -->


    <!-- Sermon Start -->
    <div class="container-fluid sermon py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <p class="fs-5 text-uppercase text-primary">Goals</p>
                <h1 class="display-3" style="font-size:50px">Join The <?= $allInfo[0]['Name'] ?> Community</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-6 col-xl-4">
                    <div class="sermon-item wow fadeIn" data-wow-delay="0.1s">
                        <div class="overflow-hidden p-4 pb-0">
                            <img src="img/college20.jpg" class="img-fluid w-100" alt="">
                        </div>
                        <div class="p-4">
                            <div class="sermon-meta d-flex justify-content-between pb-2">
                                <div class="">

                                    <small><i class="fas fa-user me-2 text-muted"></i><a href="" class="text-muted">Admin</small></a>
                                </div>
                                <div class="">
                                    <a href="" class="me-1"><i class="fas fa-video text-muted"></i></a>
                                    <a href="" class="me-1"><i class="fas fa-headphones text-muted"></i></a>
                                    <a href="" class="me-1"><i class="fas fa-file-alt text-muted"></i></a>
                                    <a href="" class=""><i class="fas fa-image text-muted"></i></a>
                                </div>
                            </div>
                            <a href="" class="d-inline-block h4 lh-sm mb-3"><?= $allDetails[2]['Title1'] ?></a>
                            <p class="mb-0"><?= $allEvents[2]['Description'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="sermon-item wow fadeIn" data-wow-delay="0.3s">
                        <div class="overflow-hidden p-4 pb-0">
                            <img src="img/college23.webp" class="img-fluid w-100" alt="">
                        </div>
                        <div class="p-4">
                            <div class="sermon-meta d-flex justify-content-between pb-2">
                                <div class="">

                                    <small><i class="fas fa-user me-2 text-muted"></i><a href="" class="text-muted">Admin</small></a>
                                </div>
                                <div class="">
                                    <a href="" class="me-1"><i class="fas fa-video text-muted"></i></a>
                                    <a href="" class="me-1"><i class="fas fa-headphones text-muted"></i></a>
                                    <a href="" class="me-1"><i class="fas fa-file-alt text-muted"></i></a>
                                    <a href="" class=""><i class="fas fa-image text-muted"></i></a>
                                </div>
                            </div>
                            <a href="" class="d-inline-block h4 lh-sm mb-3"><?= $allDetails[3]['Title1'] ?></a>
                            <p class="mb-0"><?= $allDetails[3]['Description'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="sermon-item wow fadeIn" data-wow-delay="0.5s">
                        <div class="overflow-hidden p-4 pb-0">
                            <img src="img/college22.webp" class="img-fluid w-100" alt="">
                        </div>
                        <div class="p-4">
                            <div class="sermon-meta d-flex justify-content-between pb-2">
                                <div class="">

                                    <small><i class="fas fa-user me-2 text-muted"></i><a href="" class="text-muted">Admin</small></a>
                                </div>
                                <div class="">
                                    <a href="" class="me-1"><i class="fas fa-video text-muted"></i></a>
                                    <a href="" class="me-1"><i class="fas fa-headphones text-muted"></i></a>
                                    <a href="" class="me-1"><i class="fas fa-file-alt text-muted"></i></a>
                                    <a href="" class=""><i class="fas fa-image text-muted"></i></a>
                                </div>
                            </div>
                            <a href="" class="d-inline-block h4 lh-sm mb-3"><?= $allDetails[4]['Title1'] ?></a>
                            <p class="mb-0"><?= $allDetails[4]['Description'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sermon End -->
    <!-- Team Start -->
    <div class="container-fluid team py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <p class="fs-5 text-uppercase text-primary">Our Team</p>
                <h1 class="display-3">Meet Our Members</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 col-xl-5">
                    <div class="team-img wow zoomIn" data-wow-delay="0.1s">
                        <img src="img/team-1.jpg" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-8 col-xl-7">
                    <div class="team-item wow fadeIn" data-wow-delay="0.1s">
                        <h1><?= $allDetails[5]['Title1'] ?></h1>
                        <h5 class="fw-normal fst-italic text-primary mb-4"><?= $allDetails[5]['Title2'] ?></h5>
                        <p class="mb-4"><?= $allDetails[5]['Description'] ?></p>
                        <div class="team-icon d-flex align-items-center pb-4 mb-4 border-bottom border-primary">
                            <a class="btn btn-primary btn-lg-square me-3" href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= $allDetails[5]['Details'] ?>">
                                <i class="fas fa-envelope"></i>
                            </a>
                            <p class="mb-0" style="color:#666;"><?= $allDetails[5]['Details'] ?></p>
                        </div>

                    </div>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="team-item wow zoomIn" data-wow-delay="0.2s">
                                <img src="img/team-2.jpg" class="img-fluid w-100" alt="">
                                <div class="team-content text-dark text-center py-3">
                                    <div class="team-content-inner">
                                        <h5 class="mb-0"><?= $allDetails[6]['Title1'] ?></h5>
                                        <p class="text-dark"><?= $allDetails[6]['Title2'] ?></p>
                                        <div class="team-icon d-flex align-items-center justify-content-center">
                                            <a class="btn btn-primary" href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= $allDetails[6]['Description'] ?>" target="_blank" style="padding: 10px;">
                                                <i class="fas fa-envelope" style="font-size: 1.3rem;"></i>
                                            </a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-item wow zoomIn" data-wow-delay="0.4s">
                                <img src="img/team-3.jpg" class="img-fluid w-100" alt="">
                                <div class="team-content text-dark text-center py-3">
                                    <div class="team-content-inner">
                                        <h5 class="mb-0"><?= $allDetails[7]['Title1'] ?></h5>
                                        <p class="text-dark"><?= $allDetails[7]['Title2'] ?></p>
                                        <div class="team-icon d-flex align-items-center justify-content-center">
                                            <a class="btn btn-primary" href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= $allDetails[7]['Description'] ?>" target="_blank" style="padding: 10px;">
                                                <i class="fas fa-envelope" style="font-size: 1.3rem;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-item wow zoomIn" data-wow-delay="0.6s">
                                <img src="img/team-4.jpg" class="img-fluid w-100" alt="">
                                <div class="team-content text-dark text-center py-3">
                                    <div class="team-content-inner">
                                        <h5 class="mb-0"><?= $allDetails[8]['Title1'] ?></h5>
                                        <p class="text-dark"><?= $allDetails[8]['Title2'] ?></p>
                                        <div class="team-icon d-flex align-items-center justify-content-center">
                                            <a class="btn btn-primary" href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= $allDetails[8]['Description'] ?>" target="_blank" style="padding: 10px;">
                                                <i class="fas fa-envelope" style="font-size: 1.3rem;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testiminial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <p class="fs-5 text-uppercase text-primary">Testimonial</p>
                <h1 class="display-3">What People Say About Islam</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay="0.1s">
                <div class="testimonial-item">
                    <div class="d-flex mb-3">
                        <div class="position-relative">
                            <img src="img/testimonial-1.jpg" class="img-fluid" alt="">
                            <div class="btn-md-square bg-primary rounded-circle position-absolute" style="top: 25px; left: -25px;">
                                <i class="fa fa-quote-left text-dark"></i>
                            </div>
                        </div>
                        <div class="ps-3 my-auto ">
                            <h5 class="mb-0">Full Name</h5>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do tempor ut labore et dolore magna aliqua. Ut enim ad minim quis.</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <div class="d-flex mb-3">
                        <div class="position-relative">
                            <img src="img/testimonial-2.jpg" class="img-fluid" alt="">
                            <div class="btn-md-square bg-primary rounded-circle position-absolute" style="top: 25px; left: -25px;">
                                <i class="fa fa-quote-left text-dark"></i>
                            </div>
                        </div>
                        <div class="ps-3 my-auto ">
                            <h5 class="mb-0">Full Name</h5>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do tempor ut labore et dolore magna aliqua. Ut enim ad minim quis.</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <div class="d-flex mb-3">
                        <div class="position-relative">
                            <img src="img/testimonial-3.jpg" class="img-fluid" alt="">
                            <div class="btn-md-square bg-primary rounded-circle position-absolute" style="top: 25px; left: -25px;">
                                <i class="fa fa-quote-left text-dark"></i>
                            </div>
                        </div>
                        <div class="ps-3 my-auto ">
                            <h5 class="mb-0">Full Name</h5>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do tempor ut labore et dolore magna aliqua. Ut enim ad minim quis.</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <div class="d-flex mb-3">
                        <div class="position-relative">
                            <img src="img/testimonial-4.jpg" class="img-fluid" alt="">
                            <div class="btn-md-square bg-primary rounded-circle position-absolute" style="top: 25px; left: -25px;">
                                <i class="fa fa-quote-left text-dark"></i>
                            </div>
                        </div>
                        <div class="ps-3 my-auto ">
                            <h5 class="mb-0">Full Name</h5>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do tempor ut labore et dolore magna aliqua. Ut enim ad minim quis.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testiminial End -->
    <?php require_once('common/footer.php'); ?>
    <?php require_once('common/script.php'); ?>
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-light back-to-top"><i class="fa fa-arrow-up"></i></a>


    <script>
        window.addEventListener('scroll', function() {
            const heroHeader = document.querySelector('.hero-header');
            const scrollPosition = window.scrollY;
            const windowHeight = window.innerHeight;
            const fadeStart = windowHeight / 5; // Start fading after scrolling halfway down the viewport
            const fadeEnd = windowHeight * 1; // Fully faded after scrolling 1.5 times the viewport height

            // Calculate opacity based on scroll position
            if (scrollPosition >= fadeStart && scrollPosition <= fadeEnd) {
                heroHeader.style.opacity = 1 - (scrollPosition - fadeStart) / (fadeEnd - fadeStart);
            } else if (scrollPosition < fadeStart) {
                heroHeader.style.opacity = 1; // Fully visible before fade starts
            } else {
                heroHeader.style.opacity = 0; // Fully hidden after fade ends
            }
        });
    </script>
</body>

</html>