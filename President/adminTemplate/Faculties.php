<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php
require_once('DAL/retrieve.class.php');

$universityData = new UniversityDataRetrieval();
$faculties = $universityData->getAllFaculties();
$employees = $universityData->getAllOtherEmployees();
?>
<!-- Add Faculty Modal -->
<!-- Add Faculty Modal -->
<!-- Add Faculty Modal -->
<div class="modal fade" id="addFacultyModal" tabindex="-1" role="dialog" aria-labelledby="addFacultyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFacultyModalLabel">Add Faculty</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addFacultyForm">
                    <div class="form-group">
                        <label for="faculityName">Faculty Name</label>
                        <input type="text" class="form-control" id="faculityName" name="faculityName" required>
                    </div>
                    <div class="form-group">
                        <label for="creditFee">Credit Fee</label>
                        <input type="number" class="form-control" id="creditFee" name="creditFee" step="20">
                    </div>
                    <div class="form-group">
                        <label for="facultyHead">Faculty Head</label>
                        <select class="form-control" id="facultyHead" name="facultyHead" required>
                            <?php
                            // Fetch employees from the database
                            $employees = $universityData->getAllOtherEmployees();

                            // Check if employees are retrieved
                            if ($employees) {
                                foreach ($employees as $employee) {
                                    // Output each employee as an option in the dropdown
                                    echo '<option value="' . htmlspecialchars($employee['UserID']) . '">'
                                        . htmlspecialchars($employee['Role']) . ' (' . htmlspecialchars($employee['UserID']) . ')'
                                        . '</option>';
                                }
                            } else {
                                // Optional: Provide a message when no employees are available
                                echo '<option value="">No employees available</option>';
                            }
                            ?>
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary">Add Faculty</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Faculties</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Faculties List</h6>
        </div>
        <div class="card-body">
            <!-- Button to open the Add Faculty Modal -->
            <!-- Button to open the Add Faculty Modal -->
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addFacultyModal">Add Faculty</button>


            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Faculty ID</th>
                            <th>Faculty Name</th>
                            <th>Credit Fee</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                            <!-- Add more fields as necessary -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if ($faculties) {
                            foreach ($faculties as $faculty) {
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($faculty['FacultyID']); ?></td>
                                    <td><?php echo htmlspecialchars($faculty['FaculityName']); ?></td>
                                    <td><?php echo htmlspecialchars($faculty['CreditFee']); ?></td>
                                    <td><?php echo htmlspecialchars($faculty['CreatedAt']); ?></td>
                                    <td><?php echo htmlspecialchars($faculty['UpdatedAt']); ?></td>
                                    <td>
                                        <a href="faculty.php?facultyID=<?php echo htmlspecialchars($faculty['FacultyID']) ?>" class="btn btn-primary">
                                            Show Faculty
                                        </a>

                                    </td>
                                </tr>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="4">No faculties found</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once("components/footer.php"); ?>

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
<!-- Modal -->

<?php require_once("components/scripts.php"); ?>
<script>
    $(document).ready(function() {
        // Form submission handler
        $('#addFacultyForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Gather form data manually
            var faculityName = $('#faculityName').val();
            var creditFee = $('#creditFee').val();
            var facultyHead = $('#facultyHead').val();

            // Create data object
            var data = {
                faculityName: faculityName,
                creditFee: creditFee,
                facultyHead: facultyHead
            };

            // Perform AJAX request
            $.ajax({
                url: 'actions/add_faculty.php', // PHP file to handle the form submission
                type: 'POST',
                data: data, // Send data as form data
                success: function(response) {
                    // Check if response is already an object
                    var res = typeof response === 'string' ? JSON.parse(response) : response;

                    if (res.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: res.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // Reload the page upon confirmation
                            }
                        });
                    } else {
                        Swal.fire('Error!', res.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'An error occurred while submitting the form.', 'error');
                }
            });
        });
    });
</script>


</body>

</html>