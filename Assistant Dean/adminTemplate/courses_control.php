<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php');
require_once('DAL/retrieve.class.php');
?>
<?php // Instantiate the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();
$departmentID = isset($_SESSION['departmentID']) ? $_SESSION['departmentID'] : '';
// Retrieve all branches
$semesters = $universityData->getAllSemesters();
// Check if 'departmentID' is set in the URL query parameters and is not empty
$coursesDepartment = $universityData->getAllCoursesINDepartments($departmentID);
$rooms = $universityData->getAllRooms($departmentID);
// Check if 'semester' and 'year' are set and not empty in the URL
$semester = '';
$year = '';
$disabledButtons = true; // Default to true, assuming the button is disabled initially

// Check if semester and year are set and not empty
if (
    isset($_GET['semester']) && !empty($_GET['semester']) &&
    isset($_GET['year']) && !empty($_GET['year'])
) {
    // Get the semester and year from the URL
    $semester = $_GET['semester'];
    $year = $_GET['year'];
    $currentMonth = (int) date('n'); // Current month as an integer (1 to 12)

    // Determine if the button should be enabled based on conditions
    if (
        ($currentMonth >= 12 || $currentMonth < 6) && $semester === 'Spring' ||
        ($currentMonth >= 9 && $currentMonth < 12) && $semester === 'Fall' ||
        ($currentMonth >= 6 && $currentMonth < 9) && $semester === 'Summer'
    ) {
        $disabledButtons = false;
    }


    $coursesINSemester = $universityData->getCoursesINSemester($semester, $year, $departmentID);
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

    #dayOfWeek1 .form-check {
        margin-right: 15px;
        /* Adjust spacing between checkboxes */
        margin-bottom: 10px;
        /* Space below each checkbox */
    }

    #dayOfWeek1 .form-check-label {
        margin-bottom: 0;
        /* Align label with checkbox */
    }

    #dayOfWeek .form-check {
        margin-right: 15px;
        /* Adjust spacing between checkboxes */
        margin-bottom: 10px;
        /* Space below each checkbox */
    }

    #dayOfWeek .form-check-label {
        margin-bottom: 0;
        /* Align label with checkbox */
    }

    .action-btn {
        width: 40px;
        /* Set the desired width */
        height: 40px;
        /* Set the desired height */
        margin-bottom: 10px;
        /* Margin between buttons */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        /* Remove default padding */
    }

    .action-btn i {
        font-size: 18px;
        /* Adjust icon size if needed */
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
                <button type="button"
                    class="btn btn-primary"
                    <?= $disabledButtons || !isset($_GET['semester']) || !isset($_GET['year']) ? 'disabled' : '' ?>
                    data-toggle="modal"
                    data-target="#addCourseModal">
                    Add Course
                </button>


                <?php
                // Determine the current semester based on the current month
                $currentMonth = date('n');
                $currentYear = date('Y');

                if ($currentMonth >= 12 && $currentMonth < 6) {
                    $newOption = ['Semester' => 'Spring', 'Year' => $currentYear + 1]; // Next year if current month is December
                } elseif ($currentMonth >= 9 && $currentMonth < 12) {
                    $newOption = ['Semester' => 'Fall', 'Year' => $currentYear]; // Fall semester
                } elseif ($currentMonth >= 6 && $currentMonth < 9) {
                    $newOption = ['Semester' => 'Summer', 'Year' => $currentYear]; // Summer semester
                } else {
                    $newOption = ['Semester' => 'Fall', 'Year' => $currentYear]; // Default to Fall
                }

                // Check if the new option already exists in the database data
                $newOptionExists = false;
                foreach ($semesters as $semester) {
                    if (
                        $semester['Semester'] === $newOption['Semester'] &&
                        $semester['Year'] === $newOption['Year']
                    ) {
                        $newOptionExists = true;
                        break;
                    }
                }
                ?>
                <!-- Department Dropdown -->
                <div class="btn-group">

                    <!-- Department Select Dropdown -->
                    <select id="departmentSelect" class="form-control dropdown-select" onchange="redirectWithSemesterYear()">
                        <option value="">-- Select Semester --</option>
                        <!-- Loop through semesters to create options -->
                        <?php foreach ($semesters as $semester) : ?>
                            <option value="<?php echo htmlspecialchars($semester['Semester']) . '-' . htmlspecialchars($semester['Year']); ?>"
                                <?php
                                // Check if this option matches the URL parameters
                                if (
                                    isset($_GET['semester'], $_GET['year']) &&
                                    $_GET['semester'] == $semester['Semester'] &&
                                    $_GET['year'] == $semester['Year']
                                ) {
                                    echo 'selected'; // Set the selected attribute
                                }
                                ?>>
                                <?php echo 'Semester ' . htmlspecialchars($semester['Semester']) . ' - Year ' . htmlspecialchars($semester['Year']); ?>
                            </option>
                        <?php endforeach; ?>

                        <!-- Add the current semester option only if it does not exist already -->
                        <?php if (!$newOptionExists) : ?>
                            <option value="<?php echo htmlspecialchars($newOption['Semester']) . '-' . htmlspecialchars($newOption['Year']); ?>"
                                <?php
                                // Check if this option matches the URL parameters
                                if (
                                    isset($_GET['semester'], $_GET['year']) &&
                                    $_GET['semester'] == $newOption['Semester'] &&
                                    $_GET['year'] == $newOption['Year']
                                ) {
                                    echo 'selected'; // Set the selected attribute
                                }
                                ?>>
                                <?php echo 'Semester ' . htmlspecialchars($newOption['Semester']) . ' - Year ' . htmlspecialchars($newOption['Year']); ?>
                            </option>
                        <?php endif; ?>
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
                                    <th>Branch</th>
                                    <th>Room</th>
                                    <th>Day</th>
                                    <th>Lecture Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="courseList">
                                <!-- Dynamic PHP content for displaying courses with timetable and branch information -->
                                <?php if (!empty($coursesINSemester)) : ?>
                                    <?php foreach ($coursesINSemester as $course) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($course['CourseName']); ?></td>
                                            <td><?php echo htmlspecialchars($course['CourseCode']); ?></td>
                                            <td><?php echo htmlspecialchars($course['Credits']); ?></td>
                                            <td><?php echo htmlspecialchars($course['BranchName']); ?></td>
                                            <td><?php echo htmlspecialchars($course['RoomName']); ?></td>
                                            <td><?php echo htmlspecialchars($course['DayOfWeek']); ?></td>
                                            <td><?php echo htmlspecialchars($course['time']); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm action-btn <?= $disabledButtons ? 'disabled' : '' ?>" <?= $disabledButtons ? 'disabled' : '' ?> data-toggle="modal"
                                                    data-target="#editCourseModal"
                                                    data-courseid="<?= htmlspecialchars($course['CourseID']); ?>"
                                                    data-roomid="<?= htmlspecialchars($course['RoomID']); ?>"
                                                    data-time="<?= htmlspecialchars($course['time']); ?>"
                                                    data-days="<?= htmlspecialchars($course['DayOfWeek']); ?>"
                                                    data-timetable="<?= htmlspecialchars($course['TimetableID']); ?>"
                                                    onclick="fillEditCourseForm(this)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm action-btn <?= $disabledButtons ? 'disabled' : '' ?>" <?= $disabledButtons ? 'disabled' : '' ?> onclick="deleteCourse(
                                                <?= htmlspecialchars($course['TimetableID']); ?>
                                            )">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="9">No courses available for this semesters.</td>
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
    <div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editCourseForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="course">Course</label>
                            <select id="course_id1" class="form-control" name="course" required>
                                <!-- Courses will be loaded dynamically -->
                                <?php foreach ($coursesDepartment as $course): ?>
                                    <option value="<?php echo htmlspecialchars($course['CourseID']); ?>">
                                        <?php echo htmlspecialchars($course['CourseName'] . ' (' . $course['CourseCode'] . ') / ' . $course['Credits'] . ' Credits'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" id="timetable1" name="TimetableID" value="">
                        <input type="hidden" id="hiddenSemester1" name="semester" value="<?= isset($_GET['semester']) ? $_GET['semester'] : '' ?>">
                        <input type="hidden" id="hiddenYear1" name="year" value="<?= isset($_GET['year']) ? $_GET['year'] : '' ?>">
                        <div class="form-group">
                            <label for="room">Room</label>
                            <select id="room1" class="form-control" name="room" required>
                                <?php foreach ($rooms as $room): ?>
                                    <option value="<?php echo htmlspecialchars($room['RoomID']); ?>">
                                        <?php echo htmlspecialchars($room['RoomName'] . ' - ' . $room['BranchName']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="time">Lecture Time</label>
                            <select id="time1" class="form-control" name="time" required>
                                <option value="8:00-9:15">8:00-9:15</option>
                                <option value="9:30-10:45">9:30-10:45</option>
                                <option value="11:00-12:15">11:00-12:15</option>
                                <option value="12:30-13:45">12:30-13:45</option>
                                <option value="14:00-15:15">14:00-15:15</option>
                                <option value="15:30-16:45">15:30-16:45</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dayOfWeek">Day of Week</label>
                            <div class="d-flex flex-wrap" id="dayOfWeek1">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" id="dayM" name="day_of_week[]" value="M">
                                    <label class="form-check-label" for="dayM">M</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" id="dayW" name="day_of_week[]" value="W">
                                    <label class="form-check-label" for="dayW">W</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" id="dayT" name="day_of_week[]" value="T">
                                    <label class="form-check-label" for="dayT">T</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" id="dayTH" name="day_of_week[]" value="TH">
                                    <label class="form-check-label" for="dayTH">TH</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="dayF" name="day_of_week[]" value="F">
                                    <label class="form-check-label" for="dayF">F</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                            <label for="course">Course</label>
                            <select id="course" class="form-control" name="course_id" required>
                                <!-- Courses will be loaded dynamically -->
                                <?php foreach ($coursesDepartment as $course): ?>
                                    <?php
                                    // Format the course text
                                    $courseText = htmlspecialchars($course['CourseName'] . ' (' . $course['CourseCode'] . ') / ' . $course['Credits'] . ' Credits');
                                    ?>
                                    <option value="<?php echo htmlspecialchars($course['CourseID']); ?>">
                                        <?php echo $courseText; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="room">Room</label>
                            <select id="room" class="form-control" name="room_id" required>
                                <?php foreach ($rooms as $room): ?>
                                    <?php
                                    // Format the room text to include room name and branch name
                                    $roomText = htmlspecialchars($room['RoomName'] . ' - ' . $room['BranchName']);
                                    ?>
                                    <option value="<?php echo htmlspecialchars($room['RoomID']); ?>">
                                        <?php echo $roomText; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" id="hiddenSemester" name="semester" value="<?= isset($_GET['semester']) ? $_GET['semester'] : '' ?>">
                        <input type="hidden" id="hiddenYear" name="year" value="<?= isset($_GET['year']) ? $_GET['year'] : '' ?>">
                        <div class="form-group">
                            <label for="startTime">Lecture Time</label>
                            <select id="time" class="form-control" name="time" required>
                                <option value="8:00-9:15">8:00-9:15</option>
                                <option value="9:30-10:45">9:30-10:45</option>
                                <option value="11:00-12:15">11:00-12:15</option>
                                <option value="12:30-13:45">12:30-13:45</option>
                                <option value="14:00-15:15">14:00-15:15</option>
                                <option value="15:30-16:45">15:30-16:45</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dayOfWeek">Day of Week</label>
                            <div class="d-flex flex-wrap" id="dayOfWeek">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" id="dayM" name="day_of_week[]" value="M">
                                    <label class="form-check-label" for="dayM">
                                        M
                                    </label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" id="dayW" name="day_of_week[]" value="W">
                                    <label class="form-check-label" for="dayW">
                                        W
                                    </label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" id="dayT" name="day_of_week[]" value="T">
                                    <label class="form-check-label" for="dayT">
                                        T
                                    </label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" id="dayTH" name="day_of_week[]" value="TH">
                                    <label class="form-check-label" for="dayTH">
                                        TH
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="dayF" name="day_of_week[]" value="F">
                                    <label class="form-check-label" for="dayF">
                                        F
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Course</button>
                        </div>
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
                    url: 'actions/add_course.php',
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

        function deleteCourse(TimetableID) {
            console.log(TimetableID); // Log the course name to the console
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
                        url: 'actions/delete_course.php',
                        method: 'POST',
                        data: {
                            TimetableID: TimetableID
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

        function redirectWithSemesterYear() {
            // Get the selected semester and year from the dropdown
            var selectedValue = document.getElementById('departmentSelect').value;

            // Split the selected value into semester and year
            var [semester, year] = selectedValue.split('-');

            // If a valid selection is made, redirect to the current page with the semester and year as query parameters
            if (semester && year) {
                // Get the current URL without query parameters
                var currentUrl = window.location.href.split('?')[0];

                // Construct the new URL with semester and year as query parameters
                var newUrl = currentUrl + '?semester=' + encodeURIComponent(semester) +
                    '&year=' + encodeURIComponent(year);

                // Redirect to the new URL
                window.location.href = newUrl;
            }
        }

        // Call hideSelectOption when the document is ready
        document.addEventListener('DOMContentLoaded', function() {
            hideSelectOption();
            document.getElementById('departmentSelect').addEventListener('change', function() {
                hideSelectOption();
            });
        });

        function hideSelectOption() {
            // Get the selected semester and year from the URL or dropdown
            var urlParams = new URLSearchParams(window.location.search);
            var selectedSemester = urlParams.get('semester');
            var selectedYear = urlParams.get('year');

            // Optionally, if no URL params are provided, use the value from the dropdown
            if (!selectedSemester || !selectedYear) {
                var selectElement = document.getElementById('departmentSelect');
                var selectedValue = selectElement.value;
                if (selectedValue) {
                    [selectedSemester, selectedYear] = selectedValue.split('-');
                }
            }

            // Get the placeholder option
            var placeholderOption = document.querySelector('#departmentSelect option[value=""]');

            // Check if the placeholder should be hidden based on the selected values
            if (selectedSemester && selectedYear) {
                placeholderOption.style.display = 'none'; // Hide the placeholder option
            } else {
                placeholderOption.style.display = 'block'; // Show the placeholder option
            }
        }

        function fillEditCourseForm(button) {
            // Get data attributes from the button
            const courseId = button.getAttribute('data-courseid');
            const roomId = button.getAttribute('data-roomid');
            const time = button.getAttribute('data-time');
            const timetable = button.getAttribute('data-timetable');
            const days = button.getAttribute('data-days').split(',');

            // Set form values
            document.getElementById('course_id1').value = courseId;
            document.getElementById('room1').value = roomId;
            document.getElementById('time1').value = time;
            document.getElementById('timetable1').value = timetable;

            // Uncheck all checkboxes first
            document.querySelectorAll('#dayOfWeek1 .form-check-input').forEach(checkbox => {
                checkbox.checked = false;
            });

            // Check the corresponding checkboxes for the days
            days.forEach(day => {
                const checkbox = document.querySelector(`#dayOfWeek1 .form-check-input[value="${day}"]`);
                if (checkbox) {
                    checkbox.checked = true;
                }
            });

            // Show the modal
            $('#editCourseModal').modal('show');
        }
        $('#editCourseForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Serialize form data
            const formData = $(this).serialize();

            $.ajax({
                url: 'actions/edit_course.php', // Update with your server endpoint URL
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire(
                            'Edited!',
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
                        'Unable to edit course. Please try again.',
                        'error'
                    );
                    console.error('AJAX Error:', status, error); // Log detailed error
                }
            });
        });
    </script>
</body>

</html>