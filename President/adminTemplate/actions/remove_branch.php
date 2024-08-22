<?php

require('../DAL/edit.class.php');
if (isset($_POST['branchID'])) {
    $branchID = $_POST['branchID'];

    $userManagement = new UserManagement();
    $result = $userManagement->remove_branch($branchID);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Branch removed successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to remove branch']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
