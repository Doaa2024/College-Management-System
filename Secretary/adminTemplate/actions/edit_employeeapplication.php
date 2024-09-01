<?php
require_once('../DAL/edit.class.php');

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userManagement = new UserManagement();
    $reviewedBy = $_POST['reviewedBy'];
    $reviewedAt = $_POST['reviewedAt'];
    $status = $_POST['status'];
    $id = $_POST['record_id'];

    if ($status === 'Approved') {
        $chosen_school = $_POST['chosen_school'];
        $campus = $_POST['campus'];
        $role = $_POST['role'];
        $username = $_POST['username'];

        $last_id = $userManagement->maxID();
        $email = ($last_id[0]['last_id'] + 1) . "@gmail.dau.edu.employee.lb";

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
        $result2 = $userManagement->register_employee($username, $email, $role, $campus, $chosen_school, $password);
    }

    $result = $userManagement->updateProfessorApplication($reviewedBy, $reviewedAt, $status, $id);
    $result1 = $userManagement->searchEmployeeApplicationByIDAgain($id);

    if ($result) {
        $response['success'] = true;
        $response['data'] = $result1[0];
        $response['message'] = 'Record Updated Successfully!';
    } else {
        $response['message'] = 'Failed to update record.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

header('Content-Type: application/json');
echo json_encode($response);
