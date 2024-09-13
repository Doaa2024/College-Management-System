<?php
require('../DAL/edit.class.php');

// Set header to return JSON
header('Content-Type: application/json');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $semester = $_POST['semester'];
    $year = $_POST['year'];
    $course_id = $_POST['course'];
    $room_id = $_POST['room'];
    $time = $_POST['time'];
    $days = isset($_POST['day_of_week']) ? $_POST['day_of_week'] : [];
    $days_of_week = implode(',', $days);
    $timetableid = $_POST['TimetableID'];
    $userManagement = new UserManagement();

    // Validate input
    if (empty($course_id) || empty($room_id) || empty($time) || empty($days) || empty($timetableid)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    $update = $userManagement->checkScheduleUpdate($semester, $year, $course_id, $room_id, $days_of_week, $time);
    if ($update) {
        echo json_encode(['status' => 'error', 'message' => 'No updates have been done!']);
        exit;
    }

    // Check for conflicts
    $check = $userManagement->checkScheduleEditConflict($semester, $year, $room_id, $days, $time, $timetableid);
    if ($check) {
        echo json_encode(['status' => 'error', 'message' => 'Scheduling conflict detected.']);
        exit;
    }

    $result = $userManagement->update_Course($timetableid, $course_id, $room_id, $time, $days_of_week, $semester, $year);

    // Check the result and return the appropriate response
    if ($result > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Course edited successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No updates have been done!']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
