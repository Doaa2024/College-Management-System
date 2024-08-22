<?php
require('../DAL/retrieve.class.php');

$dal = new UniversityDataRetrieval();
try {
    $allBranches = $dal->getAllBranches();
    header('Content-Type: application/json');
    echo json_encode($allBranches);
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([]);
}
