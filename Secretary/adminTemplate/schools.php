<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php require_once('DAL/retrieve.class.php');

$dataFetch = new UniversityDataRetrieval();
$schools = $dataFetch->getAllSchools();

?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Schools</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>School</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($schools as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['Schools']); ?></td>


                                <td><?php echo htmlspecialchars($row['Description']); ?></td>

                                <td>
                                    <button
                                        class="btn btn-primary btn-edit"
                                        data-id="<?php echo htmlspecialchars($row['schools_id']); ?>"
                                        data-school="<?php echo htmlspecialchars($row['Schools']); ?>"
                                        data-description="<?php echo htmlspecialchars($row['Description']); ?>">Edit</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
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
                        <label for="welcomeStatement">Faculity</label>
                        <input id="school" name="school" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="presidentMessage">Description</label>
                        <textarea id="description" name="description" class="form-control" required></textarea>
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
            $('#school').val(button.data('school'));
            $('#description').val(button.data('description'));
        });

        // Handle form submission
        $('#editForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'actions/edit_schools.php', // Update this to your actual PHP script for handling updates
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