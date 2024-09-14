<?php
require_once('components/header.php');
require_once('components/navbar.php');
require_once('DAL/retrieve.class.php');

// Create an instance of the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();

// Retrieve userID from GET, with a default value of 3 if not provided
$userID = isset($_GET['userID']) ? intval($_GET['userID']) : 3;

// Fetch the uncompleted courses for the student
$courses = $universityData->getUncompletedCourses($userID);
?>
<div class="my-3 my-md-5" style="min-height: 65vh;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-primary mb-4">Registered Courses</h2>
                <table id="coursesTable" class="table table-striped table-bordered">
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
                                    <td><?php echo htmlspecialchars($course['CourseCode']);?> || <?php echo htmlspecialchars($course['CourseName']);  ?></td>
                                    <td><?php echo htmlspecialchars($course['RoomName']);?></td>
                                    <td>
                                        <a href="<?php echo htmlspecialchars($course['GCRLink']); ?>" target="_blank">
                                            Google Classroom
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        if (isset($course['PreviousExams']) && !empty($course['PreviousExams'])) {
                                            // Split the PreviousExams string into an array of links
                                            $examLinks = explode(', ', $course['PreviousExams']);

                                            // Generate HTML for each link
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
                                        // Assume $hasSubmittedEvaluation is a boolean value returned from the function hasStudentSubmittedEvaluation
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

<!-- Ensure SweetAlert and jQuery are loaded correctly -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Attach event listener to the "View Attendance" buttons

    document.querySelectorAll('.btn-primary[data-action="view-grades"]').forEach(button => {
        button.addEventListener('click', function() {
            const courseID = this.getAttribute('data-course-id');
            const studentID = this.getAttribute('data-student-id');

            fetch('actions/get_grades.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        userID: studentID,
                        courseID: courseID
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.grades && data.grades.length > 0) {
                        let gradesHtml = '<div>';
                        data.grades.forEach(item => {
                            gradesHtml += `
                            <p>${item.AssessmentType}: ${item.Grade} </p>
                        `;
                        });
                        gradesHtml += '</div>';

                        Swal.fire({
                            title: 'Grades for Course',
                            html: gradesHtml,
                            icon: 'info',
                            confirmButtonText: 'Close'
                        });
                    } else {
                        Swal.fire('No grades found for this course.', '', 'info');
                    }
                });
        });
    });

    document.querySelectorAll('.btn-primary[data-action="evaluate"]').forEach(button => {
        button.addEventListener('click', function() {
            const courseID = this.getAttribute('data-course-id');
            const studentID = this.getAttribute('data-student-id');
            const professorID = this.getAttribute('data-professor-id');

            Swal.fire({
                title: 'Evaluate Professor',
                html: `
                    <input type="hidden" id="courseID" value="${courseID}">
                    <input type="hidden" id="studentID" value="${studentID}">
                    <input type="hidden" id="professorID" value="${professorID}">
                    <input type="number" max=5 id="rating" class="swal2-input" placeholder="Rating (1-5)" min="1" max="5">
                    <textarea id="comments" class="swal2-textarea" placeholder="Comments"></textarea>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel',
                preConfirm: () => {
                    const rating = Swal.getPopup().querySelector('#rating').value;
                    const comments = Swal.getPopup().querySelector('#comments').value;
                    const courseID = Swal.getPopup().querySelector('#courseID').value;
                    const studentID = Swal.getPopup().querySelector('#studentID').value;
                    const professorID = Swal.getPopup().querySelector('#professorID').value;
                    if (!rating || !comments) {
                        Swal.showValidationMessage(`Please enter a rating and comments.`);
                    }
                    return {
                        courseID,
                        studentID,
                        professorID,
                        rating,
                        comments
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('actions/evaluate_professor.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams(result.value)
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire(data.message, '', data.status === 'success' ? 'success' : 'error');
                        });
                }
            });
        });
    });

    document.querySelectorAll('.view-attendance').forEach(button => {
        button.addEventListener('click', function() {
            const courseName = this.getAttribute('data-course-name') || 'N/A';
            const totalClasses = this.getAttribute('data-total-classes') || 'N/A';
            const presentCount = this.getAttribute('data-present-count') || 'N/A';
            const absentCount = this.getAttribute('data-absent-count') || 'N/A';
            const lateCount = this.getAttribute('data-late-count') || 'N/A';
            const attendancePercentage = this.getAttribute('data-attendance-percentage') ?
                parseFloat(this.getAttribute('data-attendance-percentage')).toFixed(2) :
                'N/A';

            Swal.fire({
                title: 'Attendance for ' + courseName,
                html: `
                    <strong>Total Classes:</strong> ${totalClasses} <br>
                    <strong>Present:</strong> ${presentCount} <br>
                    <strong>Absent:</strong> ${absentCount} <br>
                    <strong>Late:</strong> ${lateCount} <br>
                    <strong>Attendance Percentage:</strong> ${attendancePercentage}%`,
                icon: 'info',
                confirmButtonText: 'Close'
            });
        });
    });
</script>




<?php require_once("components/footer.php"); ?>
</body>

</html>