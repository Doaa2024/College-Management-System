<?php
require('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['jobID'])) {
    $jobID = $_POST['jobID'];
    $jobTitle = $_POST['jobTitle'];
    $facultyId = $_POST['facultyId'];
    $jobDescription = $_POST['jobDescription'];
    $requiredQualifications = $_POST['requiredQualifications'];
    $applicationDeadline = $_POST['applicationDeadline'];
    $jobLocation = $_POST['jobLocation'];
    $jobType = $_POST['jobType'];
    $salaryRange = $_POST['salaryRange'];
    $jobStatus = $_POST['jobStatus'];
    // Instantiate the UserManagement class
    $userManagement = new UserManagement();

    // Call the method to update the branch
    $result = $userManagement->edit_job($jobID, $jobTitle, $facultyId, $jobDescription, $requiredQualifications, $applicationDeadline, $jobLocation, $jobType, $salaryRange, $jobStatus);


    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Job Offer updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update job offer']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
