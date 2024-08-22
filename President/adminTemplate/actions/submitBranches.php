<?php
header('Content-Type: application/json'); // Ensure response is sent as JSON

require_once '../DAL/edit.class.php';

$userManagement = new UserManagement(); // Assuming UserManagement is the class containing the methods

// Get POST data
$facultyID = isset($_POST['id']) ? intval($_POST['id']) : 0;
$branches = isset($_POST['branches']) ? json_decode($_POST['branches'], true) : [];

// Ensure facultyID and branches are valid
if ($facultyID <= 0 || !is_array($branches)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data.']);
    exit;
}

try {
    // Clear existing branches for the faculty
    $userManagement->removeBranches($facultyID);

    // Insert new branches
    foreach ($branches as $branchID) {
        $userManagement->add_faculty_branch($facultyID, $branchID);
    }

    // Return success response
    echo json_encode(['status' => 'success', 'message' => 'Branches updated successfully.']);
} catch (Exception $e) {
    // Return error response
    echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
}
