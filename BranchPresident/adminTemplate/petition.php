<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php require_once('DAL/retrieve.class.php'); ?>
<?php $dataRetrieval = new UniversityDataRetrieval(); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Petitions</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Faculty ID-Name</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Get petitions data
                        $petitions = $dataRetrieval->getPetitions();

                        // Loop through the petitions array and populate the table
                        foreach ($petitions as $petition) {
                        ?>
                            <tr>
                                <td><?php echo $petition['student_id']; ?></td>
                                <td><?php echo $petition['faculty_id']; ?>-<?php echo $petition['FacultyName']; ?></td>
                                <td><?php echo $petition['petition_date']; ?></td>
                                <td><?php echo $petition['status']; ?></td>
                                <td><?php echo $petition['description']; ?></td>
                               
                                <td>
                                        <div style="display:flex; gap:10px">
                                            <button class="btn btn-primary edit-btn"
                                                data-id="<?php echo htmlspecialchars($petition['id']); ?>"
                                                data-status="<?php echo htmlspecialchars($petition['status']); ?>">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger delete-btn"
                                                data-id="<?php echo htmlspecialchars($petition['id']); ?>">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </diV>
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
<script> $(document).ready(function() {
        // Click event for the edit button
        $('#dataTable').on('click', '.edit-btn', function() {
            var row = $(this).closest('tr');
            var id = $(this).data('id');
            var status = $(this).data('status');

            Swal.fire({
                title: 'Update Status',
                input: 'select',
                inputOptions: {
                    'Pending': 'Pending',
                    'Approved': 'Approved',
                    'Rejected': 'Rejected'
                },
                inputValue: status,
                showCancelButton: true,
                confirmButtonText: 'Update',
                cancelButtonText: 'Cancel',
                inputValidator: (value) => {
                    if (!value) {
                        return 'You need to select a status!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'actions/update_status_pet.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id,
                            newStatus: result.value
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Updated!', 'The status has been updated.', 'success');
                                // Optionally, update the status on the page
                                row.find('td').eq(3).text(result.value); // Update status cell
                                window.location.reload();

                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'An error occurred while updating the status.', 'error');
                        }
                    });
                }
            });
        });
        $('#dataTable').on('click', '.delete-btn', function() {
            var row = $(this).closest('tr');
            var id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'actions/delete_pet.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Deleted!', 'The record has been deleted.', 'success');
                                row.remove(); // Remove the row from the table
                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'An error occurred while deleting the record.', 'error');
                        }
                    });
                }
            });
        });

    });</script>
</body>

</html>