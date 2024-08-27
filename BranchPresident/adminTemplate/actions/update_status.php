<?php
require_once('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = $_POST['id'] ?? '';
    $newStatus = $_POST['newStatus'] ?? '';

    // Validate inputs
    if (empty($studentId) || empty($newStatus)) {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
        exit;
    }

    try {
        // Create an instance of the UserManagement class
        $dataRetrieval = new UserManagement();

        // Call the method to update the status
        $updateSuccess = $dataRetrieval->updateAttestationStatus($newStatus, $studentId);

        if (!$updateSuccess) {
            throw new Exception('Database update failed');
        }

        // Return success response
        echo json_encode(['success' => true]);

    } catch (Exception $e) {
        error_log($e->getMessage());
        // Return error response
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
