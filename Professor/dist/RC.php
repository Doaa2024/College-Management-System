<?php require_once('components/header.php') ?>
<?php require_once('components/navbar.php') ?>
<?php require_once('DAL/retrieve.class.php') ?>

<?php
$dataRetrieve = new UniversityDataRetrieval();
$professorID = 6; // Example Professor ID, you can set this dynamically
$availableCourses = $dataRetrieve->getAvailableCoursesForRegistration();
?>

<div class="container mt-5" style="min-height:70dvh">
    <h2 class="mb-4">Register Courses</h2>

    <table class="table table-striped" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
        <thead class="bg-primary">
            <tr>
                <th class="text-white">Course ID</th>
                <th class="text-white">Course Name</th>
                <th class="text-white">Course Code</th>
                <th class="text-white">Branch Name</th>
                <th class="text-white">Branch Location</th>
                <th class="text-white">Start Time</th>
                <th class="text-white">End Time</th>
                <th class="text-white">Semester</th>
                <th class="text-white">Year</th>
                <th class="text-white">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($availableCourses as $course) : 
                $timeParts = explode('-', ($course['time']));

                $startTime = $timeParts[0]; // "9:30"
                $endTime = $timeParts[1]; // "10:45"?>
                <tr>
                    <td><?php echo htmlspecialchars($course['CourseID']); ?></td>
                    <td><?php echo htmlspecialchars($course['CourseName']); ?></td>
                    <td><?php echo htmlspecialchars($course['CourseCode']); ?></td>
                    <td><?php echo htmlspecialchars($course['BranchName']); ?></td>
                    <td><?php echo htmlspecialchars($course['Location']); ?></td>
                    <td><?php echo  $startTime ?></td>
                    <td><?php echo    $endTime ?></td>
                    <td><?php echo htmlspecialchars($course['Semester']); ?></td>
                    <td><?php echo htmlspecialchars($course['Year']); ?></td>
                    <td>
                        <button class="btn btn-primary register-btn"
                            data-course-id="<?php echo htmlspecialchars($course['CourseID']); ?>"
                            data-time="<?= $course['time'] ?>"
                           
                            data-semester="<?php echo htmlspecialchars($course['Semester']); ?>"
                            data-year="<?php echo htmlspecialchars($course['Year']); ?>">
                            Register
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>

<!-- Bootstrap JS, jQuery, and SweetAlert -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.register-btn').on('click', function() {
            var courseId = $(this).data('course-id');
            var time = $(this).data('time');
       
            var semester = $(this).data('semester'); // Add data attribute for semester
            var year = $(this).data('year'); // Add data attribute for year
            var professorId = <?php echo $professorID; ?>;

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to register for this course!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, register it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'actions/register_course.php',
                        type: 'POST',
                        data: {
                            professorID: professorId,
                            courseID: courseId,
                            time: time,
                           
                            semester: semester, // Send semester
                            year: year // Send year
                        },
                        success: function(response) {
                            var result = JSON.parse(response);
                            if (result.success) {
                                Swal.fire(
                                    'Registered!',
                                    'You have successfully registered for the course.',
                                    'success'
                                ).then(() => {
                                    window.location.href = 'courses.php';
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was an error processing your request.',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'There was an error processing your request.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>



<?php require_once("components/footer.php") ?>

</body>

</html>