<?php
require_once('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $departmentName = $_POST['departmentName'];
    $facultyID = intval($_POST['facultyID']);
    $branchID = intval($_POST['branchID']);

    // Validate inputs
    if (empty($departmentName) || empty($facultyID) || empty($branchID)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }

    try {
        $dataInsertion = new UserManagement();
        $insertSuccess = $dataInsertion->addDepartment($departmentName, $facultyID, $branchID);

        if (!$insertSuccess) {
            throw new Exception('Failed to insert department');
        }

        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
