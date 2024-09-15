<?php
require_once('../DAL/edit.class.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $role = $_POST['role'];
    $status = $_POST['status'];
    $branchId = $_POST['branch'];
    $facultyId = $_POST['faculty'];
    $departmentID = isset($_POST['department']) ? $_POST['department'] : '';
    $id = $_POST['record_id'];

    // Create an instance of the data retrieval class
    $dataFetch = new UserManagement();

    require_once('../DAL/edit.class.php');

    // Set the content type to JSON
    header('Content-Type: application/json');

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve POST data
        $role = $_POST['role'];
        $status = $_POST['status'];
        $branchId = $_POST['branch'];
        $facultyId = $_POST['faculty'];
        $departmentID = isset($_POST['department']) ? $_POST['department'] : '';
        $id = $_POST['record_id'];

        // Create an instance of the data retrieval class
        $dataFetch = new UserManagement();

        // Check if the faculty exists in the specified branch
        $check = $dataFetch->checkFaculty($branchId, $facultyId);

        // Check if the query returned a valid result
        if (!$check) { // Use empty($check) or !$check if $check is expected to be empty on failure
            echo json_encode(['status' => 'error', 'message' => 'The Faculty is not found in this branch!']);
        } else {
            // Call the appropriate update function
            if (isset($_POST['department'])) {
                $result = $dataFetch->updateAssistantDeanInfo($id, $role, $status, $branchId, $facultyId, $departmentID);
            } else {
                $result = $dataFetch->updateEmployeeInfo($id, $role, $status, $branchId, $facultyId);
            }

            // Send JSON response based on the update result
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Employee info updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update employee info.']);
            }
        }
    } else {
        // Not a POST request
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    }
}
