<?php
require_once("class/main.class.php");
$info = new Main();
$allInfo = $info->getAllInfo();
?>
<!-- Footer Start -->
<div class="container-fluid footer pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-lg-7">
                <h1 class="text-light mb-0">Subscribe our newsletter</h1>
                <p class="text-secondary">Get the latest news of our university</p>
            </div>
            <div class="col-lg-5">
                <div class="position-relative mx-auto">
                    <input style="border-radius: 30px;" class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Subcribe</button>
                </div>
            </div>
            <div class="col-12">
                <div class="border-top border-secondary"></div>
            </div>
        </div>
        <div class="row g-4 footer-inner">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item mt-5">
                    <?php
                    // Assuming $allInfo[0]['Name'] contains the full name
                    $name = $allInfo[0]['Name'];
                    $lastLetter = substr($name, -1); // Get the last letter
                    $nameWithoutLastLetter = substr($name, 0, -1); // Get the name without the last letter
                    ?>

                    <h4 class="text-light mb-4">
                        <?= $nameWithoutLastLetter ?><span class="text-primary"><?= $lastLetter ?></span>
                    </h4>

                    <p class="mb-4 text-secondary">Universities offer a broad range of academic program, aimed at equipping students with in-depth knowledge and critical thinking skills.</p>
                    <a href="" class="btn btn-primary py-2 px-4">Login Now</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item mt-5">
                    <h4 class="text-light mb-4">Our University</h4>
                    <div class="d-flex flex-column">
                        <h6 class="text-secondary mb-0">Our Address</h6>
                        <div class="d-flex align-items-center border-bottom py-4">
                            <span class="flex-shrink-0 btn-square bg-primary me-3 p-4"><i class="fa fa-map-marker-alt text-dark"></i></span>
                            <a href="" class="text-body"><?= $allInfo[0]['Location'] ?></a>
                        </div>
                        <h6 class="text-secondary mt-4 mb-0">Our Mobile</h6>
                        <div class="d-flex align-items-center py-4">
                            <span class="flex-shrink-0 btn-square bg-primary me-3 p-4"><i class="fa fa-phone-alt text-dark"></i></span>
                            <a href="" class="text-body"><?= $allInfo[0]['PhoneNumber'] ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item mt-5">
                    <h4 class="text-light mb-4">Explore Link</h4>
                    <div class="d-flex flex-column align-items-start">
                        <a class="text-body mb-2" href=""><i class="fa fa-check text-primary me-2"></i>Home</a>
                        <a class="text-body mb-2" href=""><i class="fa fa-check text-primary me-2"></i>About Us</a>
                        <a class="text-body mb-2" href=""><i class="fa fa-check text-primary me-2"></i>Transfer</a>
                        <a class="text-body mb-2" href=""><i class="fa fa-check text-primary me-2"></i>Contact us</a>
                        <a class="text-body mb-2" href=""><i class="fa fa-check text-primary me-2"></i>Requirements</a>
                        <a class="text-body mb-2" href=""><i class="fa fa-check text-primary me-2"></i>Freshman</a>
                        <a class="text-body mb-2" href=""><i class="fa fa-check text-primary me-2"></i>School</a>
                        <a class="text-body mb-2" href=""><i class="fa fa-check text-primary me-2"></i>Calender</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item mt-5">
                    <h4 class="text-light mb-4">Success is our goal</h4>
                    <div class="d-flex border-bottom border-secondary py-4">
                        <img src="img/college33.webp" class="img-fluid flex-shrink-0" alt="" style="height: 100px; width:100px">
                        <div class="ps-3">
                            <p class="mb-0 text-muted">You born to shine</p>
                            <p href="" class="text-body">We will lead you to always bright</p>
                        </div>
                    </div>
                    <div class="d-flex py-4">
                        <img src="img/college32.jpg" class="img-fluid flex-shrink-0" alt="" style="height: 100px; width:100px">
                        <div class="ps-3">
                            <p class="mb-0 text-muted">Our endless mission</p>
                            <p href="" class="text-body">To make you a successful person</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-4">
        <div class="border-top border-secondary pb-4"></div>
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                &copy; <a class="border-bottom" href="www.<?= $allInfo[0]['Name'] ?>.com">www.<?= $allInfo[0]['Name'] ?>.com</a>, All Right Reserved.
            </div>
            <div class="col-md-6 text-center text-md-end">
                <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                Designed By <span class="border-bottom" style="color:orange;">doaa&ali</span>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->