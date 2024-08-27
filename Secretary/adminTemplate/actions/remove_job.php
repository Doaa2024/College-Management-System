<?php

require('../DAL/edit.class.php');
if (isset($_POST['jobID'])) {
    $jobId = $_POST['jobID'];
    $userManagement = new UserManagement();
    $result = $userManagement->remove_job($jobId);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Job Offer removed successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to remove job offer']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
