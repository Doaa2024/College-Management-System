<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php
require_once('DAL/retrieve.class.php');


function getFacultyID()
{
    return isset($_GET['facultyID']) ? intval($_GET['facultyID']) : 0;
}

function formatFacultyInfo($facultyInfo)
{
    $formattedInfo = [];

    if (!empty($facultyInfo)) {
        $formattedInfo['FacultyName'] = htmlspecialchars($facultyInfo[0]['FaculityName']);
        $formattedInfo['CreditFee'] = htmlspecialchars($facultyInfo[0]['CreditFee']);
        $formattedInfo['FacultyHead'] = htmlspecialchars($facultyInfo[0]['FacultyHeadName']);
        $formattedInfo['StudentCount'] = htmlspecialchars($facultyInfo[0]['StudentCount']);
        $formattedInfo['ProfessorCount'] = htmlspecialchars($facultyInfo[0]['ProfessorCount']);

        $formattedInfo['Branches'] = [];
        $formattedInfo['Departments'] = [];

        foreach ($facultyInfo as $row) {
            addBranch($formattedInfo, $row);
            addDepartment($formattedInfo, $row);
            addCourse($formattedInfo, $row);
        }
    }

    return $formattedInfo;
}

function addBranch(&$formattedInfo, $row)
{
    if (!isset($formattedInfo['Branches'][$row['BranchID']])) {
        $formattedInfo['Branches'][$row['BranchID']] = [
            'BranchName' => htmlspecialchars($row['BranchName']),
            'Location' => htmlspecialchars($row['BranchLocation'])
        ];
    }
}

function addDepartment(&$formattedInfo, $row)
{
    if (!isset($formattedInfo['Departments'][$row['DepartmentID']])) {
        $formattedInfo['Departments'][$row['DepartmentID']] = [
            'DepartmentName' => htmlspecialchars($row['DepartmentName']),
            'DepartmentHead' => htmlspecialchars($row['DepartmentHeadName']),
            'Courses' => []
        ];
    }
}

function addCourse(&$formattedInfo, $row)
{
    if ($row['CourseID']) {
        $formattedInfo['Departments'][$row['DepartmentID']]['Courses'][] = [
            'CourseID' => htmlspecialchars($row['CourseID']),
            'CourseName' => htmlspecialchars($row['CourseName']),
            'CourseCode' => htmlspecialchars($row['CourseCode']),
            'Credits' => htmlspecialchars($row['Credits'])
        ];
    }
}

$facultyID = getFacultyID();

$facultyRetrieval = new UniversityDataRetrieval();
$facultyInfo = $facultyRetrieval->getFacultyCompleteInfo($facultyID);

$formattedInfo = formatFacultyInfo($facultyInfo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        }

        .container {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .nav-tabs .nav-link {
            color: #495057;
        }

        .nav-tabs .nav-link.active {
            background: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .tab-content {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 0 0 .25rem .25rem;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

        .table {
            background: #f9f9f9;
            border-radius: 4px;
        }

        thead {
            background: #007bff;
            color: #fff;
        }

        tbody tr:nth-child(odd) {
            background: #f2f2f2;
        }

        tbody tr:hover {
            background: #e2e6ea;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="display:flex">
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Faculty Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="branches-tab" data-toggle="tab" href="#branches" role="tab" aria-controls="branches" aria-selected="false">Branches</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="departments-tab" data-toggle="tab" href="#departments" role="tab" aria-controls="departments" aria-selected="false">Departments and Courses</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content mt-3">
            <!-- Faculty Info -->
            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                <div class="list-group">
                    <div class="list-group-item border-left-primary " style="   background: linear-gradient(135deg, #007bff, #0056b3); ">
                        <h5 class="mb-1"><?php echo $formattedInfo['FacultyName']; ?></h5>

                    </div>
                    <div class="list-group-item border-left-primary">
                        <strong>Credit Fee:</strong> $<?php echo $formattedInfo['CreditFee']; ?>
                    </div>
                    <div class="list-group-item border-left-primary">
                        <strong>Faculty Head:</strong> <?php echo $formattedInfo['FacultyHead']; ?>
                    </div>
                    <div class="list-group-item border-left-primary">
                        <strong>Total Students:</strong> <?php echo $formattedInfo['StudentCount']; ?>
                    </div>
                    <div class="list-group-item border-left-primary">
                        <strong>Total Professors:</strong> <?php echo $formattedInfo['ProfessorCount']; ?>
                    </div>
                </div>
                <?php $id = $_GET['facultyID'] ? $_GET['facultyID']  : 0; ?>
                <div class="d-flex justify-content-end gap-2 mt-3" style="gap:10px">
                    <button class="btn btn-primary" onclick="editCreditFee(<?php echo $id ?>, <?php echo $formattedInfo['CreditFee'] ?>)">
                        <i class="fas fa-edit mr-1"></i> Edit Credit Fee
                    </button>


                    <button class="btn btn-warning" onclick="editFacultyHead(<?php echo intval($_GET['facultyID']); ?>)">
                        <i class="fas fa-edit mr-1"></i> Edit Faculty Head
                    </button>


                </div>
            </div>


            <!-- Branches -->
            <div class="tab-pane fade" id="branches" role="tabpanel" aria-labelledby="branches-tab">
                <h4>Branches</h4>
                <?php
                $retrieveInfo = new UniversityDataRetrieval();
                $facInfo = $retrieveInfo->getFacultyInfo($id);

                ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Branch Name</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($formattedInfo['Branches'] as $branch): ?>
                            <tr>
                                <td><?php echo $branch['BranchName']; ?></td>
                                <td><?php echo $branch['Location']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end gap-2" style="gap:10px">

                    <button class="btn btn-primary"
                        data-facid="<?= $_GET['facultyID'] ?>"
                        data-branch_id="<?php echo htmlspecialchars($id); ?>"
                        data-facname="<?= ($facInfo[0]['FaculityName']); ?>"
                        data-creditfee="<?= ($facInfo[0]['CreditFee']) ?>"
                        data-toggle="modal"
                        data-target="#branchesModal">
                        <i class="fas fa-edit mr-1"></i> Manage Branches
                    </button>
                </div>
            </div>
            <!-- Departments and Courses -->
            <?php
            $facInfo = $retrieveInfo->getCoursesGroupedByDepartmentAndFaculty($id);

            // Process the data to group courses by department
            $departments = [];
            foreach ($facInfo as $course) {
                $departmentID = $course['DepartmentID'];
                if (!isset($departments[$departmentID])) {
                    $departments[$departmentID] = [
                        'DepartmentID' => $departmentID, // Include the department ID
                        'DepartmentName' => $course['DepartmentName'],
                        'DepartmentHead' => $course['Username'],
                        'Courses' => []
                    ];
                   
                }
                $departments[$departmentID]['Courses'][] = [
                    'CourseName' => $course['CourseName'],
                    'CourseCode' => $course['CourseCode'],
                    'Credits' => $course['Credits']
                ];
            }
            ?>


            <div class="tab-pane fade" id="departments" role="tabpanel" aria-labelledby="departments-tab">
                <h4 class="mb-3">Departments and Courses</h4>

                <?php foreach ($departments as $department): ?>
                    <div class="mb-4 p-3 border-left-primary">
                        <h5>Department Name: <?php echo htmlspecialchars($department['DepartmentName']); ?></h5>
                        <h6>Department Head: <?php echo htmlspecialchars($department['DepartmentHead']); ?></h6>
                        <h6>Courses:</h6>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Course Code</th>
                                    <th>Credits</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($department['Courses'] as $course): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($course['CourseName']); ?></td>
                                        <td><?php echo htmlspecialchars($course['CourseCode']); ?></td>
                                        <td><?php echo htmlspecialchars($course['Credits']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end gap-2" style="gap:10px">

                        <button class="btn btn-primary" onclick="editDepartmentHead(<?php echo intval($department['DepartmentID']); ?>)">
                            <i class="fas fa-user mr-1"></i> Edit Department Head
                        </button>
                        <button class="btn btn-primary" onclick="editDepartmentName(<?php echo intval($department['DepartmentID']); ?>)">
                            <i class="fas fa-edit mr-1"></i> Edit Department Name
                        </button>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="branchesModal" tabindex="-1" role="dialog" aria-labelledby="branchesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="branchesModalLabel">Branch Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="branchesForm" action="submitBranches.php" method="POST">
                    <div class="modal-body">
                        <div id="branchesTableContainer">
                            <!-- Branches table will be loaded here via AJAX -->
                        </div>
                        <input type="hidden" id="initialBranches" value='[]'>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit Selected Branches</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php require_once("components/scripts.php"); ?>

    <script>
        function editCreditFee(facultyID, currentCreditFee) {
            Swal.fire({
                title: 'Edit Credit Fee',
                input: 'text',
                inputLabel: 'Current Credit Fee',
                inputValue: currentCreditFee, // Populate with the current credit fee
                showCancelButton: true,
                confirmButtonText: 'Update',
                showLoaderOnConfirm: true,
                preConfirm: (newCreditFee) => {
                    return new Promise((resolve, reject) => {
                        // Use AJAX to send the updated fee to the backend
                        $.ajax({
                            url: 'actions/updateCreditFee.php',
                            type: 'POST',
                            data: {
                                facultyID: facultyID,
                                newCreditFee: newCreditFee
                            },
                            success: function(response) {
                                if (response.success) {
                                    resolve(); // Resolve on success
                                } else {
                                    reject(response.message); // Reject if error
                                }
                            },
                            error: function() {
                                reject('An error occurred during the update.');
                            }
                        });
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Updated!', 'The credit fee has been updated.', 'success').then(() => {
                        location.reload(); // Reload page to show the updated fee
                    });
                }
            });
        }

        function editFacultyHead(facultyID) {
            $.ajax({
                url: 'actions/get_current_employers.php',
                type: 'GET',
                dataType: 'json',
                success: function(employers) {
                    let employerOptions = employers.map(emp =>
                        `<option value="${emp.UserID}">${emp.Username} (${emp.Email})</option>`
                    ).join('');

                    Swal.fire({
                        title: 'Edit Faculty Head',
                        html: `
                    <form id="editFacultyHeadForm">
                        <div class="form-group">
                            <label for="newFacultyHead">Select New Faculty Head</label>
                            <select id="newFacultyHead" class="form-control" required>
                                <option value="">Select a new faculty head</option>
                                ${employerOptions}
                            </select>
                        </div>
                    </form>
                `,
                        showCancelButton: true,
                        confirmButtonText: 'Update',
                        preConfirm: () => {
                            const newFacultyHead = $('#newFacultyHead').val();
                            if (!newFacultyHead) {
                                Swal.showValidationMessage('Please select a new faculty head.');
                                return false;
                            }
                            return newFacultyHead;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: 'actions/update_faculty_head.php',
                                type: 'POST',
                                data: {
                                    facultyID: facultyID,
                                    newHeadUserID: result.value
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire('Updated!', 'Faculty head has been updated.', 'success').then(() => {
                                            location.reload(); // Reload page after confirmation
                                        });
                                    } else {
                                        Swal.fire('Failed!', response.message, 'error');
                                    }
                                },
                                error: function() {
                                    Swal.fire('Error!', 'An error occurred while updating the faculty head.', 'error');
                                }
                            });
                        }
                    });
                },
                error: function() {
                    Swal.fire('Error!', 'An error occurred while fetching current employers.', 'error');
                }
            });
        }
        $(document).ready(function() {
            // Handle button click to open modal and load branches
            $('button[data-toggle="modal"]').on('click', function() {
                var branchId = $(this).data('branch_id');
                var facName = $(this).data('facname'); // Use 'facname'
                var creditFee = $(this).data('creditfee'); // Use 'creditfee'

                $('#branchesModalLabel').text('Branches for Faculty: ' + facName);

                $.ajax({
                    url: 'actions/getBranchesForFaculty.php', // PHP file to handle the request
                    type: 'POST',
                    data: {
                        facultyID: branchId
                    },
                    success: function(response) {
                        $('#branchesTableContainer').html(response);

                        // Store initially selected branches in hidden input
                        var initialBranches = [];
                        $('.branch-checkbox:checked').each(function() {
                            initialBranches.push($(this).val());
                        });
                        $('#initialBranches').val(JSON.stringify(initialBranches));
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', status, error);
                        $('#branchesTableContainer').html('<p>An error occurred while fetching branch data.</p>');
                    }
                });
            });

            // Handle form submission with AJAX
            $('#branchesForm').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Fetch values
                var facid = $('button[data-toggle="modal"]').data('branch_id');
                var facName = $('button[data-toggle="modal"]').data('facname');
                var creditFee = $('button[data-toggle="modal"]').data('creditfee');

                // Ensure that values are properly fetched
                if (!facid || !facName || !creditFee) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Required parameters are missing.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                var selectedBranches = [];
                $('.branch-checkbox:checked').each(function() {
                    selectedBranches.push($(this).val());
                });

                var formData = {
                    id: facid,
                    facName: facName,
                    creditFee: creditFee,
                    branches: JSON.stringify(selectedBranches) // Send only checked branches
                };

                $.ajax({
                    url: 'actions/submitBranches.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json', // Explicitly tell jQuery to expect JSON response
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.reload();
                            });

                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while updating branches.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });

        function editDepartmentHead(departmentID) {
            $.ajax({
                url: 'actions/get_current_employers.php', // Adjust the URL as needed
                type: 'GET',
                dataType: 'json',
                success: function(employers) {
                    let employerOptions = employers.map(emp =>
                        `<option value="${emp.UserID}">${emp.Username} (${emp.Email})</option>`
                    ).join('');

                    Swal.fire({
                        title: 'Edit Department Head',
                        html: `
                    <form id="editDepartmentHeadForm">
                        <div class="form-group">
                            <label for="newDepartmentHead">Select New Department Head</label>
                            <select id="newDepartmentHead" class="form-control" required>
                                <option value="">Select a new department head</option>
                                ${employerOptions}
                            </select>
                        </div>
                    </form>
                `,
                        showCancelButton: true,
                        confirmButtonText: 'Update',
                        preConfirm: () => {
                            const newDepartmentHead = $('#newDepartmentHead').val();
                            if (!newDepartmentHead) {
                                Swal.showValidationMessage('Please select a new department head.');
                                return false;
                            }
                            return newDepartmentHead;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: 'actions/update_department_head.php', // Adjust the URL as needed
                                type: 'POST',
                                data: {
                                    departmentID: departmentID,
                                    newHeadUserID: result.value
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire('Updated!', 'Department head has been updated.', 'success').then(() => {
                                            location.reload(); // Reload page after confirmation
                                        });
                                    } else {
                                        Swal.fire('Failed!', response.message, 'error');
                                    }
                                },
                                error: function() {
                                    Swal.fire('Error!', 'An error occurred while updating the department head.', 'error');
                                }
                            });
                        }
                    });
                },
                error: function() {
                    Swal.fire('Error!', 'An error occurred while fetching current employers.', 'error');
                }
            });
        }

        function editDepartmentName(departmentID) {
            Swal.fire({
                title: 'Edit Department Name',
                input: 'text',
                inputLabel: 'New Department Name',
                inputValue: '', // You can set this to the current name if needed
                inputPlaceholder: 'Enter new department name',
                showCancelButton: true,
                confirmButtonText: 'Update',
                cancelButtonText: 'Cancel',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Please enter a department name!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'actions/update_department_name.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            departmentID: departmentID,
                            newDepartmentName: result.value
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Updated!', 'Department name has been updated.', 'success').then(() => {
                                    location.reload(); // Reload page after confirmation
                                });
                            } else {
                                Swal.fire('Failed!', response.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'An error occurred while updating the department name.', 'error');
                        }
                    });
                }
            });
        }
    </script>

</body>

</html>