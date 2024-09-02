<?php
if (isset($_GET['insertion'])) {
    $id = $_GET['insertion'];
    // Process $insertion here
}
?>

<!DOCTYPE html>
<html lang="en">
<style>
    /* Centering the content and adding styling */
    .container-fluid {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background-color: transparent;
    }

    .container {
        background-color: transparent;
        padding: 3rem;
        border-radius: 10px;
        border: 2px solid rgba(241, 193, 82, .7);
    }

    .success-icon-top i {
        font-size: 3rem;
        color: rgba(241, 193, 82, .7);
        margin-bottom: 1rem;
    }

    h1.display-1 {
        font-size: 2.5rem;
        color: Black;
        margin-bottom: 1rem;
    }

    h1.mb-4 {
        color: rgba(241, 193, 82, 1);
        margin-bottom: 1rem;
    }

    p.mb-4 {
        color: rgba(241, 193, 82, 1);
        font-size: 1.2rem;
        margin-bottom: 2rem;
    }

    .btn-primary {
        background-color: rgba(241, 193, 82, .7);
        border: none;
        color: white;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: rgba(241, 193, 82, 1);
    }
</style>

<head>
    <meta charset="utf-8">
    <title>THEMosque - Mosque Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">



</head>



<!-- 404 Start -->
<div class="container-fluid py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="success-icon success-icon-top">
                    <i class="bi bi-check-circle-fill"></i> <!-- Updated icon -->
                </div>
                <h1 class="display-1">Apply Now</h1>
                <h1 class="mb-4">You Application ID is <?= $id ?></h1>
                <p class="mb-4">Your form has been submitted successfuly! Thank You for you cooperation...</p>
                <a class="btn btn-primary py-3 px-4" href="main.php">Go Back To Home</a>
            </div>
        </div>
    </div>
</div>
<!-- 404 End -->




<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-light back-to-top"><i class="fa fa-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>