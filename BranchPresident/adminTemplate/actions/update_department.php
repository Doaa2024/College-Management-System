<?php
require_once('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $departmentID = intval($_POST['departmentID']);
    $departmentName = $_POST['departmentName'];
    $facultyID = intval($_POST['facultyID']);

    try {
        $dataRetrieval = new UserManagement();
        $updateSuccess = $dataRetrieval->updateDepartment($departmentID, $departmentName, $facultyID);

        if ($updateSuccess) {
            echo json_encode(['success' => true]);
        } else {
            throw new Exception('Database update failed');
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
