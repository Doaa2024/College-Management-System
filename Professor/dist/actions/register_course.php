<?php
require_once('../DAL/edit.class.php'); // Include your DAL class

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch the professorID, courseID, startTime, endTime, semester, and year from POST request
    $professorID = isset($_POST['professorID']) ? intval($_POST['professorID']) : 0;
    $courseID = isset($_POST['courseID']) ? intval($_POST['courseID']) : 0;
  
    $time = isset($_POST['time']) ? $_POST['time'] : '';
    $semester = isset($_POST['semester']) ? $_POST['semester'] : '';
    $year = isset($_POST['year']) ? intval($_POST['year']) : 0;

    // Instantiate your data access class
    $dataRetrieve = new UserManagement();

    // Update the timetable with the professorID
    $result1 = $dataRetrieve->UpdateTimetable($courseID, $professorID,$time);

    // Insert a new enrollment record
    $result2 = $dataRetrieve->AddEnrollment($professorID, $courseID, 'Professor', $semester, $year);

    // Check if both operations were successful
    if ($result1 && $result2) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
