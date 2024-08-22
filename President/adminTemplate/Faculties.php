<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php
require_once('DAL/retrieve.class.php');

$universityData = new UniversityDataRetrieval();
$faculties = $universityData->getAllFaculties();
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Faculties</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Faculties List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Faculty ID</th>
                            <th>Faculty Name</th>
                            <th>Credit Fee</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                            <!-- Add more fields as necessary -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if ($faculties) {
                            foreach ($faculties as $faculty) {
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($faculty['FacultyID']); ?></td>
                                    <td><?php echo htmlspecialchars($faculty['FaculityName']); ?></td>
                                    <td><?php echo htmlspecialchars($faculty['CreditFee']); ?></td>
                                    <td><?php echo htmlspecialchars($faculty['CreatedAt']); ?></td>
                                    <td><?php echo htmlspecialchars($faculty['UpdatedAt']); ?></td>
                                    <td>
                                        <a href="faculty.php?facultyID=<?php echo htmlspecialchars($faculty['FacultyID']) ?>" class="btn btn-primary">
                                            Show Faculty
                                        </a>

                                    </td>
                                </tr>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="4">No faculties found</td>
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
<!-- Modal -->


<script>

</script>

<?php require_once("components/scripts.php"); ?>
</body>

</html>