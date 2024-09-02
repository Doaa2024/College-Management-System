<?php
if (isset($_GET['insertion'])) {
    $id = $_GET['insertion'];
    // Process $insertion here
}
?>
<!DOCTYPE html>
<html lang="en">
<style>
    /* Define a consistent blue color */
    :root {
        --main-blue: #1E90FF;
        /* DodgerBlue */
        --hover-blue: #4682B4;
        /* SteelBlue */
        --active-blue: #4169E1;
        /* RoyalBlue */
        --light-blue: #87CEFA;
        /* LightSkyBlue */
    }

    /* Center the container and apply styling */
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
        border-radius: 15px;
        /* Rounded corners */
        border: 2px solid var(--main-blue);
        /* Main blue color */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Subtle shadow */
        text-align: center;
        /* Center-align text inside the container */
    }

    /* Success icon styling */
    .success-icon-top i {
        font-size: 3rem;
        color: var(--main-blue);
        /* Main blue color */
        margin-bottom: 1rem;
    }

    /* Heading and paragraph styling */
    h1.display-1 {
        font-size: 2.5rem;
        color: #003366;
        /* Deep Navy */
        margin-bottom: 1rem;
    }

    h1.mb-4 {
        color: var(--main-blue);
        /* Main blue color */
        margin-bottom: 1rem;
    }

    p.mb-4 {
        color: var(--light-blue);
        /* LightSkyBlue */
        font-size: 1.2rem;
        margin-bottom: 2rem;
    }

    /* Button styling */
    .btn-primary {
        background-color: var(--main-blue);
        /* Main blue color */
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        /* Increased padding */
        font-size: 1rem;
        /* Font size */
        border-radius: 25px;
        /* Rounded button */
        transition: background-color 0.3s ease, transform 0.3s ease;
        /* Smooth transitions */
        cursor: pointer;
        /* Pointer cursor on hover */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Subtle shadow */
        text-decoration: none;
        /* Remove underline */
    }

    .btn-primary:hover {
        background-color: var(--hover-blue);
        /* Hover blue color */
        transform: translateY(-2px);
        /* Slight lift effect */
    }

    .btn-primary:active {
        background-color: var(--active-blue);
        /* Active blue color */
        transform: translateY(0);
        /* Reset lift effect */
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
                <a class="btn btn-primary py-3 px-4" href="index.php">Go Back To Home</a>
            </div>
        </div>
    </div>
</div>
<!-- 404 End -->




<!-- Back to Top -->


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