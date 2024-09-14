<?php
require_once('../DAL/retrieve.class.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $userID = intval($_POST['userID']);
    $courseID = intval($_POST['courseID']);

    // Create an instance of the UniversityDataRetrieval class
    $universityData = new UniversityDataRetrieval();

    // Fetch grades and weighted grades
    $grades = $universityData->getGradesAndWeightedGrades($userID, $courseID);

    // Fetch total grade
    $totalGrade = $universityData->calculateTotalGrade($userID, $courseID);

    // Prepare the response data
    $response = [
        'grades' => $grades,
        'totalGrade' => $totalGrade
    ];

    // Return the JSON response
    echo json_encode($response);
}
?>
