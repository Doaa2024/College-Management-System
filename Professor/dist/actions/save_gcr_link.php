<?php
require_once("../DAL/edit.class.php");

$dataRetrieve = new UserManagement();
$courseID = $_POST['course_id'];
$gcrLink = $_POST['gcr_link'];

try {
    $result = $dataRetrieve->saveGCRLink($courseID, $gcrLink);
    
    if ($result) {
        // Return a success response
        echo json_encode(['status' => 'success']);
    } else {
        // Return a failure response if the update fails
        echo json_encode(['status' => 'error', 'message' => 'Failed to update the GCR link.']);
    }
} catch (Exception $e) {
    // Return an error response if an exception occurs
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
