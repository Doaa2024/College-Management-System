<?php
require_once('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    // Validate input
    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'Invalid input: ID not found']);
        exit;
    }

    try {
        $dataRetrieval = new UserManagement();
        $deleteSuccess = $dataRetrieval->deleteFA($id);
        if (!$deleteSuccess) {
            throw new Exception('Database delete failed');
        }

        // If deletion is successful, respond with success
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // Log the error and respond with the error message
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
