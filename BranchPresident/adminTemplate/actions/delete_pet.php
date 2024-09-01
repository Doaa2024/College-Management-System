<?php
require_once('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';

    // Validate input
    if (empty($id)) {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
        exit;
    }

    try {
        $dataRetrieval = new UserManagement();
        $deleteSuccess = $dataRetrieval->deletePetition($id);
        if (!$deleteSuccess) {
            throw new Exception('Database delete failed');
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        // Handle the error appropriately
        echo json_encode(['success' => false, 'message' => 'Database delete failed']);
        exit;
    }

    // Return response
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
