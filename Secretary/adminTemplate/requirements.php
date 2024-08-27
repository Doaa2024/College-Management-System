<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php require_once('DAL/retrieve.class.php');

$dataFetch = new UniversityDataRetrieval();
$requirements = $dataFetch->getAllRequirements();
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
                        <label for="type">Admission Requirements</label>
                        <textarea type="text" class="form-control" id="admission" name="admission"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="title1">Required Documents</label>
                        <textarea type="text" class="form-control" id="documents" name="documents"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="title2">Courses</label>
                        <textarea type="text" class="form-control" id="courses" name="courses"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Curriculum</label>
                        <textarea class="form-control" id="curriculum" name="curriculum"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="details">Credit Hours</label>
                        <textarea class="form-control" id="credit_hours" name="credit_hours"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="details">Major Electives</label>
                        <textarea class="form-control" id="major_electives" name="major_electives"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="details">Major Courses</label>
                        <textarea class="form-control" id="major_courses" name="major_courses"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="details">Core Courses</label>
                        <textarea class="form-control" id="core_courses" name="core_courses"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="details">General Education</label>
                        <textarea class="form-control" id="general_education" name="general_education"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="details">Conclusion</label>
                        <textarea class="form-control" id="conclusion" name="conclusion"></textarea>
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
    <h1 class="h3 mb-2 text-gray-800">Requirements</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Addmission Requirements</th>
                            <th>Required Documents</th>
                            <th>Courses</th>
                            <th>Curriculum</th>
                            <th>Credits Hours</th>
                            <th>Major Courses</th>
                            <th>Major Electives</th>
                            <th>Core Courses</th>
                            <th>General Education</th>
                            <th>Conclusion</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requirements as $row): ?>
                            <tr>
                                <td><?= nl2br(htmlspecialchars($row['admission_requirements'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></td>
                                <td><?= nl2br(htmlspecialchars($row['required_documents'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></td>
                                <td><?php echo htmlspecialchars($row['courses']); ?></td>
                                <td><?php echo htmlspecialchars($row['curriculum']); ?></td>
                                <td><?php echo htmlspecialchars($row['credit_hours']); ?></td>
                                <td><?php echo htmlspecialchars($row['major_courses']); ?></td>
                                <td><?php echo htmlspecialchars($row['major_electives']); ?></td>
                                <td><?php echo htmlspecialchars($row['core_courses']); ?></td>
                                <td><?php echo htmlspecialchars($row['general_education']); ?></td>
                                <td><?php echo htmlspecialchars($row['conclusion']); ?></td>

                                <td>
                                    <button class="btn btn-primary btn-edit"
                                        data-id="<?php echo htmlspecialchars($row['id']); ?>"
                                        data-admission="<?php echo htmlspecialchars($row['admission_requirements']); ?>"
                                        data-documents="<?php echo htmlspecialchars($row['required_documents']); ?>"
                                        data-courses="<?php echo htmlspecialchars($row['courses']); ?>"
                                        data-curriculum="<?php echo htmlspecialchars($row['curriculum']); ?>"
                                        data-credit_hours="<?php echo htmlspecialchars($row['credit_hours']); ?>"
                                        data-major_courses="<?php echo htmlspecialchars($row['major_courses']); ?>"
                                        data-major_electives="<?php echo htmlspecialchars($row['major_electives']); ?>"
                                        data-core_courses="<?php echo htmlspecialchars($row['core_courses']); ?>"
                                        data-general_education="<?php echo htmlspecialchars($row['general_education']); ?>"
                                        data-conclusion="<?php echo htmlspecialchars($row['conclusion']); ?>">
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
            $('#admission').val(button.data('admission'));
            $('#documents').val(button.data('documents'));
            $('#courses').val(button.data('courses'));
            $('#curriculum').val(button.data('curriculum'));
            $('#credit_hours').val(button.data('credit_hours'));
            $('#major_courses').val(button.data('major_courses'));
            $('#major_electives').val(button.data('major_electives'));
            $('#core_courses').val(button.data('core_courses'));
            $('#general_education').val(button.data('general_education'));
            $('#conclusion').val(button.data('conclusion'));
        });

        // Handle form submission
        $('#editForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'actions/edit_requirements.php',
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