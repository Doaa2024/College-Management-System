<?php
require_once('components/header.php');
require_once('components/sidebar.php');
require_once('components/navbar.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid d-flex flex-column" style="min-height: 60vh;">
    <div class="d-flex flex-column justify-content-center align-items-center flex-grow-1 w-100">
        <div class="w-100">
            <form id="employeeSearchForm" class="mx-auto" style="max-width: 400px;">
                <h2 class="mb-4 text-center">Enter Employee ID</h2>
                <div class="form-group">
                    <input type="text" name="employee_id" id="employee_id" class="form-control" placeholder="Employee ID" required>
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
        $('#employeeSearchForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get the employee ID value
            var employeeId = $('#employee_id').val();

            $.ajax({
                url: 'actions/search_employee.php', // URL to the PHP script
                type: 'POST',
                data: {
                    employee_id: employeeId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Generate HTML for employee information
                        var employee = response.data;
                        // ?employee_id=${employee.UserID}
                        var employeeInfoHtml = `
                            <div class="card bg-primary text-white">
                                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                                    <h4>Employee Information</h4>
                                 
                                </div>
                                <div class="card-body">
                                    <p><strong>ID:</strong> ${employee.UserID}</p>
                                    <p><strong>Username:</strong> ${employee.Username}</p>
                                    <p><strong>Email:</strong> ${employee.Email}</p>
                                    <p><strong>Status:</strong> ${employee.Status}</p>
                                    <p><strong>Role:</strong> ${employee.Role}</p>
                                    <p><strong>Created At:</strong> ${employee.CreatedAt}</p>
                                    <p><strong>Updated At:</strong> ${employee.UpdatedAt}</p>
                                    <!-- Add more fields as needed -->
                                </div>
                            </div>
                        `;

                        // Insert HTML into the div
                        $('#EmployeeShownhere').html(employeeInfoHtml);
                    } else {
                        // Show error message in the div
                        $('#EmployeeShownhere').html(`
                            <div class="alert alert-danger" role="alert">
                                ${response.message}
                            </div>
                        `);
                    }
                },
                error: function() {
                    // Show error message in the div
                    $('#EmployeeShownhere').html(`
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