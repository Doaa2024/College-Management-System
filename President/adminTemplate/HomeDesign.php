<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php require_once('DAL/retrieve.class.php');

$dataFetch = new UniversityDataRetrieval();
$homeInfo = $dataFetch->getAllHomeInfo();
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
                        <label for="type">Type</label>
                        <input type="text" class="form-control" id="type" name="type">
                    </div>
                    <div class="form-group">
                        <label for="title1">Title1</label>
                        <input type="text" class="form-control" id="title1" name="title1">
                    </div>
                    <div class="form-group">
                        <label for="title2">Title2</label>
                        <input type="text" class="form-control" id="title2" name="title2">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea class="form-control" id="details" name="details"></textarea>
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
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Title1</th>
                            <th>Title2</th>
                            <th>Description</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($homeInfo as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['Type']); ?></td>
                                <td><?php echo htmlspecialchars($row['Title1']); ?></td>
                                <td><?php echo htmlspecialchars($row['Title2']); ?></td>
                                <td><?php echo htmlspecialchars($row['Description']); ?></td>
                                <td><?php echo htmlspecialchars($row['Details']); ?></td>
                                <td>
                                    <button class="btn btn-primary btn-edit"
                                        data-id="<?php echo htmlspecialchars($row['temp_id']); ?>"
                                        data-type="<?php echo htmlspecialchars($row['Type']); ?>"
                                        data-title1="<?php echo htmlspecialchars($row['Title1']); ?>"
                                        data-title2="<?php echo htmlspecialchars($row['Title2']); ?>"
                                        data-description="<?php echo htmlspecialchars($row['Description']); ?>"
                                        data-details="<?php echo htmlspecialchars($row['Details']); ?>">
                                        Edit
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
                // Open modal and populate fields with data
                $('.btn-edit').on('click', function() {
                    const button = $(this);
                    $('#editModal').modal('show');
                    $('#record_id').val(button.data('id'));
                    $('#type').val(button.data('type'));
                    $('#title1').val(button.data('title1'));
                    $('#title2').val(button.data('title2'));
                    $('#description').val(button.data('description'));
                    $('#details').val(button.data('details'));
                });

                // Handle form submission
                $('#editForm').on('submit', function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: 'actions/edit_home.php',
                        type: 'POST',
                        data: $(this).serialize(),
                        dataType: 'json', // Ensure the response is treated as JSON
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message || 'Record updated successfully.',
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