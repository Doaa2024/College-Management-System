<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php require_once('DAL/retrieve.class.php');

$dataFetch = new UniversityDataRetrieval();
$freshman = $dataFetch->getAllFreshman();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Freshman</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>First Paragraph</th>
                            <th>Requirements List</th>
                            <th>Last Paragraph</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($freshman as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['FirstParagraph']); ?></td>
                                <td><?php echo htmlspecialchars($row['RequirementsList']); ?></td>
                                <td><?php echo htmlspecialchars($row['LastParagraph']); ?></td>
                                <td>

                                    <button
                                        class="btn btn-primary btn-edit"
                                        data-id="<?php echo htmlspecialchars($row['FreshManID']); ?>"
                                        data-first_paragraph="<?php echo htmlspecialchars($row['FirstParagraph']); ?>"
                                        data-requirements_list="<?php echo htmlspecialchars($row['RequirementsList']); ?>"
                                        data-last_paragraph="<?php echo htmlspecialchars($row['LastParagraph']); ?>">Edit</button>



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
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit About Information</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="record_id" name="record_id">
                    <div class="form-group">
                        <label for="welcomeStatement">First Paragraph</label>
                        <textarea id="first_paragraph" name="first_paragraph" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="presidentMessage">Requirements List</label>
                        <textarea id="requirements_list" name="requirements_list" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="history">Last Paragraph</label>
                        <textarea id="last_paragraph" name="last_paragraph" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once("components/scripts.php"); ?>
<script>
    $(document).ready(function() {
        // Open modal and populate fields with data
        $('.btn-edit').on('click', function() {
            const button = $(this);
            $('#editModal').modal('show');
            $('#record_id').val(button.data('id'));
            $('#first_paragraph').val(button.data('first_paragraph'));
            $('#requirements_list').val(button.data('requirements_list'));
            $('#last_paragraph').val(button.data('last_paragraph'));

        });

        // Handle form submission
        $('#editForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'actions/edit_freshman.php', // Update this to your actual PHP script for handling updates
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            showConfirmButton: true // Allow user to close the alert manually
                        }).then(function() {
                            location.reload(); // Reload the page to see the updated data
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message || 'Something went wrong! Please try again.',
                            showConfirmButton: true // Allow user to close the alert manually
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again.',
                        showConfirmButton: true // Allow user to close the alert manually
                    });
                }
            });
        });
    });
</script>
</body>

</html>