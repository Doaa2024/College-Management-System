<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php require_once('DAL/retrieve.class.php');

$dataFetch = new UniversityDataRetrieval();
$moreInfo = $dataFetch->getAllMoreInfo();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 text-center">More Information</h1>

    <!-- Card Example -->
    <div class="row justify-content-center">
        <?php foreach ($moreInfo as $row): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-primary shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0"><?php echo htmlspecialchars($row['Name']); ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><strong>Welcome Statement:</strong> <?php echo htmlspecialchars($row['welcomeStatement']); ?></p>
                        <p class="card-text"><strong>Phone Number:</strong> <?php echo htmlspecialchars($row['PhoneNumber']); ?></p>
                        <p class="card-text"><strong>Instagram:</strong> <?php echo htmlspecialchars($row['Instagram']); ?></p>
                        <p class="card-text"><strong>Facebook:</strong> <?php echo htmlspecialchars($row['Facebook']); ?></p>
                        <p class="card-text"><strong>Twitter:</strong> <?php echo htmlspecialchars($row['Twitter']); ?></p>
                        <p class="card-text"><strong>LinkedIn:</strong> <?php echo htmlspecialchars($row['Linkedin']); ?></p>
                        <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($row['Email']); ?></p>
                        <p class="card-text"><strong>Location:</strong> <?php echo htmlspecialchars($row['Location']); ?></p>
                    </div>
                    <div class="card-footer text-right">
                        <button
                            class="btn btn-primary btn-edit"
                            data-name="<?php echo htmlspecialchars($row['Name']); ?>"
                            data-welcomestatement="<?php echo htmlspecialchars($row['welcomeStatement']); ?>"
                            data-phonenumber="<?php echo htmlspecialchars($row['PhoneNumber']); ?>"
                            data-instagram="<?php echo htmlspecialchars($row['Instagram']); ?>"
                            data-facebook="<?php echo htmlspecialchars($row['Facebook']); ?>"
                            data-twitter="<?php echo htmlspecialchars($row['Twitter']); ?>"
                            data-linkedin="<?php echo htmlspecialchars($row['Linkedin']); ?>"
                            data-email="<?php echo htmlspecialchars($row['Email']); ?>"
                            data-location="<?php echo htmlspecialchars($row['Location']); ?>">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit More Information</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="record_name" name="name">
                    <div class="form-group">
                        <label for="welcomeStatement">Welcome Statement</label>
                        <textarea id="welcomeStatement" name="welcomeStatement" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone Number</label>
                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="text" id="instagram" name="instagram" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" id="facebook" name="facebook" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" id="twitter" name="twitter" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="linkedin">LinkedIn</label>
                        <input type="text" id="linkedin" name="linkedin" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once("components/footer.php"); ?>
<?php require_once("components/scripts.php"); ?>

<script>
    $(document).ready(function() {
        // Open modal and populate fields with data
        $('.btn-edit').on('click', function() {
            const button = $(this);
            $('#editModal').modal('show');
            $('#record_name').val(button.data('name'));
            $('#welcomeStatement').val(button.data('welcomestatement'));
            $('#phoneNumber').val(button.data('phonenumber'));
            $('#instagram').val(button.data('instagram'));
            $('#facebook').val(button.data('facebook'));
            $('#twitter').val(button.data('twitter'));
            $('#linkedin').val(button.data('linkedin'));
            $('#email').val(button.data('email'));
            $('#location').val(button.data('location'));
        });

        // Handle form submission
        $('#editForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'actions/edit_more_info.php', // Update this to your actual PHP script for handling updates
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            showConfirmButton: true
                        }).then(function() {
                            location.reload(); // Reload the page to see the updated data
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
    });
</script>
</body>

</html>