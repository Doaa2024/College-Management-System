<?php
session_start();
require('../DAL/edit.class.php');


$response = array('success' => false, 'message' => '');

if (isset($_POST['employee_id']) || (isset($_POST['branch_id']))) {
    $userID = $_POST['employee_id'];
    $branch_id =  $_POST['branch_id'];
    $dataRetrieval = new UserManagement();
    $result = $dataRetrieval->searchEmployeeByID($userID,   $branch_id);

    if ($result) {
        $response['success'] = true;
        $response['data'] = $result[0]; // Assuming $result is an array of results
    } else {
        $response['message'] = 'No Employee found with the provided ID.';
    }
} else {
    $response['message'] = 'Employee ID is required.';
}

echo json_encode($response);
