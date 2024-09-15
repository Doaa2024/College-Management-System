<?php require_once('components/header.php'); ?>


<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php
// Require the class file
require('DAL/retrieve.class.php');

// Instantiate the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();

// Retrieve all branches
$courses = $universityData->getAllCourses();
$faculty = $universityData->getAllFaculties();
$branches = $universityData->getAllBranchesLocation()


?>
<style>
    /* Hide specific pagination buttons */
    .dataTables_wrapper .dataTables_paginate .paginate_button.first,
    .dataTables_wrapper .dataTables_paginate .paginate_button.last {
        display: none;
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTables Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">Courses</h3>
                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addBranchModal">
                        <i class="fas fa-plus"></i> Add Course
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display" id="datatablesSimple" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Course Code</th>
                                    <th>Credits</th>
                                    <th>Published At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <!-- Assuming you'll add the table body here -->
                        </table> <!-- Correctly closed the table tag -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Page Content -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

    </div> <!-- Closing the wrapper div -->

    <!-- Footer -->
    <?php require_once("components/footer.php"); ?> <!-- Placed footer outside and at the bottom -->






<!-- Add Branch Modal -->
<div class="modal fade" id="addBranchModal" tabindex="-1" role="dialog" aria-labelledby="addBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBranchModalLabel">Add New Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCourseForm">
                    <div class="form-group">
                        <label for="jobTitle">Course Name</label>
                        <input type="text" class="form-control" id="coursetitle" name="CourseName" required>
                    </div>

                    <div class="form-group">
                        <label for="jobDescription">Course Code</label>
                        <input type="text" class="form-control" id="coursename" name="CourseCode" required>
                    </div>
                    <div class="form-group">
                        <label for="requiredQualifications">Credits</label>
                        <input type="number" class="form-control" id="credits" name="CourseCredits" min="1" max="4" step="1" required>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="addCourseForm">Add Course</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Branch Modal -->
<div class="modal fade" id="editBranchModal" tabindex="-1" role="dialog" aria-labelledby="editBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBranchModalLabel">Edit Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCourseForm">
                    <div class="form-group">
                        <label for="editJobTitle">Course Name</label>
                        <input type="text" class="form-control" id="editCourseName" name="CourseName" required>
                    </div>
                    <input type="text" class="form-control" id="editCourseID" name="CourseID" hidden>
                    <div class="form-group">
                        <label for="editJobDescription">Course Code</label>
                        <input type="text" class="form-control" id="editCourseCode" name="CourseCode" required>
                    </div>
                    <div class=" form-group">
                        <label for="editRequiredQualifications">Credits</label>
                        <input type="number" class="form-control" id="editCourseCredits" name="CourseCredits" rows="3" min="1" max="4" step="1" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveEditCourseBtn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="js/sb-admin-2.min.js"></script>

    <?php require_once("components/scripts.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#datatablesSimple').DataTable({

                "serverSide": true,
                "ajax": {
                    "url": "actions/data.php",
                    "type": "POST",
                    "data": function(d) {
                        return $.extend({}, d, {
                            // Additional data to send to the server if needed
                        });
                    }
                },
                "columns": [{
                        "data": "CourseName"
                    },
                    {
                        "data": "CourseCode"
                    },
                    {
                        "data": "Credits"
                    },
                    {
                        "data": "CreatedAt"
                    },
                    {
                        "data": "UpdatedAt"
                    },
                    {
                        "data": "Actions",
                        "orderable": false
                    }
                ],
                "pagingType": "full_numbers",
                "language": {

                    "lengthMenu": "Display _MENU_ records per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                },
                "responsive": true
            });
        });
        $('#addCourseForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting the default way
            console.log("Form submitted");

            $.ajax({
                url: 'actions/add_course.php',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
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


        function confirmDeleteCourse(CourseID) {
            console.log(CourseID); // Log the course name to the console

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
                            CourseID: CourseID
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
                                'Unable to delete branch. Please try again.',
                                'error'
                            );
                            console.error('AJAX Error:', status, error); // Log detailed error
                        }
                    });
                }
            });
        }

        function fillEditCourseForm(button) {
            // Get data attributes from the button
            var CourseID = $(button).data('course');
            var CourseName = $(button).data('name');
            var CourseCode = $(button).data('code');
            var Credits = $(button).data('credits');
            // Populate the fields in the Edit Course Modal
            $('#editCourseID').val(CourseID);
            $('#editCourseName').val(CourseName);
            $('#editCourseCode').val(CourseCode);
            $('#editCourseCredits').val(Credits);
        }
        $(document).ready(function() {

            // Handle form submission
            $('#saveEditCourseBtn').click(function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Get the form data
                var formData = $('#editCourseForm').serialize();

                // AJAX request to submit the form
                $.ajax({
                    url: 'actions/edit_course.php', // Endpoint for editing branch
                    method: 'POST',
                    processData: false, // Prevent jQuery from processing the data
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload(); // Reload the page to reflect changes
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An unexpected error occurred.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
        // Get the input element
        const creditsInput = document.getElementById('credits');

        // Listen for input changes
        creditsInput.addEventListener('input', () => {
            // Parse the value as a number
            let value = parseInt(creditsInput.value, 10);

            // Check if the value is not a number, below min, or above max
            if (isNaN(value) || value < 1) {
                creditsInput.value = 1; // Set to minimum if below range
            } else if (value > 4) {
                creditsInput.value = 1; // Set to maximum if above range
            }
        });

        // Prevent entering decimals
        creditsInput.addEventListener('keydown', (event) => {
            if (event.key === '.' || event.key === ',') {
                event.preventDefault();
            }
        });
        const editCredita = document.getElementById('editCourseCredits');

        // Listen for input changes
        editCredita.addEventListener('input', () => {
            // Parse the value as a number
            let value = parseInt(editCredita.value, 10);

            // Check if the value is not a number, below min, or above max
            if (isNaN(value) || value < 1) {
                editCredita.value = 1; // Set to minimum if below range
            } else if (value > 4) {
                editCredita.value = 1; // Set to maximum if above range
            }
        });

        // Prevent entering decimals
        editCredita.addEventListener('keydown', (event) => {
            if (event.key === '.' || event.key === ',') {
                event.preventDefault();
            }
        });
    </script>




    </body>

    </html>