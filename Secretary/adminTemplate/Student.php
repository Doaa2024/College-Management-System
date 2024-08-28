<?php

require_once('components/header.php');
require_once('components/sidebar.php');
require_once('components/navbar.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid d-flex flex-column justify-content-center" style="min-height: 60vh;">
    <div class="d-flex flex-column justify-content-center align-items-center flex-grow-1 w-100">
        <div class="w-100">
            <form id="studentSearchForm" class="mx-auto" style="max-width: 400px;">
                <h2 class="mb-4 text-center">Enter Student ID</h2>
                <div class="form-group">
                    <input type="text" name="student_id" id="student_id" class="form-control" placeholder="Student ID" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
            <!-- Results will be displayed here -->
            <div id="StudentShownhere" class="mt-4 w-100"></div>
        </div>
    </div>
</div>
<!-- End Page Content -->

<!-- Footer -->
<div class="w-100">
    <?php require_once("components/footer.php"); ?>
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




<?php require_once("components/scripts.php"); ?>

<script>
    $(document).ready(function() {
        $('#studentSearchForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get the student ID value
            var studentId = $('#student_id').val();

            $.ajax({
                url: 'actions/search_student.php', // URL to the PHP script
                type: 'POST',
                data: {
                    student_id: studentId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Generate HTML for student information
                        var student = response.data;
                        // ?student_id=${student.UserID}
                        var studentInfoHtml = `
                           <div class="card bg-primary text-white">
                               <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                                    <h4>Student Information</h4>
                                    <a href="../../Student/dist/index.php?student_id=${student.UserID}" id="visitStudentPage" class="btn btn-light">Visit Student Page</a>
                                </div>
                                <div class="card-body">
                                    <p><strong>ID:</strong> ${student.UserID}</p>
                                    <p><strong>Username:</strong> ${student.Username}</p>
                                    <p><strong>Email:</strong> ${student.Email}</p>
                                    <p><strong>Status:</strong> ${student.Status}</p>
                                    <p><strong>Role:</strong> ${student.Role}</p>
                                    <p><strong>Created At:</strong> ${student.CreatedAt}</p>
                                    <p><strong>Updated At:</strong> ${student.UpdatedAt}</p>
                                    <!-- Add more fields as needed -->
                                </div>
                            </div>

                        `;

                        // Insert HTML into the div
                        $('#StudentShownhere').html(studentInfoHtml);
                    } else {
                        // Show error message in the div
                        $('#StudentShownhere').html(`
                            <div class="alert alert-danger" role="alert">
                                ${response.message}
                            </div>
                        `);
                    }
                },
                error: function() {
                    // Show error message in the div
                    $('#StudentShownhere').html(`
                        <div class="alert alert-danger" role="alert">
                            An error occurred while processing your request.
                        </div>
                    `);
                }
            });
        });
    });
</script>

</body>

</html>