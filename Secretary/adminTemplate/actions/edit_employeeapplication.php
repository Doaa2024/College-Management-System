<?php
// Include necessary files or classes here if needed
require_once('../DAL/edit.class.php');
$response = array('success' => false, 'message' => '');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    // Debugging output

    $reviewedBy = $_POST['reviewedBy'];
    $reviewedAt = $_POST['reviewedAt'];
    $status = $_POST['status'];
    $id = $_POST['record_id'];

    // Create an instance of the data retrieval class
    $dataFetch = new UserManagement();

    // Call the update function
    $result = $dataFetch->updateProfessorApplication($reviewedBy, $reviewedAt, $status, $id);

    // Send JSON response
    $result1 = $dataFetch->searchEmployeeApplicationByIDAgain($id);

    if ($result) {
        $response['success'] = true;
        $response['data'] = $result1[0]; // Assuming $result is an array of results
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update record.']);
    }
} else {
    // Not a POST request
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
echo json_encode($response);
