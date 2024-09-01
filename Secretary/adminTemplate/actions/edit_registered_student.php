<?php
require_once('../DAL/edit.class.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $department = $_POST['department'];
    $status = $_POST['status'];
    $branchId = $_POST['branch'];
    $facultyId = $_POST['faculty'];
    $id = $_POST['record_id'];

    // Create an instance of the data retrieval class
    $dataFetch = new UserManagement();

    // Call the update function
    $result = $dataFetch->updateStudentInfo($id, $department, $status, $branchId, $facultyId);

    // Send JSON response
    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Employee info updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update employee info.']);
    }
} else {
    // Not a POST request
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
