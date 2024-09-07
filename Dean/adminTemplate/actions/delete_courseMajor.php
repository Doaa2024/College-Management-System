<?php

require('../DAL/edit.class.php');
if (isset($_POST['courseID'])) {
    $courseID= $_POST['courseID'];
    $departmentID=$_POST['departmentID'];
    $userManagement = new UserManagement();
    $result = $userManagement->remove_courseFromDepartment($courseID,$departmentID);
if($departmentID=='Null'){
    echo json_encode(['status' => 'error', 'message' => 'Select a course in a department to delete!']);
}else{
    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Course removed from the department successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add course']);
    }
}} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
