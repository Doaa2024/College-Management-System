<?php
require_once("../DAL/edit.class.php");

$dataRetrieve = new UserManagement();
$examID = $_POST['exam_id'];
$filePath = $_POST['examPath']; // File path received from the AJAX request

try {
    // Validate the file path
    if ($filePath) {
        $fullFilePath = '../dataClient/PreviousExams/' . $filePath; // Ensure the path is correct

        // Delete the record from the database first
        $result = $dataRetrieve->deleteExam($examID);

        if ($result) {
            // Delete the file from the server
            if (file_exists($fullFilePath)) {
                if (!unlink($fullFilePath)) {
                    throw new Exception('Failed to delete the file from the server.');
                }
            } else {
                throw new Exception('File does not exist on the server.');
            }

            echo json_encode(['status' => 'success', 'message' => 'Exam deleted successfully.']);
        } else {
            throw new Exception('Failed to delete the exam record from the database.');
        }
    } else {
        throw new Exception('Invalid file path.');
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
}
