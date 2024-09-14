<?php
require_once '../DAL/edit.class.php';

$dataEdit = new UserManagement();

// Initialize DAL class
$dal = new DAL();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $studentID = $_POST['StudentID'];
    $facultyID = $_POST['FacID'];
    $comments = $_POST['comments'];
    $requestType = $_POST['reqType']; // Initialize requestType

    // Initialize file paths array
    $filePaths = [];

    // Determine request type and handle file uploads
    if (isset($_FILES['attestationDocument'])) {
        $requestType = 'attestation';
        $files = $_FILES['attestationDocument'];
    } elseif (isset($_FILES['financialAidDocument'])) {
        $requestType = 'financial_aid';
        $files = $_FILES['financialAidDocument'];
    } elseif (isset($_FILES['petitionDocument'])) {
        $requestType = 'petition';
        $files = $_FILES['petitionDocument'];
    } else {
        $files = [];
    }

    // Process each file
    if (!empty($files)) {
        foreach ($files['name'] as $i => $fileName) {
            $filePath = $dataEdit->movemultiplefiles($files, $i);
            if ($filePath) {
                $filePaths[] = $filePath;
            } else {
                echo 'Error processing file: ' . $fileName . '<br>';
            }
        }
    }

    // Convert file paths array to a comma-separated string
    $filePathsStr = implode(',', $filePaths);

    // Submit the request
    try {
        $success = $dataEdit->insertStudentRequest($studentID, $facultyID, $requestType, $filePathsStr, $comments);
        if ($success) {
            echo 'Request submitted successfully!';
        } else {
            echo 'Failed to submit the request.';
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid request method.';
}


