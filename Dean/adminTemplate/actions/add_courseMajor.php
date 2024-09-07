<?php
require('../DAL/edit.class.php');

header('Content-Type: application/json'); // Ensure JSON content type

if (isset($_POST['CourseID']) && isset($_POST['departmentID'])) {
    $CourseID = $_POST['CourseID'];
    $departmentID = $_POST['departmentID'];
    $userManagement = new UserManagement();

    $result1 = $userManagement->checkCourse($CourseID, $departmentID);

    if ($departmentID == 'Null') {
        echo json_encode(['status' => 'error', 'message' => 'Select a course in a department to delete!']);
    } elseif ($result1) {
        echo json_encode(['status' => 'error', 'message' => 'This Course already exists in this department. Choose another one!']);
    } else {
        // Attempt to add the course
        $result = $userManagement->add_CourseInDepartment($CourseID, $departmentID);

        // Check the result and return the appropriate response
        if ($result > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Course added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add course, invalid input']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Choose a certain department to add a course']);
}
