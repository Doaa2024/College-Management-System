<?php require_once('common/header.php'); ?>
<style>
    .custom-input {
        background-color: white;
        border: 2px solid rgba(241, 193, 82, 0.7);
        padding: 15px;
        color: #333;
        border-radius: 40px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-input:focus {
        border-color: rgba(241, 193, 82, 1);
        box-shadow: 0 6px 12px rgba(241, 193, 82, 0.5);
        outline: none;
    }

    .custom-button {
        background-color: rgba(241, 193, 82, .9);
        color: white;
        padding: 15px 30px;
        border-radius: 40px;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-button:hover {
        background-color: rgba(241, 193, 82, 1);
        box-shadow: 0 6px 12px rgba(241, 193, 82, 0.7);
        transform: translateY(-2px);
    }

    .custom-button:active {
        transform: scale(0.95);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .custom-button:focus {
        outline: none;
        box-shadow: 0 6px 12px rgba(241, 193, 82, 0.7);
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
                        <h1 class="display-1 text-dark">Contact</h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-dark" aria-current="page">Contact</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <p class="fs-5 text-uppercase text-primary">Get In Touch</p>
                <h1 class="display-3">Contact For Any Queries</h1>
                <p class="mb-0">The contact form is submitted by email, the response would be as soon as possible. </p>
            </div>
            <form
                action="https://formspree.io/f/xovananp"
                method="POST">
                <div class="row g-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control custom-input" placeholder="Your Name" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="email" name="email" class="form-control custom-input" placeholder="Your Email" required>
                    </div>
                    <div class="col-12">
                        <input type="text" name="subject" class="form-control custom-input" placeholder="Subject" required>
                    </div>
                    <div class="col-12">
                        <textarea name="message" class="w-100 form-control custom-input" rows="6" placeholder="Your Message" required></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn custom-button" type="submit">Send Message</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- Contact Start -->

    <?php require_once('common/footer.php'); ?>
    <?php require_once('common/script.php'); ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-light back-to-top"><i class="fa fa-arrow-up"></i></a>


</body>

</html>