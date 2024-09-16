<?php
require_once('DAL/retrieve.class.php');
require_once('components/header.php');
require_once('components/sidebar.php');
require_once('components/navbar.php');
$dataRetrieval = new UniversityDataRetrieval();
$facultyID = isset($_SESSION['facultyID']) ? $_SESSION['facultyID'] : 6;
$studentCountByFaculty = $dataRetrieval->getStudentCountByFaculty($facultyID);
$professorCountByFaculty = $dataRetrieval->getProfessorCountByFaculty($facultyID);
$majorCount = $dataRetrieval->getMajorCountByFaculty($facultyID);
$recentNewsletters = $dataRetrieval->getRecentNewsletters();
$salary = $dataRetrieval->getSalary();
$studentCountByDepartment = $dataRetrieval->getTopDepartmentEnrollmentsByFaculty($facultyID);
$facultyCount = $dataRetrieval->getFacultyCountByYear($facultyID);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="generate-pdf"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>


    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4 ">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Students Enrolled in Faculty
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo number_format($studentCountByFaculty[0]['StudentCount']); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
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
                                Professors Enrolled in Faculty</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php echo number_format($professorCountByFaculty[0]['ProfessorCount']); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                            `
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Majors Count in Faculty
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php echo number_format($majorCount[0]['majorCount']); ?></div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-open fa-2x text-gray-300"></i>
                            <!-- Graduation cap for students -->

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
                                My Salary </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $salary[0]['Salary'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                            <!-- Business time for open positions -->

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
                    <h6 class="m-0 font-weight-bold text-primary"> Student Registered Count IN Faculty</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaCharto"></canvas>
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
                    <h6 class="m-0 font-weight-bold text-primary">Student Per Department in Faculty </h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieCharto"></canvas>
                    </div>
                    <!-- <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div> -->
                </div>
            </div>
        </div>

    </div>
    <!-- Bar Chart -->

    <!-- Bootstrap core JavaScript-->


    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <?php
        $facultyPerbranch = $dataRetrieval->getfacultyPerBranch($facultyID);
        $totalStudent = 0;
        foreach ($facultyPerbranch as $student) {
            $totalStudent += $student['StudentCount'];
        }


        ?>
        <div class="col-lg-5 mb-4 d-flex align-items-stretch">
            <!-- Project Card Example -->
            <div class="card shadow w-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Student Per Branches IN Faculty</h6>
                </div>
                <div class="card-body pb-3">
                    <?php foreach ($facultyPerbranch as $user) :
                        // Calculate percentage of total revenue
                        $percentage = ($user['StudentCount'] / $totalStudent) * 100;
                    ?>
                        <h4 class="small font-weight-bold">
                            <?= $user['BranchName']; ?>
                            <span class="float-right"><?= round($percentage, 2); ?>%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= $percentage; ?>%" aria-valuenow="<?= $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    <?php endforeach; ?>
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
                        <?php foreach ($recentNewsletters as $newsletter): ?>
                            <a class="list-group-item list-group-item-action flex-column align-items-start border border-left-primary">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 text-primary"><?php echo htmlspecialchars($newsletter['Title']); ?></h5>
                                    <small class=" text-primary"><?php echo date('F j, Y', strtotime($newsletter['CreatedAt'])); ?></small>
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

<?php $studentCountByDepartment = $dataRetrieval->getTopDepartmentEnrollmentsByFaculty($facultyID) ?>
<?php require_once("components/scripts.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js library -->

<!-- PDF generation libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


<script>
    var ctx = document.getElementById("myPieCharto").getContext('2d');

    // Correctly assign data from PHP
    const student = <?php echo json_encode($studentCountByDepartment); ?>;

    // Log the data for debugging
    console.log("Student Data:", student); // Debugging: Check if data is correct

    // Extract department names and counts
    const departmentName = student.map(item => item.DepartmentName); // Corrected variable usage
    const count = student.map(item => parseInt(item.StudentCount)); // Correct parsing of StudentCount to integer

    // Initialize the Pie Chart
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: departmentName, // Use mapped department names
            datasets: [{
                data: count, // Use mapped student counts
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#e74a3b', '#f6c23e'], // Background colors for pie slices
            }],
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                position: 'top',
                labels: {
                    fontColor: '#333', // Customize label font color if needed
                }
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
            },
        }
    });

    // Convert PHP data to JavaScript array
    const facultyCount = <?php echo json_encode($facultyCount); ?>;

    // Prepare the data for Chart.js
    const years = facultyCount.map(item => item.Year);
    const studentCount = facultyCount.map(item => parseInt(item.FacultyCount));
    const cumulitiveCount = facultyCount.map(item => parseInt(item.CumulativeFacultyCount));

    // Create the chart
    const vtx = document.getElementById("myAreaCharto").getContext('2d');
    const myAreaChart = new Chart(vtx, {
        type: 'line', // Type 'line' for area chart with a filled area
        data: {
            labels: years, // X-axis labels
            datasets: [{
                label: "Year Count",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                hoverRadius: 0, // Disabling hover effects
                hoverBackgroundColor: 'transparent',
                hoverBorderColor: 'transparent',
                data: studentCount, // Y-axis data for enrollment count
            }, {
                label: "Cumulative Count",
                lineTension: 0.3,
                backgroundColor: "rgba(28, 200, 138, 0.05)",
                borderColor: "rgba(28, 200, 138, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(28, 200, 138, 1)",
                pointBorderColor: "rgba(28, 200, 138, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                hoverRadius: 0, // Disabling hover effects
                hoverBackgroundColor: 'transparent',
                hoverBorderColor: 'transparent',
                data: cumulitiveCount, // Y-axis data for cumulative enrollment
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                x: {
                    time: {
                        unit: 'year'
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                },
                y: {
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        callback: function(value) {
                            return value;
                        }
                    },
                    grid: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }
            },
            legend: {
                display: true // Show the legend
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: 'blue',
                bodyColor: "#858796",
                titleColor: '#6e707e',
                borderColor: 'blue',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,

                mode: 'index',
                intersect: false,
                caretPadding: 10
            }
        }
    });
    document.getElementById('generate-pdf').addEventListener('click', async () => {
        // Ensure the jsPDF library is loaded
        if (!window.jspdf) {
            console.error('jsPDF library is not loaded.');
            return;
        }

        const {
            jsPDF
        } = window.jspdf; // Access jsPDF from the window.jspdf object

        // Create a new instance of jsPDF
        const pdf = new jsPDF();

        // Function to add chart images to PDF
        const addChartToPDF = async (chartId, x, y) => {
            const canvas = document.getElementById(chartId);
            if (canvas) {
                const imgData = canvas.toDataURL('image/png');
                pdf.addImage(imgData, 'PNG', x, y, 180, 90); // Adjust width and height as needed
                return 90; // Return the height used by the chart
            }
            return 0;
        };

        // Add content to the first page
        const addContentToFirstPage = async () => {
            pdf.setFontSize(22);
            pdf.text("Dean Dashboard Report", 14, 20);

            pdf.setFontSize(16);
            pdf.text("Student Enrolled IN Faculty: <?php echo $studentCountByFaculty[0]['StudentCount']  ?>", 14, 70);
            pdf.text("Professor Enrolled : <?php echo number_format($professorCountByFaculty[0]['ProfessorCount'], 2); ?>", 14, 50);
            pdf.text("Major Count IN Faculty: <?php echo number_format($majorCount[0]['majorCount']); ?>", 14, 60);
            pdf.text("My Salary: <?php echo number_format($salary[0]['Salary'], 2); ?>", 14, 40);
            // Adding revenue branches information

            let y = 100;
            // Add Area Chart to the first page
            pdf.setFontSize(16);
            pdf.text("Enrollment Distribution By Branch", 14, y + 20); // Title for Area Chart
            const areaChartY = y + 30;
            await addChartToPDF('myAreaCharto', 14, areaChartY);
            y = areaChartY + 100; // Move y down for the next chart or content

            return y; // Return the y position after adding area chart for charts placement
        };

        // Add content to the second page
        const addContentToSecondPage = async (startY) => {
            // Create a new page
            pdf.addPage();

            // Add Pie Chart to the second page
            pdf.setFontSize(16);
            pdf.text("Student Per Department in Faculty", 14, 20); // Title for Pie Chart
            const pieChartY = 30;
            await addChartToPDF('myPieCharto', 14, pieChartY);

            // Adjust y position for additional content if needed
            let y = pieChartY + 100; // Move y down after pie chart
        };

        // Execute functions to generate the PDF
        const yAfterFirstPage = await addContentToFirstPage();
        await addContentToSecondPage(yAfterFirstPage);

        // Save the PDF
        pdf.save('report.pdf');
    });
</script>




</body>

</html>