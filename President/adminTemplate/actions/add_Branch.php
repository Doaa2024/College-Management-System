<?php

require('../DAL/edit.class.php');
if (isset($_POST['branchName']) && isset($_POST['branchLocation'])) {
    $branchName = $_POST['branchName'];
    $branchLocation = $_POST['branchLocation'];

    $userManagement = new UserManagement();
    $result = $userManagement->add_branch($branchName, $branchLocation);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Branch added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add branch']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
