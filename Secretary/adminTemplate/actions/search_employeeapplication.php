<?php
session_start();
require('../DAL/retrieve.class.php');


$response = array('success' => false, 'message' => '');

if (isset($_POST['employee_id'])) {
    $userID = $_POST['employee_id'];

    $dataRetrieval = new UniversityDataRetrieval();
    $result = $dataRetrieval->searchEmployeeApplicationByID($userID);

    if ($result) {
        $response['success'] = true;
        $response['data'] = $result[0]; // Assuming $result is an array of results
    } else {
        $response['message'] = 'No Employee Application found with the provided Application ID.';
    }
} else {
    $response['message'] = 'Employee Application ID is required.';
}

echo json_encode($response);
