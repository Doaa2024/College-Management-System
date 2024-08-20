<?php
require("../DAL/edit.class.php");

$facultyID = isset($_POST['facultyID']) ? intval($_POST['facultyID']) : 0;
$newHeadUserID = isset($_POST['newHeadUserID']) ? intval($_POST['newHeadUserID']) : 0;

$dal = new UserManagement();
$result = $dal->updateFacultyHead($facultyID, $newHeadUserID);

$response = ['success' => $result];
if (!$result) {
    $response['message'] = 'Failed to update the faculty head.';
}

header('Content-Type: application/json');
echo json_encode($response);
