<?php

require_once('components/header.php');
require_once('components/sidebar.php');
require_once('components/navbar.php');
?>
<style>
    .icon-button {
        background-color: white;
        margin-right: 1%;
        color: blue;
        border-color: blue;
        font-size: 1rem;
        /* Base font size */
        padding: 0.5rem 1rem;
        /* Base padding */
        border-radius: 40px;
        /* Base border radius */
        transition: all 0.3s ease;
        /* Smooth transition */
    }

    /* Hover effect */
    .icon-button:hover {
        background-color: blue;
        color: white;
        border-color: blue;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid d-flex flex-column justify-content-center" style="min-height: 60vh;">
    <div class="d-flex flex-column justify-content-center align-items-center flex-grow-1 w-100">
        <div class="w-100">
            <form id="studentSearchForm" class="mx-auto" style="max-width: 400px;">
                <h2 class="mb-4 text-center">Enter Student Application ID</h2>
                <div class="form-group">
                    <input type="text" name="student_id" id="student_id" class="form-control" placeholder="Student Application ID" required>
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
            var applicationId = $('#student_id').val();

            $.ajax({
                url: 'actions/search_studentapplication.php', // URL to the PHP script
                type: 'POST',
                data: {
                    application_id: applicationId
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
                                    <h4>Student Application Information</h4>
                                     <button type="button" class="btn btn-warning icon-button" 
        data-id="${student.application_id}" 
        data-faculty="${student.chosen_school}" 
        data-department="${student.chosen_major}" 
        data-branch="${student.school_branch}" 
        data-username="${student.first_name} ${student.last_name}">
    Approve
</button>

                                </div>
                                <div class="card-body">
                                <p><strong>ApplicationID:</strong> ${student.application_id}</p>
<p><strong>Campus:</strong> ${student.campus}</p>
<p><strong>Semester:</strong> ${student.semester}</p>
<p><strong>Application Date:</strong> ${student.application_date}</p>
<p><strong>First Name:</strong> ${student.first_name}</p>
<p><strong>Middle Name:</strong> ${student.middle_name}</p>
<p><strong>Last Name:</strong> ${student.last_name}</p>
<p><strong>Gender:</strong> ${student.gender}</p>
<p><strong>Date of Birth:</strong> ${student.date_of_birth}</p>
<p><strong>Place of Birth:</strong> ${student.place_of_birth}</p>
<p><strong>Country of Birth:</strong> ${student.country_of_birth}</p>
<p><strong>Nationality Type:</strong> ${student.nationality_type}</p>
<p><strong>Nationality 1:</strong> ${student.nationality_1}</p>
<p><strong>Nationality 2:</strong> ${student.nationality_2}</p>
<p><strong>Record Number:</strong> ${student.record_number}</p>
<p><strong>Location:</strong> ${student.location}</p>
<p><strong>Lebanese Document Type:</strong> ${student.lebanese_document_type}</p>
<p><strong>Lebanese Document Number:</strong> ${student.lebanese_document_number}</p>
<p><strong>Passport Number:</strong> ${student.passport_number}</p>
<p><strong>Father's Name:</strong> ${student.father_name}</p>
<p><strong>Mother's Name:</strong> ${student.mother_name}</p>
<p><strong>Mother's Maiden Name:</strong> ${student.mother_maiden_name}</p>
<p><strong>Emergency Contact Person:</strong> ${student.emergency_contact_person}</p>
<p><strong>Emergency Contact Phone:</strong> ${student.emergency_contact_phone}</p>
<p><strong>City Area:</strong> ${student.city_area}</p>
<p><strong>Street:</strong> ${student.street}</p>
<p><strong>Building:</strong> ${student.building}</p>
<p><strong>Phone:</strong> ${student.phone}</p>
<p><strong>Mobile:</strong> ${student.mobile}</p>
<p><strong>Student Occupation:</strong> ${student.student_occupation}</p>
<p><strong>Student Company Name:</strong> ${student.student_company_name}</p>
<p><strong>Father's Occupation:</strong> ${student.father_occupation}</p>
<p><strong>Father's Company Name:</strong> ${student.father_company_name}</p>
<p><strong>Mother's Occupation:</strong> ${student.mother_occupation}</p>
<p><strong>Mother's Company Name:</strong> ${student.mother_company_name}</p>
<p><strong>Attended School:</strong> ${student.attended_school}</p>
<p><strong>School From Date:</strong> ${student.school_from_date}</p>
<p><strong>School To Date:</strong> ${student.school_to_date}</p>
<p><strong>Diploma Type:</strong> ${student.diploma_type}</p>
<p><strong>School Branch:</strong> ${student.school_branch}</p>
<p><strong>School Year:</strong> ${student.school_year}</p>
<p><strong>School Course:</strong> ${student.school_course}</p>
<p><strong>Candidate Number:</strong> ${student.candidate_number}</p>
<p><strong>Country of Study:</strong> ${student.country_of_study}</p>
<p><strong>Certificate Source:</strong> ${student.certificate_source}</p>
<p><strong>GPA Numerator:</strong> ${student.gpa_numerator}</p>
<p><strong>GPA Denominator:</strong> ${student.gpa_denominator}</p>
<p><strong>Education Level:</strong> ${student.education_level}</p>
<p><strong>Choice of Program:</strong> ${student.choice_of_program}</p>
<p><strong>Chosen School:</strong> ${student.chosen_school}</p>
<p><strong>Chosen Major:</strong> ${student.chosen_major}</p>
<p><strong>Application Source:</strong> ${student.application_source}</p>

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
    $(document).ready(function() {
        $('.icon-button').on('click', function() {
            var applicationId = $(this).data('id');
            var faculty = $(this).data('faculty');
            var department = $(this).data('department');
            var branch = $(this).data('branch');
            var username = $(this).data('username');

            $.ajax({
                url: 'actions/register_student.php',
                type: 'POST',
                data: {
                    id: applicationId,
                    faculty: faculty,
                    department: department,
                    branch: branch,
                    username: username
                },
                success: function(response) {
                    // Use SweetAlert to show a success message
                    Swal.fire({
                        title: 'Approved!',
                        text: 'The application has been successfully approved.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors with SweetAlert
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an issue approving the application. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>

</body>

</html>