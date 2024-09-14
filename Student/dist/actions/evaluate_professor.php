<?php
require_once('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseID = intval($_POST['courseID']);
    $studentID = intval($_POST['studentID']);
    $professorID = intval($_POST['professorID']);
    $rating = floatval($_POST['rating']);
    $comments = htmlspecialchars($_POST['comments']);

    $universityData = new UserManagement();
    
    $result = $universityData->insertEvaluation($courseID, $studentID, $professorID, $rating, $comments);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Evaluation submitted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to submit evaluation.']);
    }
}
?>
