<?php
require_once('../DAL/edit.class.php');

$dataRetrieval = new UserManagement();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = isset($_POST['userID']) ? intval($_POST['userID']) : null;
    $courseID = isset($_POST['courseID']) ? intval($_POST['courseID']) : null;
    $timeTableID = isset($_POST['timeTableID']) ? intval($_POST['timeTableID']) : null;

    if ($userID && $courseID && $timeTableID) {
        $success = $dataRetrieval->registerCourse($userID, $courseID, $timeTableID);

        if ($success) {
            echo json_encode(['status' => 'success', 'message' => 'Course registered successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to register course']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
