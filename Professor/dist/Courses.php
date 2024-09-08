<?php require_once('components/header.php') ?>
<?php require_once('components/navbar.php') ?>
<?php require_once('DAL/retrieve.class.php') ?>

<?php
$dataRetrieve = new UniversityDataRetrieval();
$professorID = 6; // Example Professor ID, you can set this dynamically
$totalCourses = $dataRetrieve->getRegisteredCourses($professorID);

// Define pagination variables
$itemsPerPage = 5; // Number of courses per page
$totalItems = count($totalCourses);
$totalPages = ceil($totalItems / $itemsPerPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;
$currentCourses = array_slice($totalCourses, $offset, $itemsPerPage);
?>

<div class="container mt-5" style="min-height:70dvh">
    <h2 class="text-center mb-4" style="font-weight: bold; color: #0056b3;">Registered Courses</h2>
    <div class="table-responsive">
        <table class="table table-hover table-bordered" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
            <thead class="thead bg-primary">
                <tr style="color: white!important;">
                    <th style="color: white!important;">Course ID</th>
                    <th style="color: white!important;">Course Name</th>
                    <th style="color: white!important;">Course Code</th>
                    <th style="color: white!important;">Credits</th>
                    <th style="color: white!important;">Department</th>
                    <th style="color: white!important;">Faculty</th>
                    <th style="color: white!important;">Attendance</th>
                    <th style="color: white!important;">Actions</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($currentCourses as $course) : ?>
                    <tr>
                        <td><?php echo $course['CourseID']; ?></td>
                        <td><?php echo $course['CourseName']; ?></td>
                        <td><?php echo $course['CourseCode']; ?></td>
                        <td><?php echo $course['Credits']; ?></td>
                        <td><?php echo $course['DepartmentName']; ?></td>
                        <td><?php echo $course['FaculityName']; ?></td>
                        <td><a href="attendance.php?course_id=<?= $course['CourseID'] ?>" class="btn btn-success mt-3 text-white">Attendance</a></td>

                        <style>
                            .fixed-size-btn {
                                width: 100px;
                                /* Set the desired width */
                                height: 30px;
                                /* Set the desired height */
                            }
                        </style>

                        <td>
                            <div>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-primary btn-sm mb-1 mr-2 fixed-size-btn gcr-link-btn" data-course-id="<?php echo $course['CourseID']; ?>"
                                        data-gcr-link="<?php echo $course['GCRLink']; ?>">GCR Link</a>

                                    <a href="#" class="btn btn-primary btn-sm mb-1 fixed-size-btn previous-exams-btn" data-course-id="<?php echo $course['CourseID']; ?>"
                                        data-toggle="modal" data-target="#previousExamsModal">Previous Exams</a>

                                </div>
                                <div class="d-flex">
                                    <a class="btn btn-primary btn-sm mr-2 fixed-size-btn" href="upload_grades.php?course_id=<?php echo $course['CourseID']; ?>">Upload Grades</a>
                                    <a href="students.php?course_id=<?php echo $course['CourseID']; ?>" class="btn btn-primary btn-sm mb-1 fixed-size-btn">View Students</a>
                                </div>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php if ($currentPage > 1) : ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" aria-label="Previous" style="background: #0056b3; color: white;">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>" style="background: <?php echo $i == $currentPage ? '#0056b3' : '#f8f9fa'; ?>; color: <?php echo $i == $currentPage ? 'white' : '#0056b3'; ?>;"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages) : ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>" aria-label="Next" style="background: #0056b3; color: white;">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<!-- Bootstrap CSS -->


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<?php require_once("components/footer.php") ?>
<!-- Modal Structure --><!-- Previous Exams Modal -->
<div class="modal fade" id="previousExamsModal" tabindex="-1" role="dialog" aria-labelledby="previousExamsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previousExamsModalLabel">Previous Exams</h5>

            </div>
            <div class="modal-body">
                <div id="exam-list"></div>
                <div class="modal-body">
                    <form id="addExamForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="examFile">Select Exam File</label>
                            <input type="file" class="form-control-file" id="examFile" name="examFile[]" multiple required>

                        </div>
                        <input type="hidden" id="examCourseID" name="course_id">
                        <button type="Submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Open Previous Exams Modal
        $('.previous-exams-btn').click(function(e) {
            e.preventDefault();
            var courseID = $(this).data('course-id');


            // Fetch previous exams
            $.ajax({
                url: 'actions/fetch_exams.php', // PHP file to fetch previous exams
                type: 'POST',
                data: {
                    course_id: courseID
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        $('#exam-list').html(res.output);
                        $('#previousExamsModal').modal('show');
                        // Store courseID in the Add Exam button's data attribute
                        $('#openAddExamModal').data('course-id', courseID);
                    } else {
                        Swal.fire('Info!', res.message, 'info');
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error!', 'An unexpected error occurred: ' + error, 'error');
                }
            });
        });

        // Handle Add Exam Form Submission
        $('#addExamForm').submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            var courseID = $('.previous-exams-btn').data('course-id');
            alert(courseID); // Debugging: check if courseID is correctly retrieved

            var formData = new FormData(this);
            formData.append('course_id', courseID); // Append courseID to FormData

            $.ajax({
                url: 'actions/upload_exam.php', // PHP file to handle file upload
                type: 'POST',
                data: formData,
                contentType: false, // Tell jQuery not to set content type
                processData: false, // Tell jQuery not to process the data
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        Swal.fire({
                            title: 'Uploaded!',
                            text: 'The exam file has been uploaded.',
                            icon: 'success',
                            timer: 5000, // Display for 5 seconds
                            showConfirmButton: false // Hide the confirm button
                        }).then(() => {
                            // Optionally, refresh the exam list or perform other actions

                            $('.previous-exams-btn').click(); // Trigger re-fetch of exams
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: res.message,
                            icon: 'error',
                            timer: 5000, // Display for 5 seconds
                            showConfirmButton: false // Hide the confirm button
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An unexpected error occurred: ' + error,
                        icon: 'error',
                        timer: 5000, // Display for 5 seconds
                        showConfirmButton: false // Hide the confirm button
                    });
                }
            });
        });

    });




    // Delete exam button
    $(document).on('click', '.delete-exam-btn', function() {
        var examID = $(this).data('exam-id');
        var examPath = $(this).data('exam-path'); // Get the file path from the button's data attribute

        $.ajax({
            url: 'actions/delete_exam.php', // PHP file to delete an exam
            type: 'POST',
            data: {
                exam_id: examID,
                examPath: examPath
            },
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    // Optionally refresh the list of exams
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'The exam has been deleted.',
                        icon: 'success',
                        timer: 3000, // Display for 3 seconds
                        showConfirmButton: false // Hide the confirm button
                    }).then(() => {
                        // Optionally, you can refresh the exam list here
                        $('.previous-exams-btn').click(); // Trigger re-fetch of exams
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: res.message,
                        icon: 'error',
                        timer: 3000, // Display for 3 seconds
                        showConfirmButton: false // Hide the confirm button
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'An unexpected error occurred: ' + error,
                    icon: 'error',
                    timer: 3000, // Display for 3 seconds
                    showConfirmButton: false // Hide the confirm button
                });
            }
        });
    });



    $(document).ready(function() {
        $('.gcr-link-btn').click(function(e) {
            e.preventDefault();
            var courseID = $(this).data('course-id');
            var gcrLink = $(this).data('gcr-link'); // Get the GCR link from the button's data attribute

            // Display the GCR link in the SweetAlert modal
            Swal.fire({
                title: 'GCR Link',
                html: '<input id="gcr-link" class="swal2-input" value="' + gcrLink + '">' +
                    '<a href="' + gcrLink + '" target="_blank" class="btn btn-primary mt-2">Visit Link</a>',
                showCancelButton: true,
                confirmButtonText: 'Save',
                preConfirm: function() {
                    return $('#gcr-link').val();
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Save the edited link via AJAX
                    $.ajax({
                        url: 'actions/save_gcr_link.php', // PHP file to save the GCR link
                        type: 'POST',
                        data: {
                            course_id: courseID,
                            gcr_link: result.value
                        },
                        success: function(response) {
                            var res = JSON.parse(response);
                            if (res.status === 'success') {
                                Swal.fire('Saved!', 'The GCR link has been updated.', 'success');
                            } else {
                                Swal.fire('Error!', res.message, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'An unexpected error occurred: ' + error, 'error');
                        }
                    });
                }
            });
        });
    });
</script>

</body>

</html>