<?php require_once('components/header.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php require_once('DAL/retrieve.class.php'); ?>

<?php
$dataRetrieve = new UniversityDataRetrieval();
$courseID = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
$professorID = 6; // Example Professor ID, you can set this dynamically
$gradeStructure = $dataRetrieve->getGradeStructureByCourseId($courseID);
?>

<div class="container mt-4">
    <h2 class="text-primary">Upload Grades for Course ID: <?php echo $courseID; ?></h2>

    <?php if (!empty($gradeStructure)): ?>
        <table class="table table-bordered">
            <thead class="thead-primary bg-primary text-white">
                <tr>
                    <th class="text-white">Assessment Type</th>
                    <th class="text-white">Weight</th>
                    <th class="text-white">Created At</th>
                    <th class="text-white">Updated At</th>
                    <th class="text-white">Export Grades</th>
                    <th class="text-white">Upload Grades (Excel)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gradeStructure as $structure): ?>
                    <tr>
                        <td><?php echo $structure['AssessmentType']; ?></td>
                        <td><?php echo $structure['Weight']; ?>%</td>
                        <td><?php echo $structure['CreatedAt']; ?></td>
                        <td><?php echo $structure['UpdatedAt']; ?></td>
                        <td><button id="exportGrades" class="btn btn-primary">Export</button></td>
                        <td>
                            <form id="uploadForm" action="upload_grades_process.php" method="post" enctype="multipart/form-data" class="mt-4">
                                <div class="form-group">
                                    <label for="gradesFile" class="text-primary">Upload Grades Excel File</label>
                                    <input type="file" class="form-control-file" id="gradesFile" name="gradesFile" accept=".xlsx, .xls">
                                </div>
                                <input type="hidden" name="courseID" value="<?php echo $courseID; ?>">
                                <input type="hidden" name="professorID" value="<?php echo $professorID; ?>">
                                <button type="submit" class="btn btn-primary">Upload Grades</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">No grade structure found for this course.</div>
    <?php endif; ?>


</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'actions/upload_grades_process.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Grades have been uploaded successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#007bff'
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an error uploading the grades. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#dc3545'
                    });
                }
            });
        });
    });
</script>
<?php require_once("components/footer.php") ?>
</body>

</html>