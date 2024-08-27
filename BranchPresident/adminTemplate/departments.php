<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php require_once('DAL/retrieve.class.php'); ?>
<?php $dataRetrieval = new UniversityDataRetrieval(); ?>
<?php $branchId = isset($_GET['branchId']) ? intval($_GET['branchId']) : 1; ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Departments Associated With my Branch</h5>
            <!-- Add Department Button -->
            <button class="btn btn-success float-right" data-toggle="modal" data-target="#addDepartmentModal">Add Department</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Department ID</th>
                            <th>Department Name</th>
                            <th>Faculty Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Get departments data
                        $departments = $dataRetrieval->getDepartmentsInBranch($branchId);

                        // Loop through the departments array and populate the table
                        foreach ($departments as $dept) {
                        ?>
                            <tr>
                                <td><?php echo $dept['DepartmentID']; ?></td>
                                <td><?php echo $dept['DepartmentName']; ?></td>
                                <td><?php echo $dept['FaculityName']; ?></td>
                                <td><?php echo $dept['CreatedAt']; ?></td>
                                <td><?php echo $dept['UpdatedAt']; ?></td>
                                <td>
                                    <div style="display:flex; gap:10px">
                                        <button class="btn btn-primary edit-btn" data-id="<?php echo $dept['DepartmentID']; ?>" data-toggle="modal" data-target="#editDepartmentModal">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger delete-btn" data-id="<?php echo $dept['DepartmentID']; ?>">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
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

<!-- Add Department Modal -->
<div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDepartmentModalLabel">Add Department</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addDepartmentForm">
                    <div class="form-group">
                        <label for="departmentName">Department Name</label>
                        <input type="text" class="form-control" id="departmentName" name="departmentName" required>
                    </div>
                    <div class="form-group">
                        <label for="facultyID">Select Faculty</label>
                        <select class="form-control" id="facultyID" name="facultyID" required>
                            <option value="">Select Faculty</option>
                            <?php

                            $Facs = $dataRetrieval->getFacInBranch($branchId);
                            foreach ($Facs as $Fac) {
                                echo "<option value='" . $Fac['FacultyID'] . "'>" . $Fac['FaculityName'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="saveDepartmentBtn">Save Department</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Department Modal -->
<div class="modal fade" id="editDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editDepartmentForm">
                    <input type="hidden" id="editDepartmentID" name="departmentID">
                    <div class="form-group">
                        <label for="editDepartmentName">Department Name</label>
                        <input type="text" class="form-control" id="editDepartmentName" name="departmentName" required>
                    </div>
                    <div class="form-group">
                        <label for="editFacultyID">Select Faculty</label>
                        <select class="form-control" id="editFacultyID" name="facultyID" required>
                            <option value="">Select Faculty</option>
                            <?php
                            // Fetch and populate faculty options
                            $Facs = $dataRetrieval->getFacInBranch($branchId);
                            foreach ($Facs as $Fac) {
                                echo "<option value='" . $Fac['FacultyID'] . "'>" . $Fac['FaculityName'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="updateDepartmentBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<?php require_once("components/footer.php"); ?>
<?php require_once("components/scripts.php"); ?>

<script>
    $(document).ready(function() {
        $('#saveDepartmentBtn').on('click', function() {
            var departmentName = $('#departmentName').val();
            var facultyID = $('#facultyID').val();

            if (departmentName && facultyID) {
                $.ajax({
                    url: 'actions/add_department.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        departmentName: departmentName,
                        facultyID: facultyID,
                        branchID: <?php echo $branchId; ?>
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Department added successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload(); // Reload the page if confirmed
                                }
                            });
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'An error occurred while adding the department.', 'error');
                    }
                });
            } else {
                Swal.fire('Warning!', 'Please fill in all fields.', 'warning');
            }
        });
    });
    $(document).ready(function() {
        // Open the edit modal and populate it with data
        $('#dataTable').on('click', '.edit-btn', function() {
            var departmentID = $(this).data('id');

            $.ajax({
                url: 'actions/get_department.php', // PHP script to get department details
                type: 'POST',
                dataType: 'json',
                data: {
                    departmentID: departmentID
                },
                success: function(response) {
                    if (response.success) {
                        $('#editDepartmentID').val(response.data.DepartmentID);
                        $('#editDepartmentName').val(response.data.DepartmentName);
                        $('#editFacultyID').val(response.data.FacultyID);
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'An error occurred while fetching department details.', 'error');
                }
            });
        });

        // Save changes to the department
        $('#updateDepartmentBtn').on('click', function() {
            var departmentID = $('#editDepartmentID').val();
            var departmentName = $('#editDepartmentName').val();
            var facultyID = $('#editFacultyID').val();

            if (departmentID && departmentName && facultyID) {
                $.ajax({
                    url: 'actions/update_department.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        departmentID: departmentID,
                        departmentName: departmentName,
                        facultyID: facultyID,
                        branchID: <?php echo $branchId; ?>
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Department updated successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload(); // Reload the page if confirmed
                                }
                            });
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'An error occurred while updating the department.', 'error');
                    }
                });
            } else {
                Swal.fire('Warning!', 'Please fill in all fields.', 'warning');
            }
        });
    });
    $(document).ready(function() {
        // Delete department event
        $('#dataTable').on('click', '.delete-btn', function() {
            var departmentID = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'actions/delete_department.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            departmentID: departmentID
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Department has been deleted.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload(); // Reload the page
                                });
                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'An error occurred while deleting the department.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>

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
</body>

</html>