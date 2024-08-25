<?php
require_once('DAL/retrieve.class.php');
require_once('components/header.php');
require_once('components/sidebar.php');
require_once('components/navbar.php');

$dataRetrieval = new UniversityDataRetrieval();

// Default branch ID
$branchId = isset($_GET['branchId']) ? intval($_GET['branchId']) : 1;

// Fetch data
$totalStudents = $dataRetrieval->getTotalStudentsInBranch($branchId);
$currentSemesterCourses = $dataRetrieval->getCurrentSemesterCourses();
$branchRevenue = $dataRetrieval->getBranchRevenue($branchId);
$availableRooms = $dataRetrieval->getAvailableRooms($branchId);

$enrollmentVsDemand = $dataRetrieval->getEnrollmentVsDemand($branchId);
$studentEnrollmentByDepartment = $dataRetrieval->getTopDepartmentEnrollmentsByBranch($branchId);
$topDepartmentRevenue = $dataRetrieval->getTopDepartmentRevenueDistribution($branchId);
$recentNewsletters = $dataRetrieval->getRecentNewsletters();

// Extract numeric values from the results
$totalStudentsCount = $totalStudents ? $totalStudents[0]['total_students'] : 0;
$coursesCount = count($currentSemesterCourses);
$branchRevenueTotal = $branchRevenue ? $branchRevenue[0]['total_revenue'] : 0;
$availableRoomsCount = $availableRooms[0]['AvailableRoomCount'];
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="generate-pdf">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Students Enrolled in Branch -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Students Enrolled in Branch
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo number_format($totalStudentsCount); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Offered in Current Semester -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Courses Offered In Current Semester
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo number_format($coursesCount); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Generated in Branch -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Revenue Generated in Branch
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                $<?php echo number_format($branchRevenueTotal, 2); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rooms Available -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Rooms Available
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo $availableRoomsCount; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-business-time fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7 d-flex">
            <div class="card shadow mb-4 w-100 d-flex flex-column">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Real Time Enrollment | Courses</h6>
                </div>
                <div class="card-body flex-grow-1 d-flex">
                    <div class="chart-area w-100">
                        <canvas id="myAreaCharto" class="w-100 h-100"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5 d-flex">
            <div class="card shadow mb-4 w-100 d-flex flex-column">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Student Enrollment By Departments</h6>
                </div>
                <div class="card-body flex-grow-1 d-flex">


                    <div class="chart-container">
                        <canvas class="myPieCharto" id="myPieCharto"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Content Row -->
    <div class="row">
        <?php
        // Calculate total revenue
        $totalRevenue = array_sum(array_column($topDepartmentRevenue, 'TotalRevenue'));
        ?>

        <div class="col-lg-5 mb-4 d-flex align-items-stretch">
            <!-- Project Card Example -->
            <div class="card shadow w-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue From Student Fees Distributed by Branch Departments</h6>
                </div>
                <div class="card-body pb-3">
                    <!-- Foreach loop to show elements from array -->
                    <?php foreach ($topDepartmentRevenue as $department):
                        // Calculate percentage of total revenue
                        $percentage = ($department['TotalRevenue'] / $totalRevenue) * 100;
                    ?>
                        <h4 class="small font-weight-bold">
                            <?php echo htmlspecialchars($department['DepartmentName']); ?>
                            <span class="float-right"><?php echo number_format($percentage, 2); ?>%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>



        <div class="col-lg-7 d-flex align-items-stretch">
            <div class="card shadow w-100">
                <div class="card-header py-3 text-primary">
                    <strong>NewsLetter</strong>
                    <i class="fa fa-calendar-check text-primary ml-2"></i>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <?php foreach ($recentNewsletters as $newsletter): ?>
                            <a class="list-group-item list-group-item-action flex-column align-items-start border border-left-primary">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 text-primary"><?php echo htmlspecialchars($newsletter['Title']); ?></h5>
                                    <small class="text-primary"><?php echo date('F j, Y', strtotime($newsletter['CreatedAt'])); ?></small>
                                </div>
                                <p class="mb-1"><?php echo htmlspecialchars($newsletter['Content']); ?></p>
                            </a>
                        <?php endforeach; ?>
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<?php
// Fetch the data
$yearlyEnrollmentVsCoursesData = $dataRetrieval->getEnrollmentVsDemand();
$studentEnrollmentByDepartment = $dataRetrieval->getTopDepartmentEnrollmentsByBranch($branchId);

// Convert data to JSON
$yearlyEnrollmentVsCoursesJson = json_encode($yearlyEnrollmentVsCoursesData);
$studentEnrollmentByDepartmentJson = json_encode($studentEnrollmentByDepartment);
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data from PHP
        var yearlyData = <?php echo $yearlyEnrollmentVsCoursesJson; ?>;

        // Prepare labels and data for Area Chart
        var labels = yearlyData.map(item => item.Year);
        var enrollmentsData = yearlyData.map(item => item.TotalEnrollments);
        var coursesData = yearlyData.map(item => item.TotalCourses);

        // Create Area Chart
        var ctxArea = document.getElementById('myAreaCharto').getContext('2d');
        var areaChart = new Chart(ctxArea, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Total Enrollments',
                        data: enrollmentsData,
                        backgroundColor: 'rgba(78, 115, 223, 0.2)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Courses',
                        data: coursesData,
                        backgroundColor: 'rgba(28, 200, 138, 0.2)',
                        borderColor: 'rgba(28, 200, 138, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var studentEnrollmentByDepartmentData = <?php echo $studentEnrollmentByDepartmentJson; ?>;

        // Prepare labels and data for Pie Chart
        var pieLabels = studentEnrollmentByDepartmentData.map(item => item.DepartmentName);
        var pieData = studentEnrollmentByDepartmentData.map(item => item.TotalEnrollments);

        // Define colors dynamically or use a fixed set of colors




        // Create Pie Chart
        var ctxPie = document.getElementById('myPieCharto').getContext('2d');
        var pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: pieLabels,
                datasets: [{
                    label: 'Student Enrollment by Department',
                    data: pieData,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#e74a3b', '#f6c23e'] // Ensure colors match the number of labels
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    position: 'top'
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                }
            }
        });
    });
</script>




</body>

</html>