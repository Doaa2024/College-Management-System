<?php
require_once('../DAL/edit.class.php');
$dataRetrieval = new UserManagement();

// Set the content type to JSON to return a response to AJAX
header('Content-Type: application/json');

// Initialize the response array
$response = [];

// Extract data from POST
$faculityName = isset($_POST['faculityName']) ? trim($_POST['faculityName']) : null;
$creditFee = isset($_POST['creditFee']) ? trim($_POST['creditFee']) : null;
$facultyHead = isset($_POST['facultyHead']) ? intval($_POST['facultyHead']) : null;

// Validate the input data
if (!$faculityName || strlen($faculityName) < 3) {
    $response['success'] = false;
    $response['message'] = "Faculty Name is required and must be at least 3 characters long.";
    echo json_encode($response);
    exit;
}

if ($creditFee !== null && !is_numeric($creditFee)) {
    $response['success'] = false;
    $response['message'] = "Invalid Credit Fee.";
    echo json_encode($response);
    exit;
}

if (!$facultyHead || !is_numeric($facultyHead)) {
    $response['success'] = false;
    $response['message'] = "Invalid Faculty Head.";
    echo json_encode($response);
    exit;
}

try {
    // Insert into faculties table
    $dataRetrieval->insertFaculty($faculityName, $creditFee);

    // Get the last inserted FacultyID
    $facultyID = $dataRetrieval->lastInsertedFacID();

    // Insert into facultyheads table
 
    $dataRetrieval->insertFacultyHead($facultyHead, $facultyID);

    // If everything is successful
    $response['success'] = true;
    $response['message'] = "Faculty added successfully!";
} catch (Exception $e) {
    // If any error occurs
    $response['success'] = false;
    $response['message'] = "Error: " . $e->getMessage();
}

// Return the response in JSON format
echo json_encode($response);
exit;
