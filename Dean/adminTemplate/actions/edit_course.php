<?php
require('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['CourseID'])) {
    $CourseID = $_POST['CourseID'];
    $CourseName = $_POST['CourseName'];
    $CourseCode = $_POST['CourseCode'];
    $CourseCredits = $_POST['CourseCredits'];
    // Instantiate the UserManagement class
    $userManagement = new UserManagement();
   $result= $userManagement->getCourseInfo($CourseID,$CourseName,$CourseCode,$CourseCredits);
   $result0= $userManagement->getCourseNameCode($CourseID,$CourseName,$CourseCode);
   if($result){
    echo json_encode(['status' => 'error', 'message' => 'Nothing have changed!']);
   }elseif($result0){
    echo json_encode(['status' => 'error', 'message' => 'Course Name or Code already exists choose another one!']);
}
else{
    $result1 = $userManagement->updateCourseInfo($CourseID, $CourseName, $CourseCode, $CourseCredits);
    if ($result1) {
        echo json_encode(['status' => 'success', 'message' => 'Course Info updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update course info']);
    }
}
}
 else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
