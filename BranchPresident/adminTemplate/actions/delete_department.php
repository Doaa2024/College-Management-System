<?php
require_once('../DAL/edit.class.php');

// Check if departmentID is received
if (isset($_POST['departmentID'])) {
    $departmentID = intval($_POST['departmentID']);

    // Create an instance of your data retrieval class
    $dataRetrieval = new UserManagement();

    // Call your delete function
    $result = $dataRetrieval->deleteDepartment($departmentID);

    if ($result) {
        // Success response
        echo json_encode(['success' => true]);
    } else {
        // Error response
        echo json_encode(['success' => false, 'message' => 'Failed to delete department.']);
    }
} else {
    // Invalid request response
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
