<?php
require_once('../DAL/edit.class.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Create an instance of the data retrieval class
    $dataFetch = new UserManagement();
    
    // Retrieve student_id from the query parameters
    $studentID = isset($_GET['studentID']) ? intval($_GET['studentID']) : 0;

    if ($studentID > 0) {
        // Fetch the document status for the given student ID
        $documents = $dataFetch->getDocumentsByStudentID($studentID);
        
        // Check if any documents are found
        if ($documents) {
            // Prepare the response data
            $response = [];
            foreach ($documents as $doc) {
                $response[] = [
                    'document_name' => $doc['document_name'],
                    'is_present' => $doc['is_present']
                ];
            }
            // Send JSON response with document status
            echo json_encode(['status' => 'success', 'documents' => $response]);
        } else {
            // No documents found
            echo json_encode(['status' => 'error', 'message' => 'No documents found for this student.']);
        }
    } else {
        // Invalid student ID
        echo json_encode(['status' => 'error', 'message' => 'Invalid student ID.']);
    }
} else {
    // Not a GET request
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
