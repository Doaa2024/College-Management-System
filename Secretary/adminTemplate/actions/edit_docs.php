<?php
require_once('../DAL/edit.class.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create an instance of the data retrieval class
    $dataFetch = new UserManagement();

    // Retrieve POST data
    $studentID = $_POST['studentID'];
    $checkedDocuments = isset($_POST['documents']) ? $_POST['documents'] : [];

    // Get existing documents
    $existingDocuments = $dataFetch->getDocumentsByStudentID($studentID);
    $existingDocumentsArray = array_column($existingDocuments, 'document_name');

    // Determine documents to be inserted or updated
    $documentsToInsertOrUpdate = array_unique($checkedDocuments);

    // Determine documents to be deleted or marked as not present
    $documentsToDeleteOrUpdate = array_diff($existingDocumentsArray, $documentsToInsertOrUpdate);

    $changesMade = false;

    // Insert or update new documents
    foreach ($documentsToInsertOrUpdate as $document) {
        if (!in_array($document, $existingDocumentsArray)) {
            $dataFetch->insertOrUpdateDocument($studentID, $document);
            $changesMade = true;
        } else {
            // Optionally, you might want to update the document status to 'present' here if you have such logic.
            $dataFetch->updateDocumentStatus($studentID, $document, 1);
        }
    }

    // Delete or mark as not present for missing documents
    if (!empty($documentsToDeleteOrUpdate)) {
        foreach ($documentsToDeleteOrUpdate as $document) {
            $dataFetch->updateDocumentStatus($studentID, $document, 0); // 0 indicates not present
        }
        $changesMade = true;
    }

    // Send JSON response
    if ($changesMade) {
        echo json_encode(['status' => 'success', 'message' => 'Student documents updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No changes were made.']);
    }
} else {
    // Not a POST request
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
