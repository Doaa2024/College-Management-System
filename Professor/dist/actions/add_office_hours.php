<?php
require_once('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dayOfWeek = $_POST['DayOfWeek'];
    $startTime = $_POST['StartTime'];
    $endTime = $_POST['EndTime'];

    // Validate inputs
    if (empty($dayOfWeek) || empty($startTime) || empty($endTime)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all fields.']);
        exit;
    }

    $dataRetrieve = new UserManagement();

    // Example Professor ID, you can set this dynamically
    $professorID = 6;

    // Insert new office hour
    $result = $dataRetrieve->addOfficeHour($professorID, $dayOfWeek, $startTime, $endTime);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add office hour.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
