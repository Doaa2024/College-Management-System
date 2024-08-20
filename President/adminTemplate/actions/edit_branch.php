<?php
require('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['branchID'])) {
    $branchID = $_POST['branchID'];
    $branchName = $_POST['branchName'];
    $branchLocation = $_POST['branchLocation'];
    
    // Instantiate the UserManagement class
    $userManagement = new UserManagement();
    
    // Call the method to update the branch
    $result = $userManagement->edit_branch($branchID, $branchName, $branchLocation);
    
    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Branch updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update branch']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
