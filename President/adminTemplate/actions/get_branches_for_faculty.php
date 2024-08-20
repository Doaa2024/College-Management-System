<?php
require('../DAL/retrieve.class.php');
// Check if facultyID is provided
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['facultyID'])) {
    echo json_encode([]);
    exit;
}

$facultyID = $_GET['facultyID'];

// Create a new DAL instance
$dal = new UniversityDataRetrieval();

try {
    $branches = $dal->getBranchesForFaculty($facultyID);
    echo json_encode($branches);
} catch (Exception $e) {
    echo json_encode([]);
}
