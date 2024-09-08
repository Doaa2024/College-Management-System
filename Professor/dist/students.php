<?php require_once('components/header.php') ?>
<?php require_once('components/navbar.php') ?>
<?php require_once('DAL/retrieve.class.php') ?>

<?php
$dataRetrieve = new UniversityDataRetrieval();
$courseID = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
$studentsInCourse = $dataRetrieve->getStudentsInCourse($courseID);
?>

<div class="container mt-5" style="min-height:70dvh">
    <h2 class="mb-4">Students in Course</h2>

    <!-- Button to send email to all students -->
    <button id="sendEmailAll" class="btn btn-primary mb-3">Send Email to All Students</button>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>User ID</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($studentsInCourse): ?>
                <?php foreach ($studentsInCourse as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['UserID']); ?></td>
                        <td><?php echo htmlspecialchars($student['Email']); ?></td>
                        <td>
                            <!-- Button to send email to individual student -->
                            <a href="mailto:<?php echo htmlspecialchars($student['Email']); ?>" class="btn btn-primary">Send Email</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No students found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#sendEmailAll').on('click', function() {
            var emails = [];
            $('tbody tr').each(function() {
                var email = $(this).find('td:nth-child(2)').text();
                emails.push(email);
            });

            if (emails.length > 0) {
                var mailtoLink = 'https://mail.google.com/mail/?view=cm&fs=1&to=' + emails.join(',');
                window.open(mailtoLink, '_blank');
            } else {
                Swal.fire('No students', 'No emails found to send.', 'info');
            }
        });
    });
</script>

</body>

</html>