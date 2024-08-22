<?php require_once('components/header.php'); ?>


<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php
// Require the class file
require('DAL/retrieve.class.php');

// Instantiate the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();

// Retrieve all branches
$branches = $universityData->getAllBranches();

?>
<!-- Begin Page Content -->
<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Branches</h3>
            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addBranchModal">
                <i class="fas fa-plus"></i> Add Branch
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Branch ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($branches)) : ?>
                            <?php foreach ($branches as $branch) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($branch['BranchID']); ?></td>
                                    <td><?php echo htmlspecialchars($branch['BranchName']); ?></td>
                                    <td><?php echo htmlspecialchars($branch['Location']); ?></td>
                                    <td><?php echo htmlspecialchars($branch['CreatedAt']); ?></td>
                                    <td><?php echo htmlspecialchars($branch['UpdatedAt']); ?></td>
                                    <td>
                                        <div style="display:flex; gap:10px">

                                            <!-- Edit Branch Button -->
                                            <!-- Edit Branch Button -->
                                            <!-- Edit Branch Button -->
                                            <button type="button" class="btn btn-warning btn-sm"
                                                data-toggle="modal"
                                                data-target="#editBranchModal"
                                                data-branch-id="<?php echo htmlspecialchars($branch['BranchID']); ?>"
                                                data-branch-name="<?php echo htmlspecialchars($branch['BranchName']); ?>"
                                                data-branch-location="<?php echo htmlspecialchars($branch['Location']); ?>"

                                                onclick="fillEditBranchForm(this)">
                                                <i class="fas fa-edit"></i>
                                            </button>


                                            <!-- Delete Branch Button -->
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteBranch(<?php echo $branch['BranchID']; ?>)">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                            <!-- View Revenues Button -->
                                            <button type="button" class="btn btn-info btn-sm" onclick="viewRevenues(<?php echo $branch['BranchID']; ?>)">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6">No branches found.</td>
                            </tr>
                        <?php endif; ?>
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                <form id="addBranchForm">
                    <div class="form-group">
                        <label for="branchName">Branch Name</label>
                        <input type="text" class="form-control" id="branchName" name="branchName" required>
                    </div>
                    <div class="form-group">
                        <label for="branchLocation">Branch Location</label>
                        <input type="text" class="form-control" id="branchLocation" name="branchLocation" required>
                    </div>
                    <!-- Add more fields as needed -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="addBranchForm">Add Branch</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Branch Modal -->
<div class="modal fade" id="editBranchModal" tabindex="-1" role="dialog" aria-labelledby="editBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBranchModalLabel">Edit Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editBranchForm">
                    <input type="hidden" id="editBranchID" name="branchID">
                    <div class="form-group">
                        <label for="editBranchName">Branch Name</label>
                        <input type="text" class="form-control" id="editBranchName" name="branchName" required>
                    </div>
                    <div class="form-group">
                        <label for="editBranchLocation">Branch Location</label>
                        <input type="text" class="form-control" id="editBranchLocation" name="branchLocation" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveEditBranchBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>



<?php require_once("components/scripts.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDeleteBranch(branchID) {
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
                // Perform the deletion operation here, e.g., an AJAX request
                Swal.fire(
                    'Deleted!',
                    'The branch has been deleted.',
                    'success'
                );
            }
        });
    }

    function viewRevenues(branchID) {
        // AJAX request to fetch the revenue details
        $.ajax({
            url: 'actions/fetch_revenue_details.php', // Endpoint to fetch revenue details
            method: 'POST',
            data: {
                branchID: branchID
            },
            success: function(response) {
                // Assuming response is HTML or JSON formatted data
                Swal.fire({
                    title: 'Revenue Details',
                    html: response, // Display the revenue details
                    icon: 'info',
                    confirmButtonText: 'Close',
                    customClass: {
                        popup: 'wide-swal'
                    }
                });
            },
            error: function() {
                Swal.fire(
                    'Error!',
                    'Unable to fetch revenue details.',
                    'error'
                );
            }
        });
    }
    $('#addBranchForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting the default way

        $.ajax({
            url: 'actions/add_Branch.php',
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
            error: function() {
                Swal.fire(
                    'Error!',
                    'Unable to add branch.',
                    'error'
                );
            }
        });
    });

    function confirmDeleteBranch(branchID) {
        console.log(branchID);
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
                    url: 'actions/remove_branch.php',
                    method: 'POST',
                    data: {
                        branchID: branchID
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
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'Unable to delete branch.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    function fillEditBranchForm(button) {
        // Get data attributes from the button
        var branchID = $(button).data('branch-id');
        var branchName = $(button).data('branch-name');
        var branchLocation = $(button).data('branch-location');

        // Populate the fields in the Edit Branch Modal
        $('#editBranchID').val(branchID);
        $('#editBranchName').val(branchName);
        $('#editBranchLocation').val(branchLocation);

    }
    $(document).ready(function() {
        // Handle form submission
        $('#saveEditBranchBtn').click(function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Get the form data
            var formData = $('#editBranchForm').serialize();

            // AJAX request to submit the form
            $.ajax({
                url: 'actions/edit_branch.php', // Endpoint for editing branch
                method: 'POST',
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
</script>




</body>

</html>