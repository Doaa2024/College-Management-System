<?php
require_once('../DAL/edit.class.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $admission = $_POST['admission'];
    $documents = $_POST['documents'];
    $courses = $_POST['courses'];
    $curriculum = $_POST['curriculum'];
    $credit_hours = $_POST['credit_hours'];
    $major_courses = $_POST['major_courses'];
    $major_electives = $_POST['major_electives'];
    $core_courses = $_POST['core_courses'];
    $general_education = $_POST['general_education'];
    $conclusion = $_POST['conclusion'];
    $id = $_POST['record_id'];

    // Create an instance of the data retrieval class
    $dataFetch = new UserManagement();

    // Call the update function
    $result = $dataFetch->updateRequirements($id, $admission, $documents, $courses, $curriculum, $credit_hours, $major_courses, $major_electives, $core_courses, $general_education, $conclusion);

    // Send JSON response
    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Record updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update record.']);
    }
} else {
    // Not a POST request
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
