<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php require_once('DAL/retrieve.class.php'); ?>
<?php $dataRetrieval = new UniversityDataRetrieval(); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Financial Aids</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Aid Amount</th>
                            <th>Date</th>
                            <th>Updated At</th>
                            <th>Faculty Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Get financial aids data
                        $Financial_Aids = $dataRetrieval->getFinancialAids();

                        // Loop through the financial aids array and populate the table
                        foreach ($Financial_Aids as $FA) {
                        ?>
                            <tr>
                                <td><?php echo $FA['student_id']; ?></td>
                                <td><?php echo number_format($FA['aid_amount'], 2); ?></td>
                                <td><?php echo $FA['created_at']; ?></td>
                                <td><?php echo $FA['updated_at']; ?></td>
                                <td><?php echo $FA['FacultyName']; ?></td>
                                <td>
                                    <div style="display:flex; gap:10px">
                                        <button class="btn btn-primary edit-btn"
                                            data-id="<?php echo htmlspecialchars($FA['id']); ?>"
                                            data-amount="<?php echo htmlspecialchars($FA['aid_amount']); ?>">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger delete-btn"
                                            data-id="<?php echo htmlspecialchars($FA['id']); ?>">
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
<script>
    $(document).ready(function() {
        // Click event for the edit button
        $(document).ready(function() {
            // Click event for the edit button
            $('#dataTable').on('click', '.edit-btn', function() {
                var row = $(this).closest('tr');
                var id = $(this).data('id');
               
                var amount = $(this).data('amount');
              
                Swal.fire({
                    title: 'Update Aid Amount',
                    input: 'number',
                    inputValue: amount,
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Cancel',
                    inputValidator: (value) => {
                        if (!value || isNaN(value)) {
                            return 'You need to enter a valid number!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'actions/update_status_FA.php', // Updated URL for clarity
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                id: id,
                                aid_amount: result.value // Updated key for better understanding
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire('Updated!', 'The Aid Amount has been updated.', 'success');
                                    // Optionally, update the aid amount on the page
                                    row.find('td').eq(1).text(result.value); // Make sure this index is correct
                                    window.location.reload();

                                } else {
                                    Swal.fire('Error!', response.message, 'error');
                                }
                            },
                            error: function() {
                                Swal.fire('Error!', 'An error occurred while updating the Aid Amount.', 'error');
                            }
                        });
                    }
                });
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
                        url: 'actions/delete_FA.php',
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

    });
</script>
</body>

</html>