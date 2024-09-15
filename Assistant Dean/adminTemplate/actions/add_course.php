<?php
require('../DAL/edit.class.php');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $semester = $_POST['semester'];
    $year = $_POST['year'];
    $course_id = $_POST['course_id'];
    $room_id = $_POST['room_id'];
    $time = $_POST['time'];
    $days = isset($_POST['day_of_week']) ? $_POST['day_of_week'] : [];
    $days_of_week = implode(',', $days);
    $userManagement = new UserManagement();
    // Validate input
    if (empty($course_id) || empty($room_id) || empty($time) || empty($days)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }
     // Check for conflicts
     $check = $userManagement->checkScheduleConflict($semester, $year,$room_id, $days, $time);
     if ($check) {
        echo json_encode(['status' => 'error', 'message' => 'Scheduling conflict detected.']);
        exit;
    }
    $result = $userManagement->add_Course($course_id, $room_id, $time,  $days_of_week,$semester,$year);
    // Convert days array to string for storage (e.g., M-W-F)
    // Check the result and return the appropriate response
    if ($result > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Course added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add course, invalid input']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
