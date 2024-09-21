<?php
require_once('components/header.php');
require_once('components/navbar.php');
require_once('DAL/retrieve.class.php');

// Create an instance of the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();

// Retrieve userID from GET, with a default value of 3 if not provided
$userID = isset($_GET['userID']) ? intval($_GET['userID']) : 3;

// Get semester and year from GET parameters, with default values
$selectedSemester = isset($_GET['semester']) ? $_GET['semester'] : 'Fall';
$selectedYear = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

// Fetch the uncompleted courses for the student based on semester and year
$courses = $universityData->getUncompletedCourses($userID, $selectedSemester, $selectedYear);
?>
<div class="my-3 my-md-5" style="min-height: 65vh;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-primary mb-4">Registered Courses</h2>
                <form method="GET" action="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="semester">Select Semester:</label>
                            <select id="semester" name="semester" class="form-control" onchange="updateFilters()">
                                <option value="Fall" <?php echo $selectedSemester == 'Fall' ? 'selected' : ''; ?>>Fall</option>
                                <option value="Spring" <?php echo $selectedSemester == 'Spring' ? 'selected' : ''; ?>>Spring</option>
                                <option value="Summer" <?php echo $selectedSemester == 'Summer' ? 'selected' : ''; ?>>Summer</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="year">Select Year:</label>
                            <select id="year" name="year" class="form-control" onchange="updateFilters()">
                                <?php
                                $currentYear = date('Y');
                                for ($i = $currentYear - 3; $i <= $currentYear + 3; $i++) {
                                    echo '<option value="' . $i . '" ' . ($i == $selectedYear ? 'selected' : '') . '>' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="userID" value="<?php echo $userID; ?>">

                </form>
                <table id="coursesTable" class="table table-striped table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Room</th>
                            <th>Google Classroom Link</th>
                            <th>Previous Exams</th>
                            <th>Grades</th>
                            <th>Attendance</th>
                            <th>Evaluation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($courses)): ?>
                            <?php foreach ($courses as $course):
                                $attendance = $universityData->getCourseAttendance($userID, $course['CourseID']);
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($course['CourseCode']); ?> || <?php echo htmlspecialchars($course['CourseName']);  ?></td>
                                    <td><?php echo htmlspecialchars($course['RoomName']); ?></td>
                                    <td>
                                        <a href="<?php echo htmlspecialchars($course['GCRLink']); ?>" target="_blank">
                                            Google Classroom
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        if (isset($course['PreviousExams']) && !empty($course['PreviousExams'])) {
                                            $examLinks = explode(', ', $course['PreviousExams']);
                                            foreach ($examLinks as $link) {
                                                echo '<a href="../../Professor/dist/dataClient/PreviousExams/' . htmlspecialchars($link) . '" target="_blank">' . htmlspecialchars($link) . '</a><br>';
                                            }
                                        } else {
                                            echo 'N/A';
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <button class="btn btn-primary" data-action="view-grades" data-course-id="<?php echo htmlspecialchars($course['CourseID']); ?>" data-student-id="<?php echo htmlspecialchars($userID); ?>">
                                            View Grades
                                        </button>
                                    </td>

                                    <td>
                                        <button
                                            class="btn btn-success view-attendance"
                                            data-course-name="<?php echo htmlspecialchars($course['CourseName']); ?>"
                                            data-total-classes="<?php echo !empty($attendance[0]['Attendance_Records']) ? htmlspecialchars($attendance[0]['Attendance_Records']) : 'N/A'; ?>"
                                            data-present-count="<?php echo !empty($attendance[0]['PresentCount']) ? htmlspecialchars($attendance[0]['PresentCount']) : 'N/A'; ?>"
                                            data-absent-count="<?php echo !empty($attendance[0]['AbsentCount']) ? htmlspecialchars($attendance[0]['AbsentCount']) : 'N/A'; ?>"
                                            data-late-count="<?php echo !empty($attendance[0]['LateCount']) ? htmlspecialchars($attendance[0]['LateCount']) : 'N/A'; ?>"
                                            data-attendance-percentage="<?php echo !empty($attendance[0]['AttendancePercentage']) ? htmlspecialchars($attendance[0]['AttendancePercentage']) : 'N/A'; ?>">
                                            View Attendance
                                        </button>
                                    </td>

                                    <td>
                                        <?php
                                        $hasSubmittedEvaluation = $universityData->hasStudentSubmittedEvaluation($userID, $course['ProfessorID'], $course['CourseID']);
                                        ?>
                                        <button
                                            class="btn btn-primary "
                                            data-action="evaluate"
                                            data-course-id="<?php echo htmlspecialchars($course['CourseID']); ?>"
                                            data-student-id="<?php echo $userID ?>"
                                            data-professor-id="<?php echo htmlspecialchars($course['ProfessorID']); ?>"
                                            <?php echo $hasSubmittedEvaluation ? 'disabled' : ''; ?>>
                                            <?php echo $hasSubmittedEvaluation ? 'Already Evaluated' : 'Evaluate Professor'; ?>
                                        </button>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No uncompleted courses found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Include SweetAlert and jQuery functionality here -->
<script>
     function updateFilters() {
        var semester = document.getElementById('semester').value;
        var year = document.getElementById('year').value;
        var userID = <?php echo $userID; ?>;
        window.location.href = window.location.pathname + '?userID=' + userID + '&semester=' + semester + '&year=' + year;
    }
</script>
<?php require_once("components/footer.php"); ?>
</body>

</html>