<?php
// Include necessary files or classes here if needed
require_once('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $fisrt_paragraph = $_POST['first_paragraph'];
    $documents_list = $_POST['documents_list'];
    $last_paragraph = $_POST['last_paragraph'];
    $id = $_POST['record_id'];

    // Create an instance of the data retrieval class
    $dataFetch = new UserManagement();

    // Call the update function
    $result = $dataFetch->updateTransfer($fisrt_paragraph, $documents_list, $last_paragraph, $id);

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
