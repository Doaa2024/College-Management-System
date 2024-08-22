<?php
session_start();
require('../DAL/retrieve.class.php');


$response = array('success' => false, 'message' => '');

if (isset($_POST['student_id'])) {
    $userID = $_POST['student_id'];

    $dataRetrieval = new UniversityDataRetrieval();
    $result = $dataRetrieval->searchStudentByID($userID);

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
