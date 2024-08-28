<?php
require_once('components/header.php');
require_once('components/sidebar.php');
require_once('components/navbar.php');
?>
<style>
    .review-btn {
        background-color: white;
        color: blue;
        border-color: blue;
        font-size: 1rem;
        /* Base font size */
        padding: 0.5rem 1rem;
        /* Base padding */
        border-radius: 0.25rem;
        /* Base border radius */
        transition: all 0.3s ease;
        /* Smooth transition */
    }

    /* Hover effect */
    .review-btn:hover {
        background-color: blue;
        color: white;
        border-color: blue;
    }

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



    /* Responsive adjustments */
    @media (max-width: 768px) {
        .review-btn {
            font-size: 0.8rem;
            /* Smaller font size on smaller screens */
            padding: 0.4rem 0.4rem;
            /* Adjust padding on smaller screens */
        }
    }

    @media (max-width: 576px) {
        .review-btn {
            font-size: 0.7rem;
            /* Even smaller font size on very small screens */
            padding: 0.2rem 0.2rem;
            /* Further adjust padding */
        }
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid d-flex flex-column" style="min-height: 60vh;">
    <div class="d-flex flex-column justify-content-center align-items-center flex-grow-1 w-100">
        <div class="w-100">
            <form id="employeeSearchForm" class="mx-auto" style="max-width: 400px;">
                <h2 class="mb-4 text-center">Enter Employee Application ID</h2>
                <div class="form-group">
                    <input type="text" name="employee_id" id="employee_id" class="form-control" placeholder="Employee Application ID" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
            <!-- Results will be displayed here -->
            <div id="EmployeeShownhere" class="mt-4 w-100"></div>
        </div>
    </div>
</div>
<!-- End Page Content -->

<!-- Footer -->
<div class="w-100 mt-auto">
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
        // Handle employee search form submission
        $('#employeeSearchForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get the employee ID value
            var employeeId = $('#employee_id').val();

            $.ajax({
                url: 'actions/search_employeeapplication.php', // URL to the PHP script
                type: 'POST',
                data: {
                    employee_id: employeeId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        var employee = response.data;

                        // Generate HTML for employee information
                        var cvLink = employee.CVPath ? `
                                <a href="http://localhost/mosque-website-template/mosque-website-template/assets/img/${employee.CVPath}" target="_blank" rel="noopener noreferrer">
                                    <button class="icon-button">CV</button>
                                </a>
                            ` : '';

                        var coverLetterLink = employee.CoverLetterPath ? `
                                <a href="http://localhost/mosque-website-template/mosque-website-template/assets/img/${employee.CoverLetterPath}" target="_blank" rel="noopener noreferrer">
                                    <button class="icon-button">Cover Letter</button>
                                </a>
                            ` : '';

                        var additionalDocsLink = employee.AdditionalDocumentsPath ? `
                                <a href="http://localhost/mosque-website-template/mosque-website-template/assets/img/${employee.AdditionalDocumentsPath}" target="_blank" rel="noopener noreferrer">
                                    <button class="icon-button">Additional Documents</button>
                                </a>
                            ` : '';

                        var employeeInfoHtml = `
                                <!-- Employee Information Card -->
                                <div class="card bg-primary text-white">
                                    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                                        <h4>Employee Information</h4>
                                        <button type="button" class="btn btn-warning review-btn" data-employee-id="${employee.ApplicationID}">
                                            Review Application
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Application ID:</strong> ${employee.ApplicationID}</p>
                                        <p><strong>Position Applied For:</strong> ${employee.PositionAppliedFor}</p>
                                        <p><strong>Application Date:</strong> ${employee.ApplicationDate}</p>
                                        <p><strong>Reviewed By:</strong> ${employee.ReviewedBy}</p>
                                        <p><strong>Reviewed At:</strong> ${employee.ReviewedAt}</p>
                                        <p><strong>Status:</strong> ${employee.Status}</p>
                                        <p><strong>Comments:</strong> ${employee.Comments}</p>
                                        <p><strong>Created At:</strong> ${employee.CreatedAt}</p>
                                        <p><strong>Updated At:</strong> ${employee.UpdatedAt}</p>
                                        ${cvLink}
                                        ${coverLetterLink}
                                        ${additionalDocsLink}
                                    </div>
                                </div>
                            `;

                        // Insert HTML into the div
                        $('#EmployeeShownhere').html(employeeInfoHtml);

                        // Handle the review button click event
                        $('.review-btn').on('click', function() {
                            var employeeId = $(this).data('employee-id');
                            createAndShowModal(employeeId, employee);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message || 'Something went wrong! Please try again.',
                            showConfirmButton: true
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while processing your request.',
                        showConfirmButton: true
                    });
                }
            });
        });

        function createAndShowModal(employeeId, employee) {
            var modalHtml = `
                    <!-- Review Application Modal -->
                    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reviewModalLabel">Review Application</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editForm">
                                        <div class="form-group">
                                            <label for="reviewedBy">Reviewed By</label>
                                            <input type="number" class="form-control" id="reviewedBy" name="reviewedBy" placeholder="Enter Your ID" value="${employee.ReviewedBy}" min="0" step="1" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="reviewedAt">Reviewed At</label>
                                            <input type="date" class="form-control" id="reviewedAt" name="reviewedAt" value="${employee.ReviewedAt}" required>
                                            <input type="hidden" id="employee_id_hidden" name="record_id" value="${employee.ApplicationID}">
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="Pending" ${employee.Status === 'Pending' ? 'selected' : ''}>Pending</option>
                                                <option value="Approved" ${employee.Status === 'Approved' ? 'selected' : ''}>Approved</option>
                                                <option value="Rejected" ${employee.Status === 'Rejected' ? 'selected' : ''}>Rejected</option>
                                                <option value="Under Review" ${employee.Status === 'Under Review' ? 'selected' : ''}>Under Review</option>
                                            </select>
                                        </div>
                                        <button type="submit" id="saveBtn" class="btn btn-primary">Submit Review</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

            // Remove any existing modal before appending a new one
            $('#reviewModal').remove();

            // Append the new modal to the body
            $('body').append(modalHtml);

            // Show the modal
            $('#reviewModal').modal('show');

            // Handle the review form submission
            $('#editForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                var formData = $(this).serialize();

                $.ajax({
                    url: 'actions/edit_employeeapplication.php', // Correct PHP script path
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Review was submitted successfully',
                                showConfirmButton: true
                            }).then(function() {
                                $('#reviewModal').modal('hide').on('hidden.bs.modal', function() {
                                    $(this).remove();
                                });

                                var updatedEmployee = response.data;
                                var updatedInfoHtml = `
                                        <!-- Updated Employee Information Card -->
                                        <div class="card bg-primary text-white">
                                            <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                                                <h4>Employee Information</h4>
                                                <button type="button" class="btn btn-warning review-btn" data-employee-id="${updatedEmployee.ApplicationID}">
                                                    Review Application
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Application ID:</strong> ${updatedEmployee.ApplicationID}</p>
                                                <p><strong>Position Applied For:</strong> ${updatedEmployee.PositionAppliedFor}</p>
                                                <p><strong>Application Date:</strong> ${updatedEmployee.ApplicationDate}</p>
                                                <p><strong>Reviewed By:</strong> ${updatedEmployee.ReviewedBy}</p>
                                                <p><strong>Reviewed At:</strong> ${updatedEmployee.ReviewedAt}</p>
                                                <p><strong>Status:</strong> ${updatedEmployee.Status}</p>
                                                <p><strong>Comments:</strong> ${updatedEmployee.Comments}</p>
                                                <p><strong>Created At:</strong> ${updatedEmployee.CreatedAt}</p>
                                                <p><strong>Updated At:</strong> ${updatedEmployee.UpdatedAt}</p>
                                                ${updatedEmployee.CVPath ? `<a href="http://localhost/mosque-website-template/mosque-website-template/assets/img/${updatedEmployee.CVPath}" target="_blank" rel="noopener noreferrer"><button class="icon-button">CV</button></a>` : ''}
                                                ${updatedEmployee.CoverLetterPath ? `<a href="http://localhost/mosque-website-template/mosque-website-template/assets/img/${updatedEmployee.CoverLetterPath}" target="_blank" rel="noopener noreferrer"><button class="icon-button">Cover Letter</button></a>` : ''}
                                                ${updatedEmployee.AdditionalDocumentsPath ? `<a href="http://localhost/mosque-website-template/mosque-website-template/assets/img/${updatedEmployee.AdditionalDocumentsPath}" target="_blank" rel="noopener noreferrer"><button class="icon-button">Additional Documents</button></a>` : ''}
                                            </div>
                                        </div>
                                    `;

                                $('#EmployeeShownhere').html(updatedInfoHtml);

                                // Reattach event handlers to updated buttons
                                $('.review-btn').on('click', function() {
                                    var employeeId = $(this).data('employee-id');
                                    createAndShowModal(employeeId, updatedEmployee);
                                });
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message || 'Something went wrong! Please try again.',
                                showConfirmButton: true
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred while processing your request.',
                            showConfirmButton: true
                        });
                    }
                });
            });
        }
    });
</script>

</body>

</html>