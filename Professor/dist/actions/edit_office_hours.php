<?php
header('Content-Type: application/json');

require_once('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data
    $officeHourID = $_POST['OfficeHourID'];
    $dayOfWeek = $_POST['DayOfWeek'];
    $startTime = $_POST['StartTime'];
    $endTime = $_POST['EndTime'];

    // Instance of the Data Retrieval class
    $dataRetrieve = new UserManagement();

    // Update the office hours
    $success = $dataRetrieve->updateOfficeHours($officeHourID, $dayOfWeek, $startTime, $endTime);

    // Respond with JSON
    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update office hours.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
