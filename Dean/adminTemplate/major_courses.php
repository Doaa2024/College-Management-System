<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php');
require_once('DAL/retrieve.class.php');
?>
<?php // Instantiate the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();
$facultyID = isset($_SESSION['facultyID']) ? $_SESSION['facultyID'] : 9;
// Retrieve all branches
$courses = $universityData->getAllCourses();
$departments = $universityData->getAllDepartmentsInFaculty($facultyID);
// Check if 'departmentID' is set in the URL query parameters and is not empty
if (isset($_GET['departmentID']) && !empty($_GET['departmentID'])) {
    // Get the department ID from the URL
    $departmentID = $_GET['departmentID'];

    // Fetch courses for the selected department
    $coursesDepartment = $universityData->getAllCoursesINDepartments($departmentID);
} else {
    // If 'departmentID' is not set or empty, fetch all courses
    $coursesDepartment = $universityData->getAllCourses();
}
?>
<!-- Custom styles for this page -->


<style>
    :root {
        --blue: #4e73df;
        --white: #ffffff;
    }

    body {
        background-color: var(--white);
        color: var(--blue);
    }

    .btn-primary {
        background-color: var(--blue);
        border: none;
    }

    .dropdown-select {
        display: inline-block;
        width: auto;
        margin-left: 10px;
        border: 1px solid var(--blue);
    }

    .btn-group {
        display: flex;
        align-items: center;
    }
</style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" style="min-height:72vh;">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Manage Courses</h1>

            <!-- Controls -->
            <div class="d-flex justify-content-between mb-4">
                <!-- Add Course Button -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCourseModal">
                    Add Course
                </button>

                <!-- Department Dropdown -->
                <div class="btn-group">

                    <!-- Department Select Dropdown -->
                    <select id="departmentSelect" class="form-control dropdown-select" onchange="redirectWithDepartmentID()">
                        <option value="">Select Department</option>
                        <!-- Loop through departments to create options -->
                        <?php foreach ($departments as $department) : ?>
                            <option value="<?php echo htmlspecialchars($department['DepartmentID']); ?>"
                                <?php
                                // Check if the current department ID matches the one in the URL
                                if (isset($_GET['departmentID']) && $_GET['departmentID'] == $department['DepartmentID']) {
                                    echo 'selected'; // Set the selected attribute
                                }
                                ?>>
                                <?php echo htmlspecialchars($department['DepartmentName']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>



                </div>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Courses Table</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Course Code</th>
                                    <th>Credits</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="courseList">
                                <!-- Example course rows, replace with dynamic PHP content -->

                                <?php if (!empty($coursesDepartment)) : ?>
                                    <?php foreach ($coursesDepartment as $course) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($course['CourseName']); ?></td>
                                            <td><?php echo htmlspecialchars($course['CourseCode']); ?></td>
                                            <td><?php echo htmlspecialchars($course['Credits']); ?></td>
                                            <td>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="deleteCourse(
        <?php echo htmlspecialchars($course['CourseID']); ?>, 
        '<?php echo isset($_GET['departmentID']) ? htmlspecialchars($_GET['departmentID']) : 'Null'; ?>'
    )">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="4">No courses available.</td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Add Course Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">Add Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addCourseForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="courseCode" style="margin-left:2%">Courses</label>
                            <input type="hidden" name="departmentID" value="<?php echo isset($_GET['departmentID']) ? htmlspecialchars($_GET['departmentID']) : 'Null'; ?>">
                            <select id="courseSelect" class="form-control dropdown-select" name="CourseID">
                                <option value="">Select Course</option>
                                <?php if (!empty($courses)) : ?>
                                    <?php
                                    $seen = []; // Array to track seen combinations
                                    foreach ($courses as $course) :
                                        $courseText = htmlspecialchars($course['CourseName'] . ' (' . $course['CourseCode'] . ') / ' . $course['Credits'] . ' Credits');
                                        if (!in_array($courseText, $seen)) :
                                            $seen[] = $courseText; // Mark this combination as seen
                                    ?>
                                            <option value="<?php echo htmlspecialchars($course['CourseID']); ?>">
                                                <?php echo $courseText; ?>
                                            </option>
                                    <?php endif;
                                    endforeach; ?>
                                <?php else : ?>
                                    <option value="">No courses available</option>
                                <?php endif; ?>
                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

    <?php require_once("components/footer.php"); ?>
    <?php require_once("components/scripts.php"); ?>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#addCourseForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the form from submitting the default way
                console.log("Form submitted");

                $.ajax({
                    url: 'actions/add_courseMajor.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        console.log("Response received:", response); // Log the response for debugging
                        if (response.status === 'success') {
                            Swal.fire(
                                'Added!',
                                response.message,
                                'success'
                            ).then(() => {
                                location.reload(); // Reload the page to update the table
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error:", status, error); // Log AJAX errors
                        Swal.fire(
                            'Error!',
                            'Unable to add course.',
                            'error'
                        );
                    }
                });
            });
        });

        function deleteCourse(courseID, departmentID) {
            console.log(courseID); // Log the course name to the console
            console.log(departmentID);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'actions/delete_courseMajor.php',
                        method: 'POST',
                        data: {
                            courseID: courseID,
                            departmentID: departmentID

                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    location.reload(); // Reload the page to update the table
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Unable to delete course. Please try again.',
                                'error'
                            );
                            console.error('AJAX Error:', status, error); // Log detailed error
                        }
                    });
                }
            });
        }

        function redirectWithDepartmentID() {
            // Get the selected department ID from the dropdown
            var departmentID = document.getElementById('departmentSelect').value;

            // If a department is selected, redirect to the current page with the department ID as a query parameter
            if (departmentID) {
                // Get the current URL without query parameters
                var currentUrl = window.location.href.split('?')[0];

                // Redirect to the current URL with the departmentID as a query parameter
                window.location.href = currentUrl + '?departmentID=' + departmentID;
            }
        }

        // Function to hide the "Select Department" option if a department is selected
        function hideSelectOption() {
            var departmentSelect = document.getElementById('departmentSelect');
            var selectOption = departmentSelect.querySelector('option[value=""]');

            // Check if the departmentID is set in the URL
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('departmentID') && selectOption) {
                selectOption.style.display = 'none'; // Hide the "Select Department" option
            }
        }

        // Call hideSelectOption when the document is ready
        document.addEventListener('DOMContentLoaded', hideSelectOption);
    </script>
</body>

</html>