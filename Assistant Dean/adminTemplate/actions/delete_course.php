<?php
require('../DAL/edit.class.php');
if (isset($_POST['TimetableID'])) {
    $timeid= $_POST['TimetableID'];
    $userManagement = new UserManagement();
    $result = $userManagement->remove_courseFromDepartment($timeid);
if($timeid=='Null'){
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
