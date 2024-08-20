<?php

require('../DAL/edit.class.php');
$edit = new UserManagement();

if (!isset($_POST['facultyID']) || !isset($_POST['branches'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
    exit;
}

$facultyID = $_POST['facultyID'];
$branches = $_POST['branches'];

try {
    // Clear existing branches first
    $edit->clearFacultyBranches($facultyID);

    // Update with new branches
    foreach ($branches as $branchID) {
        $edit->updateFacultyBranch($facultyID, $branchID);
    }
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Log error to a file
    header('Content-Type: application/json');
    error_log($e->getMessage(), 3, '../faculty.php');

    // Send generic message to the client
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.']);
}
