<?php
// Include necessary files or classes here if needed
require_once('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $welcomeStatement = $_POST['welcomestatement'];
    $presidentMessage = $_POST['presidentmessage'];
    $history = $_POST['history'];
    $schoolsList = $_POST['schoolslist'];
    $curriculum = $_POST['curriculum'];
    $id = $_POST['record_id'];

    // Create an instance of the data retrieval class
    $dataFetch = new UserManagement();

    // Call the update function
    $result = $dataFetch->updateAboutInfo($welcomeStatement, $presidentMessage, $history, $schoolsList, $curriculum, $id);

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
