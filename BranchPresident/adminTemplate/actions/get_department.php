<?php
require_once('../DAL/retrieve.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $departmentID = intval($_POST['departmentID']);

    try {
        $dataRetrieval = new UniversityDataRetrieval();

        $department = $dataRetrieval->getDepartment($departmentID);

        if ($department) {
            echo json_encode(['success' => true, 'data' => $department[0]]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Department not found']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
