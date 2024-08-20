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
        $formattedInfo['FacultyName'] = htmlspecialchars($facultyInfo[0]['FacultyName']);
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
echo var_dump($facultyInfo);
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
        <?php echo var_dump($formattedInfo);?>
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
                    <button class="btn btn-primary" data-branch-id="<?php echo htmlspecialchars($id); ?>" onclick="manageBranches(<?php echo intval($id); ?>)">
                        <i class="fas fa-edit mr-1"></i> Manage Branches
                    </button>


                </div>
            </div>
            <!-- Departments and Courses -->
            <div class="tab-pane fade" id="departments" role="tabpanel" aria-labelledby="departments-tab">
                <h4 class="mb-3">Departments and Courses</h4>
                <?php foreach ($formattedInfo['Departments'] as $department): ?>
                    <div class="mb-4 p-3  border-left-primary">
                        <!-- <div class="d-flex gap-5"> -->
                        <h5>Department Name: <?php echo $department['DepartmentName']; ?></h5>
                        <p><strong>Department Head:</strong> <?php echo $department['DepartmentHead']; ?></p>
                        <!-- </div> -->
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
                                        <td><?php echo $course['CourseName']; ?></td>
                                        <td><?php echo $course['CourseCode']; ?></td>
                                        <td><?php echo $course['Credits']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end gap-2" style="gap:10px">

                        <button class="btn btn-primary">
                            <i class="fas fa-user mr-1"></i> Edit Department Head
                        </button>
                        <button class="btn btn-primary" data-id="<?php echo isset($_GET['facultyID']) ? intval($_GET['facultyID']) : 0; ?>" data-fee="<?php echo $formattedInfo['CreditFee']; ?>">
                            <i class="fas fa-edit mr-1"></i> Edit Department Name
                        </button>

                    </div>
                <?php endforeach; ?>
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

        function manageBranches(facultyID) {
          
            $.ajax({
                url: 'actions/get_branches_for_faculty.php',
                type: 'GET',
                data: {
                    facultyID: facultyID
                },
                dataType: 'json',
                success: function(currentBranches) {
                    console.log('Current branches:', currentBranches); // Debugging line

                    $.ajax({
                        url: 'actions/get_all_branches.php',
                        type: 'GET',
                        dataType: 'json',
                        success: function(allBranches) {
                            console.log('All branches:', allBranches); // Debugging line

                            // Check if data is received correctly
                            if (!Array.isArray(currentBranches) || !Array.isArray(allBranches)) {
                                Swal.fire('Error!', 'Received data is not in expected format.', 'error');
                                return;
                            }

                            // Validate that the branches contain the expected fields
                            if (currentBranches.some(branch => !branch.BranchID) ||
                                allBranches.some(branch => !branch.BranchID)) {
                                Swal.fire('Error!', 'Data format is incorrect. Missing BranchID.', 'error');
                                return;
                            }

                            let currentBranchIDs = currentBranches.map(branch => branch.BranchID);
                            let branchOptions = allBranches.map(branch => {
                                const isChecked = currentBranchIDs.includes(branch.BranchID) ? 'checked' : '';
                                return `
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="${branch.BranchID}" id="branch_${branch.BranchID}" ${isChecked}>
                                <label class="form-check-label" for="branch_${branch.BranchID}">
                                    ${branch.BranchName} - ${branch.Location}
                                </label>
                            </div>
                        `;
                            }).join('');

                            Swal.fire({
                                title: 'Manage Branches',
                                html: `
                            <form id="manageBranchesForm">
                                <div class="form-group">
                                    <label for="branches">Select Branches</label>
                                    ${branchOptions}
                                </div>
                            </form>
                        `,
                                showCancelButton: true,
                                confirmButtonText: 'Update',
                                preConfirm: () => {
                                    let selectedBranches = [];
                                    $('#manageBranchesForm input:checked').each(function() {
                                        selectedBranches.push($(this).val());
                                    });
                                    if (selectedBranches.length === 0) {
                                        Swal.showValidationMessage('Please select at least one branch.');
                                        return false;
                                    }
                                    return selectedBranches;
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: 'actions/update_faculty_branches.php',
                                        type: 'POST',
                                        data: {
                                            facultyID: facultyID,
                                            branches: result.value
                                        },
                                        success: function(response) {
                                            if (response.success) {
                                                Swal.fire('Updated!', 'Branches have been updated.', 'success');
                                                location.reload(); // Reload page to reflect the changes
                                            } else {
                                                Swal.fire('Failed!', response.message, 'error');
                                            }
                                        },
                                        error: function() {
                                            Swal.fire('Error!', 'An error occurred while updating branches.', 'error');
                                        }
                                    });
                                }
                            });
                        },
                        error: function() {
                            Swal.fire('Error!', 'An error occurred while fetching all branches.', 'error');
                        }
                    });
                },
                error: function() {
                    Swal.fire('Error!', 'An error occurred while fetching branches for the faculty.', 'error');
                }
            });
        }
    </script>

</body>

</html>