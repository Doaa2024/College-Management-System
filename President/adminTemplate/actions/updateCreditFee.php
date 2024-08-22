<?php
require('../DAL/edit.class.php');

$response = ['success' => false, 'message' => ''];

// Get the data from POST request
$facultyID = isset($_POST['facultyID']) ? intval($_POST['facultyID']) : 0;
$newCreditFee = isset($_POST['newCreditFee']) ? floatval($_POST['newCreditFee']) : 0;

if ($facultyID > 0 && $newCreditFee > 0) {
    $facultyRetrieval = new UserManagement();

    // Update the credit fee in the database
    if ($facultyRetrieval->updateFacultyCreditFee($facultyID, $newCreditFee)) {
        $response['success'] = true;
        $response['message'] = 'Credit fee updated successfully.';
    } else {
        $response['message'] = 'Failed to update credit fee.';
    }
} else {
    $response['message'] = 'Invalid input.';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
