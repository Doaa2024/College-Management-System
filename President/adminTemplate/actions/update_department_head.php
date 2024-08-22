<?php
// Include necessary files
require('../DAL/edit.class.php'); // Adjust the path to your DAL class

// Retrieve data from POST request
$departmentID = isset($_POST['departmentID']) ? intval($_POST['departmentID']) : 0;
$newHeadUserID = isset($_POST['newHeadUserID']) ? intval($_POST['newHeadUserID']) : 0;

// Initialize response array
$response = ['success' => false, 'message' => 'An error occurred.'];

// Check if departmentID and newHeadUserID are valid
if ($departmentID > 0 && $newHeadUserID > 0) {
    try {
        // Instantiate your DAL or data retrieval class
        $dataAccess = new UserManagement(); // Adjust according to your DAL class

        // Prepare the SQL query to update the department head
        $result = $dataAccess->updateDepartmentHead($departmentID, $newHeadUserID);

        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Department head updated successfully.';
        } else {
            $response['message'] = 'Failed to update department head.';
        }
    } catch (Exception $e) {
        $response['message'] = 'Exception: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Invalid department ID or department head user ID.';
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
