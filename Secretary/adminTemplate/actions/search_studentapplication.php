<?php
session_start();
require('../DAL/retrieve.class.php');


$response = array('success' => false, 'message' => '');

if (isset($_POST['application_id'])) {
    $applicationID = $_POST['application_id'];

    $dataRetrieval = new UniversityDataRetrieval();
    $result = $dataRetrieval->searchStudentApplicationByID($applicationID);

    if ($result) {
        $response['success'] = true;
        $response['data'] = $result[0]; // Assuming $result is an array of results
    } else {
        $response['message'] = 'No student application found with the provided ID.';
    }
} else {
    $response['message'] = 'Student Application ID is required.';
}

echo json_encode($response);
