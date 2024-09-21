<?php

require('../DAL/edit.class.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $applicationId = $_POST['id'];
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $branch = $_POST['branch'];
    $username = trim($_POST['username']);
    $userManagement = new UserManagement();

    $facultyID  = $userManagement->getFacultyByID($faculty);
    $departmentID  = $userManagement->getDepartmentByID($department);
    $branchID  = $userManagement->getBranchByID($branch);

    $last_id  = $userManagement->maxID();
    $email = ($last_id[0]['last_id'] + 1) . "@gmail.dau.edu.student.lb";

    function generateRandomPassword($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomPassword = '';
        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomPassword;
    }

    $password = generateRandomPassword(8);
    $role = "Student";
    $status = "Approved";

    // Check for unique username
    $checkResult = $userManagement->checkUserName($username);
    if (!empty($checkResult)) {
        // Username exists, generate a new unique username
        $baseUsername = $username;
        $counter = 1;
        do {
            $newUsername = $baseUsername . $counter;
            $checkResult = $userManagement->checkUserName($newUsername);
            $counter++;
        } while (!empty($checkResult));

        $username = $newUsername; // Use the unique username
    }

    // Now proceed with registration
    $result = $userManagement->register_student($username, $email, $role, $branchID[0]['BranchID'], $facultyID[0]['FacultyID'], $departmentID[0]['DepartmentID'], $password);
    if ($result) {
        $result = $userManagement->updateStudentApplicationStatus($applicationId);
        echo json_encode(['status' => 'success', 'message' => 'Student is registered successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to register student']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
