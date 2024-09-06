<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php require_once('DAL/retrieve.class.php');

$dataFetch = new UniversityDataRetrieval();
$employee = $dataFetch->getEmployee();
$allCampus = $dataFetch->getCampus();
$allDepartment = $dataFetch->getDepartment();
$allFaculty = $dataFetch->getFaculty();
?>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Information</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="editForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role">
                            <option value="Professor">Professor</option>
                            <option value="Branch Head">Branch Head</option>
                            <option value="Dean">Dean</option>
                            <option value="Assistant Dean">Assistant Dean</option>
                            <option value="Secretary">Secretary</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="branch">Branch</label>
                        <select class="form-control" id="branch" name="branch">
                            <?php foreach ($allCampus as $campus): ?>
                                <option value="<?= htmlspecialchars($campus['BranchID']); ?>">
                                    <?= htmlspecialchars($campus['BranchName']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="faculty">Faculty</label>
                        <select class="form-control" id="faculty" name="faculty">
                            <?php foreach ($allFaculty as $faculty): ?>
                                <option value="<?= htmlspecialchars($faculty['FacultyID']); ?>">
                                    <?= htmlspecialchars($faculty['FaculityName']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <input type="hidden" id="record_id" name="record_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Begin Modal for Password -->
<div class="modal fade" id="editPassword" tabindex="-1" role="dialog" aria-labelledby="editPasswordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPasswordLabel">Edit Password</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="editPasswordForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input class="form-control" id="passwordo" name="password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input class="form-control" id="confirm_passwordo" name="confirm_password">
                    </div>
                    <input type="hidden" id="record_id_password" name="record_id_password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Employees</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>User Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Faculty ID</th>
                            <th>Branch ID</th>
                            <th>Status</th>
                            <th>Joined At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employee as $row): ?>
                            <tr>
                                <td><?= nl2br(htmlspecialchars($row['UserID'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></td>
                                <td><?= nl2br(htmlspecialchars($row['Username'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></td>
                                <td><?= htmlspecialchars($row['Role']); ?></td>
                                <td><?= htmlspecialchars($row['Email']); ?></td>
                                <td><?= htmlspecialchars($row['FacultyID']); ?></td>
                                <td><?= htmlspecialchars($row['BranchID']); ?></td>
                                <td><?= htmlspecialchars($row['Status']); ?></td>
                                <td><?= htmlspecialchars($row['CreatedAt']); ?></td>
                                <td>
                                    <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editModal" style="margin-bottom: 5px;"
                                        data-id="<?= htmlspecialchars($row['UserID']); ?>"
                                        data-status="<?= htmlspecialchars($row['Status']); ?>"
                                        data-role="<?= htmlspecialchars($row['Role']); ?>"
                                        data-branch="<?= htmlspecialchars($row['BranchID']); ?>"
                                        data-faculty="<?= htmlspecialchars($row['FacultyID']); ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-edit-password" data-toggle="modal" data-target="#editPassword"
                                        data-id="<?= htmlspecialchars($row['UserID']); ?>">
                                        <i class="fas fa-key"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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

<?php require_once("components/scripts.php"); ?>

<!-- AJAX and SweetAlert Integration -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Open edit modal and populate fields with data
        $('.btn-edit').on('click', function() {
            var id = $(this).data('id');
            var role = $(this).data('role');
            var status = $(this).data('status');
            var branch = $(this).data('branch');
            var faculty = $(this).data('faculty');

            $('#editModal #record_id').val(id);
            $('#editModal #role').val(role);
            $('#editModal #status').val(status);
            $('#editModal #branch').val(branch);
            $('#editModal #faculty').val(faculty);
        });

        // Open password edit modal and set user ID
        $('.btn-edit-password').on('click', function() {
            var id = $(this).data('id');
            $('#editPasswordForm #record_id_password').val(id);
        });

        // Handle edit form submission
        $('#editForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'actions/edit_registered_employee.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message || 'Employee Info updated successfully.',
                            showConfirmButton: true
                        }).then(function() {
                            location.reload();
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
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again.',
                        showConfirmButton: true
                    });
                }
            });
        });

        // Handle password edit form submission
        $('#editPasswordForm').on('submit', function(e) {
            e.preventDefault();

            var password = $('#passwordo').val();
            var confirmPassword = $('#confirm_passwordo').val();
            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Passwords do not match. Please try again.',
                    showConfirmButton: true
                });
                return;
            }
            // Password validation
            var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordPattern.test(password)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Password must be at least 8 characters long and include a mix of uppercase, lowercase, numbers, and special characters.',
                    showConfirmButton: true
                });
                return;
            }



            $.ajax({
                url: 'actions/update_password.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message || 'Password updated successfully.',
                            showConfirmButton: true
                        }).then(function() {
                            $('#editPassword').modal('hide');
                            location.reload(); // Reload the page to see the updated data
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message || 'Failed to update password. Please try again.',
                            showConfirmButton: true
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred. Please try again.',
                        showConfirmButton: true
                    });
                }
            });
        });
    });
</script>
</body>

</html>