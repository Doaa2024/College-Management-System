<?php

require('../DAL/edit.class.php');
if (isset($_POST['CourseID'])) {
    $courseID= $_POST['CourseID'];
    $userManagement = new UserManagement();
    $result = $userManagement->remove_course($courseID);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Course removed successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to remove course offer']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
