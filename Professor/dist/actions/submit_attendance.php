<?php
require_once('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $courseID = intval($_POST['course_id']);
    $date = $_POST['date'];
    $attendanceData = $_POST['attendance'];

    $dataRetrieve = new UserManagement();

    // Iterate over attendance data
    foreach ($attendanceData as $attendance) {
        $enrollmentID = intval($attendance['enrollmentID']);
        $status = $attendance['status'];

        // Submit the attendance to the database using your query function
        $result = $dataRetrieve->submitAttendance($enrollmentID, $date, $status);

        if (!$result) {
            // Handle failure
            http_response_code(500); // Internal server error
            echo json_encode(['error' => 'Failed to submit attendance.']);
            exit;
        }
    }

    // If all attendance entries were successfully inserted
    echo json_encode(['success' => 'Attendance submitted successfully!']);
} else {
    http_response_code(405); // Method not allowed
    echo json_encode(['error' => 'Invalid request method.']);
}
