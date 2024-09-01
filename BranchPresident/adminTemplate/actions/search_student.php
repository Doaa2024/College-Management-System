<?php
session_start();
require('../DAL/edit.class.php');


$response = array('success' => false, 'message' => '');

if (isset($_POST['student_id']) || (isset($_POST['branch_id']))) {
    $userID = $_POST['student_id'];
    $branch_id =  $_POST['branch_id'];
    $dataRetrieval = new UserManagement();
    $result = $dataRetrieval->searchStudentByID($userID ,$branch_id);

    if ($result) {
        $response['success'] = true;
        $response['data'] = $result[0]; // Assuming $result is an array of results
    } else {
        $response['message'] = 'No student found with the provided ID.';
    }
} else {
    $response['message'] = 'Student ID is required.';
}

echo json_encode($response);
