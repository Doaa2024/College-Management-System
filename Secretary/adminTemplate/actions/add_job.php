<?php

require('../DAL/edit.class.php');
if (
    isset($_POST['jobTitle']) && isset($_POST['facultyId']) && isset($_POST['jobDescription']) &&
    isset($_POST['requiredQualifications']) && isset($_POST['applicationDeadline']) &&
    isset($_POST['jobLocation']) && isset($_POST['jobType']) && isset($_POST['salaryRange']) && isset($_POST['jobStatus'])
) {

    $jobTitle = $_POST['jobTitle'];
    $facultyId = $_POST['facultyId'];
    $jobDescription = $_POST['jobDescription'];
    $requiredQualifications = $_POST['requiredQualifications'];
    $applicationDeadline = $_POST['applicationDeadline'];
    $jobLocation = $_POST['jobLocation'];
    $jobType = $_POST['jobType'];
    $salaryRange = $_POST['salaryRange'];
    $jobStatus = $_POST['jobStatus'];

    $userManagement = new UserManagement();
    $result = $userManagement-> register_student($username, $email, $role, $branchID, $facultyID, $departmentID, $password);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Job Offer added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add job offer']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
