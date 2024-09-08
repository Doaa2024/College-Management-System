<?php require_once('components/header.php') ?>
<?php require_once('components/navbar.php') ?>
<?php require_once('DAL/retrieve.class.php') ?>

<?php
$dataRetrieve = new UniversityDataRetrieval();
$courseID = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
$studentsInCourse = $dataRetrieve->getStudentsInCourse($courseID);
?>

<style>
    /* From Uiverse.io by Shoh2008 */
    .checkbox-wrapper-5 .check {
        --size: 40px;
        position: relative;
        background: linear-gradient(90deg, green, lightgreen);
        line-height: 0;
        perspective: 400px;
        height: 5.6dvh;
        font-size: var(--size);
    }

    .checkbox-wrapper-5 .check input[type="checkbox"],
    .checkbox-wrapper-5 .check label,
    .checkbox-wrapper-5 .check label::before,
    .checkbox-wrapper-5 .check label::after,
    .checkbox-wrapper-5 .check {
        appearance: none;
        display: inline-block;
        border-radius: var(--size);
        border: 0;
        transition: .35s ease-in-out;
        box-sizing: border-box;
        cursor: pointer;
    }

    .checkbox-wrapper-5 .check label {
        width: calc(2.2 * var(--size));
        height: var(--size);
        background: #d7d7d7;
        overflow: hidden;
    }

    .checkbox-wrapper-5 .check input[type="checkbox"] {
        position: absolute;
        z-index: 1;
        width: calc(.8 * var(--size));
        height: calc(.8 * var(--size));
        top: calc(.1 * var(--size));
        left: calc(.1 * var(--size));
        background: linear-gradient(45deg, #dedede, #ffffff);
        box-shadow: 0 6px 7px rgba(0, 0, 0, 0.3);
        outline: none;
        margin: 0;
    }

    .checkbox-wrapper-5 .check input[type="checkbox"]:checked {
        left: calc(1.3 * var(--size));
    }

    .checkbox-wrapper-5 .check input[type="checkbox"]:checked+label {
        background: transparent;
    }

    .checkbox-wrapper-5 .check label::before,
    .checkbox-wrapper-5 .check label::after {
        content: "· ·";
        position: absolute;
        overflow: hidden;
        left: calc(.15 * var(--size));
        top: calc(.5 * var(--size));
        height: var(--size);
        letter-spacing: calc(-0.04 * var(--size));
        color: #9b9b9b;
        font-family: "Times New Roman", serif;
        z-index: 2;
        font-size: calc(.6 * var(--size));
        border-radius: 0;
        transform-origin: 0 0 calc(-0.5 * var(--size));
        backface-visibility: hidden;
    }

    .checkbox-wrapper-5 .check label::after {
        content: "●";
        top: calc(.65 * var(--size));
        left: calc(.2 * var(--size));
        height: calc(.1 * var(--size));
        width: calc(.35 * var(--size));
        font-size: calc(.2 * var(--size));
        transform-origin: 0 0 calc(-0.4 * var(--size));
    }

    .checkbox-wrapper-5 .check input[type="checkbox"]:checked+label::before,
    .checkbox-wrapper-5 .check input[type="checkbox"]:checked+label::after {
        left: calc(1.55 * var(--size));
        top: calc(.4 * var(--size));
        line-height: calc(.1 * var(--size));
        transform: rotateY(360deg);
    }

    .checkbox-wrapper-5 .check input[type="checkbox"]:checked+label::after {
        height: calc(.16 * var(--size));
        top: calc(.55 * var(--size));
        left: calc(1.6 * var(--size));
        font-size: calc(.6 * var(--size));
        line-height: 0;
    }
</style>

<div class="container mt-5" style="min-height:70dvh">
    <h2 class="mb-4">Students in Course</h2>

    <h5 id="selectedDate" class="text-center mb-4"></h5>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Attendance</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($studentsInCourse): ?>
                <?php foreach ($studentsInCourse as $index => $student): ?>
                    <?php
                    // Create unique IDs for each checkbox and label based on index
                    $checkboxId = 'check-' . $index;
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['UserID']); ?></td>
                        <td><?php echo htmlspecialchars($student['Username']); ?></td>
                        <td>
                            <div class="checkbox-wrapper-5">
                                <div class="check">
                                    <input id="<?php echo $checkboxId; ?>" type="checkbox" class="attendance-checkbox" data-user-id="<?php echo $student['UserID']; ?>" data-enrolment-id="<?php echo $student['EnrollmentID']; ?>" checked>
                                    <label for="<?php echo $checkboxId; ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No students found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <button id="submitAttendance" class="btn btn-success">Submit Attendance</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        let currentDate = '';

        // Ask for the current date using SweetAlert with input type 'date'
        Swal.fire({
            title: 'Select the current date',
            input: 'date',
            inputLabel: 'Date',
            inputPlaceholder: 'Enter the current date',
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to select a date!';
                }
                currentDate = value;
            },
            allowOutsideClick: false
        }).then(() => {
            // Display the selected date above the table
            $('#selectedDate').text('Attendance Date: ' + currentDate);

            // Enable the submission button after the date is entered
            $('#submitAttendance').prop('disabled', false);
        });

        // Handle attendance submission
        $('#submitAttendance').click(function() {
            let attendanceData = [];
            $('.attendance-checkbox').each(function() {
                let userId = $(this).data('user-id');
                let enrollmentId = $(this).data('enrolment-id'); // Capture EnrollmentID
                let isPresent = $(this).is(':checked') ? 'Present' : 'Absent'; // Adjust to save status
                attendanceData.push({
                    enrollmentID: enrollmentId,
                    status: isPresent
                });
            });

            // Send attendance data to PHP backend
            $.ajax({
                url: 'actions/submit_attendance.php', // Change this to your actual PHP script
                type: 'POST',
                data: {
                    course_id: <?php echo $courseID; ?>,
                    date: currentDate,
                    attendance: attendanceData
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Attendance Submitted',
                        text: 'Attendance has been successfully submitted!',
                    }).then(() => {
                        window.location.href = 'courses.php'; // Redirect after success
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to submit attendance. Please try again.',
                    });
                }
            });
        });
    });
</script>