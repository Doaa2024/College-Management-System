<?php require_once('components/header.php') ?>
<?php require_once('components/navbar.php') ?>
<?php
require_once('DAL/retrieve.class.php');

$dataRetrieval = new UniversityDataRetrieval();

$userID = isset($_GET['userID']) ? intval($_GET['userID']) : 5;

$userInfo = $dataRetrieval->getUserInfo($userID);
$semester = isset($_GET['semester']) ? $_GET['semester'] : 'Fall';  // Get semester from query parameter
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');  // Get year from query parameter, default is current year

$Courses = $dataRetrieval->getAvailableCourses($userID, $userInfo[0]['DepartmentID'], $semester, $year);
?>

<div class="my-3 my-md-5" style="min-height:70dvh">
    <div class="container shadow-lg p-5">
        <h2 class="text-primary"> Register Courses, View Offerings</h2>
        <div style="display:flex; gap:10px">
            <!-- Semester Selection Dropdown -->
            <div class="form-group col-lg-4 col-md-12 col-xs-12 ">
                <label for="semesterSelect">Select Semester:</label>
                <select class="form-control shadow-sm" id="semesterSelect" onchange="updateFilters()">
                    <option value="Fall" <?php echo $semester == 'Fall' ? 'selected' : ''; ?>>Fall</option>
                    <option value="Spring" <?php echo $semester == 'Spring' ? 'selected' : ''; ?>>Spring</option>
                    <option value="Summer" <?php echo $semester == 'Summer' ? 'selected' : ''; ?>>Summer</option>
                </select>
            </div>

            <!-- Year Selection Dropdown -->
            <div class="form-group col-lg-4 col-md-12 col-xs-12 ">
                <label for="yearSelect">Select Year:</label>
                <select class="form-control shadow-sm" id="yearSelect" onchange="updateFilters()">
                    <?php
                    $currentYear = date('Y');
                    for ($i = 0; $i < 2; $i++) {
                        $yearOption = $currentYear + $i;
                        echo '<option value="' . $yearOption . '" ' . ($year == $yearOption ? 'selected' : '') . '>' . $yearOption . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="accordion" id="courseAccordion">
            <?php
            // Group courses by name and code
            $groupedCourses = [];
            foreach ($Courses as $course) {
                $key = $course['CourseName'] . ' (' . $course['CourseCode'] . ')';
                if (!isset($groupedCourses[$key])) {
                    $groupedCourses[$key] = [];
                }
                $groupedCourses[$key][] = $course;
            }

            // Display each group of courses
            foreach ($groupedCourses as $key => $courseOfferings) {
                $firstCourseID = $courseOfferings[0]['CourseID'];
            ?>
                <div class="card shadow-sm text-primary">
                    <div class="card-header d-flex justify-content-between align-items-center" id="heading-<?php echo $firstCourseID; ?>">
                        <h5 class="mb-0" >
                            <?php echo $key; ?>
                        </h5>
                        <a href="#collapse-<?php echo $firstCourseID; ?>" class="btn btn-primary" data-toggle="collapse" aria-expanded="false" aria-controls="collapse-<?php echo $firstCourseID; ?>">
                            View Offerings
                        </a>
                    </div>

                    <div id="collapse-<?php echo $firstCourseID; ?>" class="collapse shadow-lg" aria-labelledby="heading-<?php echo $firstCourseID; ?>" data-parent="#courseAccordion">
                        <div class="card-body shadow-lg">
                            <ul class="list-group">
                                <?php foreach ($courseOfferings as $offering) { ?>
                                    <li class="list-group-item shadow-lg">
                                        <strong>Offering: </strong> <?php echo $offering['time']; ?> || <?php echo $offering['DayOfWeek']; ?> <br>
                                       
                                        <strong>Room:</strong> <?php echo $offering['RoomName']; ?> <br>
                                      
                                        <!-- Register Button -->
                                        <button class="btn btn-primary float-right mt-2" onclick="registerCourse(<?php echo $offering['CourseID']; ?>, <?php echo $userID; ?>)">
                                            Register
                                        </button>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<script>
    function updateFilters() {
        var semester = document.getElementById('semesterSelect').value;
        var year = document.getElementById('yearSelect').value;
        var userID = <?php echo $userID; ?>;
        window.location.href = window.location.pathname + '?userID=' + userID + '&semester=' + semester + '&year=' + year; // Redirect with selected semester and year
    }

    function registerCourse(courseID, userID) {
        // Example of an AJAX request to register the course
        fetch('register-course.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    courseID: courseID,
                    userID: userID
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Successfully registered for the course!');
                } else {
                    alert('Failed to register for the course.');
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>

<script src="logic.js"></script>

<?php require_once("components/footer.php") ?>
</body>

</html>