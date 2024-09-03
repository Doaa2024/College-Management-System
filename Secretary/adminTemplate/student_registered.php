<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php require_once('DAL/retrieve.class.php');

$dataFetch = new UniversityDataRetrieval();
$student = $dataFetch->getStudents();
$allCampus = $dataFetch->getCampus();
$allDepartment = $dataFetch->getAllDepartments();
$allFaculty = $dataFetch->getFaculty();
$allRequirments = $dataFetch->getAllRequirements();
$allFreshman = $dataFetch->getAllFreshman();
?>
<style>
    .btn-doc-icon {
        background-color: #888;
        /* Light gray background */
        border: 1px solid #ccc;
        /* Light border */
        border-radius: 4px;
        /* Rounded corners */
        padding: 8px 12px;
        /* Padding around the icon */
        color: #333;
        /* Dark text color */
        transition: background-color 0.3s, transform 0.3s;
        /* Smooth hover effects */
    }

    .btn-doc-icon:hover {
        background-color: #999;
        /* Slightly darker on hover */
        transform: scale(1.05);
        /* Slightly enlarges on hover */
        border-color: #999;
        /* Darker border on hover */
    }

    /* Custom Modal Styles */
    .custom-modal {
        border-radius: 10px;
        /* Rounded corners for the modal */
        border: 1px solid #007bff;
        /* Border color */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Subtle shadow for depth */
    }

    .custom-modal-header {
        background-color: #007bff;
        /* Header background color */
        color: white;
        /* Header text color */
        border-top-left-radius: 10px;
        /* Match border radius with modal */
        border-top-right-radius: 10px;
        padding: 15px;
        /* More padding for the header */
    }

    .custom-modal-body {
        padding: 20px;
        /* Add padding to the modal body */
        background-color: #f8f9fa;
        /* Light gray background for the body */
    }

    .custom-modal-footer {
        background-color: #f1f1f1;
        /* Footer background color */
        border-bottom-left-radius: 10px;
        /* Match border radius with modal */
        border-bottom-right-radius: 10px;
        padding: 10px 20px;
        /* Padding for the footer */
    }

    .custom-close-btn {
        background-color: #6c757d;
        /* Custom color for the close button */
        border: none;
        /* Remove border */
    }

    .custom-save-btn {
        background-color: #007bff;
        /* Primary button color */
        border: none;
        /* Remove border */
        color: white;
        /* Button text color */
    }

    .custom-save-btn:hover,
    .custom-close-btn:hover {
        background-color: #0056b3;
        /* Darker color on hover */
        transition: background-color 0.3s;
        /* Smooth transition effect */
    }

    /* Style the checkboxes */
    .form-check-input {
        margin-top: 0.3rem;
        /* Align checkbox with the label */
    }

    .form-check-label {
        margin-left: 10px;
        /* Spacing between checkbox and label */
    }
</style>
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
                        <label for="role">Department</label>
                        <select class="form-control" id="department" name="department">
                            <?php foreach ($allDepartment as $department): ?>
                                <option value="<?= htmlspecialchars($department['DepartmentID']); ?>">
                                    <?= htmlspecialchars($department['DepartmentName']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Financial Block">Financial Block</option>
                            <option value="Daman Block">Daman Block</option>
                            <option value="Missing Documents Block">Missing Documents Block</option>
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
                        <input class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input class="form-control" id="confirm_password" name="confirm_password">
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
<!-- Modal Structure for Student -->
<div class="modal fade" id="docStudent" tabindex="-1" role="dialog" aria-labelledby="docsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content custom-modal">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title" id="docModalLabel">Required Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body custom-modal-body">
                <form id="docFormStudent" action="actions/edit_docs.php" method="POST">
                    <?php $documents = explode("\n", $allRequirments[0]['required_documents']); ?>

                    <?php foreach ($documents as $doc) { ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= htmlspecialchars($doc) ?>" id="docStudent_<?= htmlspecialchars($doc) ?>" name="documents[]">
                            <label class="form-check-label" for="docStudent_<?= htmlspecialchars($doc) ?>">
                                <?= htmlspecialchars($doc) ?>
                            </label>
                        </div>
                    <?php } ?>

                    <input type="hidden" id="studentID" name="studentID">
                </form>
            </div>
            <div class="modal-footer custom-modal-footer">
                <button type="button" class="btn btn-secondary custom-close-btn" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary custom-save-btn" form="docFormStudent">Save Changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Structure for Freshman -->
<div class="modal fade" id="docFreshman" tabindex="-1" role="dialog" aria-labelledby="docsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content custom-modal">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title" id="docModalLabel">Required Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body custom-modal-body">
                <form id="docFormFreshman" action="actions/edit_docs.php" method="POST">
                    <?php $documents = explode("\n", $allFreshman[0]['RequirementsList']); ?>

                    <?php foreach ($documents as $doc) { ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= htmlspecialchars($doc) ?>" id="docFreshman_<?= htmlspecialchars($doc) ?>" name="documents[]">
                            <label class="form-check-label" for="docFreshman_<?= htmlspecialchars($doc) ?>">
                                <?= htmlspecialchars($doc) ?>
                            </label>
                        </div>
                    <?php } ?>

                    <input type="hidden" id="studentID" name="studentID">
                </form>
            </div>
            <div class="modal-footer custom-modal-footer">
                <button type="button" class="btn btn-secondary custom-close-btn" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary custom-save-btn" form="docFormFreshman">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Students</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>User Name</th>
                            <th>Type</th>
                            <th>Email</th>
                            <th>Faculty ID</th>
                            <th>Branch ID</th>
                            <th>Major</th>
                            <th>Status</th>
                            <th>Joined At</th>
                            <th>Docs</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($student as $row): ?>
                            <tr>
                                <td><?= nl2br(htmlspecialchars($row['UserID'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></td>
                                <td><?= nl2br(htmlspecialchars($row['Username'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></td>
                                <td><?= htmlspecialchars($row['Role']); ?></td>
                                <td><?= htmlspecialchars($row['Email']); ?></td>
                                <td><?= htmlspecialchars($row['FacultyID']); ?></td>
                                <td><?= htmlspecialchars($row['BranchID']); ?></td>
                                <td><?= htmlspecialchars($row['DepartmentID']); ?></td>
                                <td><?= htmlspecialchars($row['Status']); ?></td>
                                <td><?= htmlspecialchars($row['CreatedAt']); ?></td>
                                <td> <?php if ($row['Role'] == 'Student'): ?>
                                        <button class="btn btn-doc-icon student" data-toggle="modal" data-target="#docStudent" data-id="<?= htmlspecialchars($row['UserID']); ?>">
                                            <i class="fas fa-file-alt" style="color:white"></i>
                                        </button>
                                    <?php elseif ($row['Role'] == 'Freshman'): ?>
                                        <button class="btn btn-doc-icon freshman" data-toggle="modal" data-target="#docFreshman" data-id="<?= htmlspecialchars($row['UserID']); ?>">
                                            <i class="fas fa-file-alt" style="color:white"></i>
                                        </button>
                                    <?php endif; ?>


                                <td>
                                    <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editModal" style="margin-bottom: 5px;"
                                        data-id="<?= htmlspecialchars($row['UserID']); ?>"
                                        data-status="<?= htmlspecialchars($row['Status']); ?>"
                                        data-department="<?= htmlspecialchars($row['DepartmentID']); ?>"
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
            var department = $(this).data('department');
            var status = $(this).data('status');
            var branch = $(this).data('branch');
            var faculty = $(this).data('faculty');

            $('#editModal #record_id').val(id);
            $('#editModal #department').val(department);
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
                url: 'actions/edit_registered_student.php',
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

            var password = $('#password').val();
            var confirmPassword = $('#confirm_password').val();
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

        $(document).ready(function() {
            // Attach a submit event handler to both forms
            $('#docFormFreshman').submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                var form = $(this);
                var formId = form.attr('id');

                // Submit the form data via AJAX
                $.ajax({
                    url: form.attr('action'), // Form action URL
                    type: form.attr('method'), // Form method
                    data: form.serialize(), // Serialized form data
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message || 'Documents updated successfully.',
                                showConfirmButton: true
                            }).then(function() {
                                location.reload(); // Reload page to reflect changes
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
                        console.error('AJAX error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong! Please try again.',
                            showConfirmButton: true
                        });
                    }
                });
            });

            $('#docFormStudent').submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                var form = $(this);
                var formId = form.attr('id');

                // Submit the form data via AJAX
                $.ajax({
                    url: form.attr('action'), // Form action URL
                    type: form.attr('method'), // Form method
                    data: form.serialize(), // Serialized form data
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message || 'Documents updated successfully.',
                                showConfirmButton: true
                            }).then(function() {
                                location.reload(); // Reload page to reflect changes
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
                        console.error('AJAX error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong! Please try again.',
                            showConfirmButton: true
                        });
                    }
                });
            });
        });



        $('.student, .freshman').on('click', function() {
            var id = $(this).data('id');
            var role = $(this).hasClass('student') ? 'Student' : 'Freshman';
            var modalId = role === 'Student' ? 'docStudent' : 'docFreshman';

            $('#' + modalId).modal('show');
            $('#docForm' + role + ' #studentID').val(id);

            // Fetch document statuses
            $.ajax({
                url: 'actions/get_docs_status.php',
                type: 'GET',
                data: {
                    studentID: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        var documents = response.documents;

                        // Reset all checkboxes to unchecked
                        $('#docForm' + role + ' .form-check-input').prop('checked', false);

                        // Set the state of checkboxes based on the response
                        documents.forEach(function(doc) {
                            // Ensure no extra spaces in document_name
                            var docName = doc.document_name.trim();
                            $('#docForm' + role + ' .form-check-input').each(function() {
                                if ($(this).val().trim() === docName) {
                                    $(this).prop('checked', doc.is_present == 1);
                                }
                            });
                        });
                    } else {
                        console.log(response.message); // Handle no documents found
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching document status:', error);
                }
            });
        });


    });
</script>
</body>

</html>