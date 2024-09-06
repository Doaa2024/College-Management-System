<?php
require('../DAL/edit.class.php');

if (isset($_POST['CourseCode']) && isset($_POST['CourseName']) && isset($_POST['CourseCredits'])) {
    $CourseCode = $_POST['CourseCode'];
    $CourseName = $_POST['CourseName'];
    $CourseCredits = $_POST['CourseCredits'];

    $userManagement = new UserManagement();
    $result1= $userManagement->getCourseNameCodeAdd($CourseName,$CourseCode);
    if($result1){
        echo json_encode(['status' => 'error', 'message' => 'Course Name or Code already exists choose another one!']);
    }else{
    // Attempt to add the course
    $result = $userManagement->add_course($CourseName, $CourseCode, $CourseCredits);

    // Check the result and return the appropriate response
    if ($result > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Course added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add course']);
    }
}
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
