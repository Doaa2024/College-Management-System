<?php
// Include necessary files
require('../DAL/edit.class.php'); // Adjust the path to your DAL class

// Retrieve data from POST request
$departmentID = isset($_POST['departmentID']) ? intval($_POST['departmentID']) : 0;
$newDepartmentName = isset($_POST['newDepartmentName']) ? trim($_POST['newDepartmentName']) : '';

// Initialize response array
$response = ['success' => false, 'message' => 'An error occurred.'];

// Check if departmentID and newDepartmentName are valid
if ($departmentID > 0 && !empty($newDepartmentName)) {
    try {
        // Instantiate your DAL or data retrieval class
        $dataAccess = new UserManagement(); // Adjust according to your DAL class

        // Prepare the SQL query to update the department name
        $result = $dataAccess->updateDepartmentName($departmentID, $newDepartmentName);

        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Department name updated successfully.';
        } else {
            $response['message'] = 'Failed to update department name.';
        }
    } catch (Exception $e) {
        $response['message'] = 'Exception: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Invalid department ID or department name.';
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
