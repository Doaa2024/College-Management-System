<?php
require_once('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $officeHourID = $_POST['officeHourID'];

    // Instance of the Data Deletion class
    $dataDelete = new UserManagement();

    // Delete the office hours
    $success = $dataDelete->deleteOfficeHour($officeHourID);

    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete office hour.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
