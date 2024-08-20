<?php require_once('components/header.php'); ?>


<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Average Earnings/Semester</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Average Earnings/Year</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Current Semester Enrollments
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="h5 mb-0 font-weight-bold text-gray-800">215,000</div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i> <!-- Graduation cap for students -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Open Faculty Positions</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-business-time fa-2x text-gray-300"></i> <!-- Business time for open positions -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> Student Enrollment Trends</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>

                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> Student Enrollment Distribution by Branch</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>

                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Bar Chart -->

    <!-- Bootstrap core JavaScript-->


    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-5 mb-4 d-flex align-items-stretch">
            <!-- Project Card Example -->
            <div class="card shadow w-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Distribution by Top 5 Branches</h6>
                </div>
                <div class="card-body pb-3">
                    <h4 class="small font-weight-bold">Tripoli<span class="float-right">40%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Tyre<span class="float-right">10%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Khiara<span class="float-right">10%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Saida<span class="float-right">15%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Beirut<span class="float-right">5%</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 5%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 d-flex align-items-stretch">
            <div class="card shadow w-100">
                <div class="card-header py-3 text-primary">
                    <strong> NewsLetter</strong>
                    <i class="fa fa-calendar-check text-primary ml-2"></i>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action flex-column align-items-start border border-left-primary">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 text-primary" style="font-size: 0.875rem;">New Campus Initiatives</h5>
                                <small class=" text-primary">1 day ago</small>
                            </div>
                            <p class="mb-1" style="font-size: 0.875rem;">We are excited to announce several new initiatives aimed at enhancing student life and academic excellence. Our new research center is now open, and we’ve introduced a series of workshops to support professional development.</p>
                        </a>
                        <a class="list-group-item list-group-item-action flex-column align-items-start border border-left-primary">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 text-primary" style="font-size: 0.875rem;">Faculty Achievements</h5>
                                <small class="text-primary">3 days ago</small>
                            </div>
                            <p class="mb-1" style="font-size: 0.875rem;">Congratulations to Dr. Jane Smith for receiving the prestigious National Teaching Award! Additionally, our Computer Science department has launched a new collaborative project with industry leaders.</p>
                        </a>
                        <a class="list-group-item list-group-item-action flex-column align-items-start border border-left-primary">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 text-primary" style="font-size: 0.875rem;">Campus Facilities Upgrades</h5>
                                <small class=" text-primary">3 days ago</small>
                            </div>
                            <p class="mb-1" style="font-size: 0.875rem;">We’ve completed major renovations in the library and student center to provide a more modern and comfortable environment. The new study rooms and lounge areas are now available for student use.</p>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->


<?php require_once("components/footer.php"); ?>



<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>



<?php require_once("components/scripts.php"); ?>
</body>

</html>