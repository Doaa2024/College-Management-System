<?php require_once('components/header.php'); ?>


<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php
// Require the class file
require('DAL/retrieve.class.php');

// Instantiate the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();

// Retrieve all branches
$jobs = $universityData->getAllJobOffers();
$faculty = $universityData->getAllFaculties();
$branches = $universityData->getAllBranchesLocation()


?>
<!-- Begin Page Content -->
<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Job Offers</h3>
            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addBranchModal">
                <i class="fas fa-plus"></i> Add Job Offer
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Faculty</th>
                            <th>Description</th>
                            <th>Required Qualifications</th>
                            <th>Application Deadline</th>
                            <th>Job Location</th>
                            <th>Job Type</th>
                            <th>Salary Range</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($jobs)) : ?>
                            <?php foreach ($jobs as $job) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($job['job_title']); ?></td>
                                    <?php $getfaculty = $universityData->getFaculity($job['faculty_id']); ?>
                                    <td><?php echo htmlspecialchars($getfaculty[0]['FaculityName']) ?></td>
                                    <td><?php echo htmlspecialchars($job['job_description']); ?></td>
                                    <td><?php echo htmlspecialchars($job['required_qualifications']); ?></td>
                                    <td><?php echo htmlspecialchars($job['application_deadline']); ?></td>
                                    <td><?php echo htmlspecialchars($job['job_location']); ?></td>
                                    <td><?php echo htmlspecialchars($job['job_type']); ?></td>
                                    <td><?php echo htmlspecialchars($job['salary_range']); ?></td>
                                    <td><?php echo htmlspecialchars($job['status']); ?></td>
                                    <td><?php echo htmlspecialchars($job['created_at']); ?></td>
                                    <td><?php echo htmlspecialchars($job['updated_at']); ?></td>
                                    <td>
                                        <div style="display:flex; gap:10px">

                                            <!-- Edit job Button -->
                                            <!-- Edit Branch Button -->
                                            <!-- Edit Branch Button -->
                                            <button type="button" class="btn btn-warning btn-sm"
                                                data-toggle="modal"
                                                data-target="#editBranchModal"
                                                data-job-id="<?php echo htmlspecialchars($job['job_id']); ?>"
                                                data-job-title="<?php echo htmlspecialchars($job['job_title']); ?>"
                                                data-faculty-id="<?php echo htmlspecialchars($job['faculty_id']); ?>"
                                                data-job-description="<?php echo htmlspecialchars($job['job_description']); ?>"
                                                data-required-qualifications="<?php echo htmlspecialchars($job['required_qualifications']); ?>"
                                                data-application-deadline="<?php echo htmlspecialchars($job['application_deadline']); ?>"
                                                data-job-location="<?php echo htmlspecialchars($job['job_location']); ?>"
                                                data-job-type="<?php echo htmlspecialchars($job['job_type']); ?>"
                                                data-salary-range="<?php echo htmlspecialchars($job['salary_range']); ?>"
                                                data-job-status="<?php echo htmlspecialchars($job['status']); ?>"
                                                <?php echo htmlspecialchars($job['job_title']); ?>
                                                onclick="fillEditBranchForm(this)">
                                                <i class="fas fa-edit"></i>
                                            </button>


                                            <!-- Delete Branch Button -->
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteBranch(<?php echo $job['job_id']; ?>)">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                    </td>

            </div>
            </td>

            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="6">No branches found.</td>
        </tr>
    <?php endif; ?>
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
<!-- Add Branch Modal -->
<div class="modal fade" id="addBranchModal" tabindex="-1" role="dialog" aria-labelledby="addBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBranchModalLabel">Add New Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addJobForm">
                    <div class="form-group">
                        <label for="jobTitle">Job Title</label>
                        <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
                    </div>
                    <div class="form-group">
                        <label for="facultyId">Faculty ID</label>
                        <select class="form-control" id="facultyId" name="facultyId" required>
                            <?php foreach ($faculty as $item): ?>
                                <option value="<?php echo htmlspecialchars($item['FacultyID']); ?>">
                                    <?php echo htmlspecialchars($item['FaculityName']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jobDescription">Job Description</label>
                        <textarea class="form-control" id="jobDescription" name="jobDescription" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="requiredQualifications">Required Qualifications</label>
                        <textarea class="form-control" id="requiredQualifications" name="requiredQualifications" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="applicationDeadline">Application Deadline</label>
                        <input type="date" class="form-control" id="applicationDeadline" name="applicationDeadline" required>
                    </div>
                    <div class="form-group">
                        <label for="jobLocation">Job Location</label>
                        <select class="form-control" id="jobLocation" name="jobLocation" required>
                            <option value="" disabled selected>Select Job Location</option>
                            <?php foreach ($branches as $branch): ?>
                                <option value="<?php echo $branch['BranchName'] . ', ' . $branch['Location']; ?>">
                                    <?php echo $branch['BranchName'] . ' - ' . $branch['Location']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="jobType">Job Type</label>
                        <select class="form-control" id="jobType" name="jobType" required>
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Contract">Contract</option>
                            <option value="Temporary">Temporary</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="salaryRange">Salary Range</label>
                        <input type="text" class="form-control" id="salaryRange" name="salaryRange" required>
                    </div>
                    <div class="form-group">
                        <label for="jobStatus">Job Status</label>
                        <select class="form-control" id="jobStatus" name="jobStatus" required>
                            <option value="Pending">Pending</option>
                            <option value="Occupied">Occupied</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="addJobForm">Add Job</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Branch Modal -->
<div class="modal fade" id="editBranchModal" tabindex="-1" role="dialog" aria-labelledby="editBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBranchModalLabel">Edit Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editJobForm">
                    <input type="hidden" id="editJobID" name="jobID">
                    <div class="form-group">
                        <label for="editJobTitle">Job Title</label>
                        <input type="text" class="form-control" id="editJobTitle" name="jobTitle" required>
                    </div>
                    <div class="form-group">
                        <label for="editFacultyID">Faculty ID</label>
                        <select class="form-control" id="editFacultyID" name="facultyId" required>
                            <?php foreach ($faculty as $item): ?>
                                <option value="<?php echo htmlspecialchars($item['FacultyID']); ?>">
                                    <?php echo htmlspecialchars($item['FaculityName']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="editJobDescription">Job Description</label>
                        <textarea class="form-control" id="editJobDescription" name="jobDescription" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editRequiredQualifications">Required Qualifications</label>
                        <textarea class="form-control" id="editRequiredQualifications" name="requiredQualifications" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editApplicationDeadline">Application Deadline</label>
                        <input type="date" class="form-control" id="editApplicationDeadline" name="applicationDeadline" required>
                    </div>
                    <div class="form-group">
                        <label for="editJobLocation">Job Location</label>

                        <select class="form-control" id="editJobLocation" name="jobLocation" required>
                            <?php foreach ($branches as $branch): ?>
                                <option value="<?php echo $branch['BranchName'] . ', ' . $branch['Location']; ?>">
                                    <?php echo $branch['BranchName'] . ' - ' . $branch['Location']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editJobType">Job Type</label>
                        <select class="form-control" id="editJobType" name="jobType" required>
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Contract">Contract</option>
                            <option value="Temporary">Temporary</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editSalaryRange">Salary Range</label>
                        <input type="text" class="form-control" id="editSalaryRange" name="salaryRange" required>
                    </div>
                    <div class="form-group">
                        <label for="editJobStatus">Job Status</label>
                        <select class="form-control" id="editJobStatus" name="jobStatus" required>
                            <option value="Pending">Pending</option>
                            <option value="Occupied">Occupied</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveEditBranchBtn">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>



<?php require_once("components/scripts.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#addJobForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting the default way
        console.log("submitted");
        $.ajax({
            url: 'actions/add_job.php',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire(
                        'Added!',
                        response.message,
                        'success'
                    ).then(() => {
                        location.reload(); // Reload the page to update the table
                    });
                } else {
                    Swal.fire(
                        'Error!',
                        response.message,
                        'error'
                    );
                }
            },
            error: function() {
                Swal.fire(
                    'Error!',
                    'Unable to add branch.',
                    'error'
                );
            }
        });
    });

    function confirmDeleteBranch(jobID) {
        console.log(jobID);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'actions/remove_job.php',
                    method: 'POST',
                    data: {
                        jobID: jobID
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            ).then(() => {
                                location.reload(); // Reload the page to update the table
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'Unable to delete branch.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    function fillEditBranchForm(button) {
        // Get data attributes from the button
        var jobID = $(button).data('job-id');
        var jobTitle = $(button).data('job-title');
        var facultyId = $(button).data('faculty-id');
        var jobDescription = $(button).data('job-description');
        var requiredQualifications = $(button).data('required-qualifications');
        var applicationDeadline = $(button).data('application-deadline');
        var jobLocation = $(button).data('job-location');
        var jobType = $(button).data('job-type');
        var salaryRange = $(button).data('salary-range');
        var jobStatus = $(button).data('job-status');


        // Populate the fields in the Edit Job Modal
        $('#editJobID').val(jobID);
        $('#editJobTitle').val(jobTitle);
        $('#editFacultyID').val(facultyId);
        $('#editJobDescription').val(jobDescription);
        $('#editRequiredQualifications').val(requiredQualifications);
        $('#editApplicationDeadline').val(applicationDeadline);
        $('#editJobLocation').val(jobLocation);
        $('#editJobType').val(jobType);
        $('#editSalaryRange').val(salaryRange);
        $('#editJobStatus').val(jobStatus);



    }
    $(document).ready(function() {
        // Handle form submission
        $('#saveEditBranchBtn').click(function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Get the form data
            var formData = $('#editJobForm').serialize();

            // AJAX request to submit the form
            $.ajax({
                url: 'actions/edit_job.php', // Endpoint for editing branch
                method: 'POST',
                processData: false, // Prevent jQuery from processing the data
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // Reload the page to reflect changes
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An unexpected error occurred.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>




</body>

</html>