<?php

require('../DAL/edit.class.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $applicationId = $_POST['id'];
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $branch = $_POST['branch'];
    $username = $_POST['username'];
    $email = $username + "@gmail.dau.edu.lb";
    $role = "Student";
    $password = "wcdc";
    $userManagement = new UserManagement();
    $result = $userManagement->register_student($username, $email, $role, $branchID, $facultyID, $departmentID, $password);
    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Student is registered successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to register student']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
