<?php
require('../DAL/edit.class.php');

if (isset($_POST['AssessmentType']) && isset($_POST['Weight']) && isset($_POST['courseId'])) {
    $CourseID = $_POST['courseId']; // Assuming CourseCode is passed from the form
    $AssessmentTypes = $_POST['AssessmentType']; // Array of AssessmentTypes
    $Weights = $_POST['Weight']; // Array of Weights

    $userManagement = new UserManagement();

    // Check for duplicate assessment types in the request
    if (count($AssessmentTypes) !== count(array_unique($AssessmentTypes))) {
        echo json_encode(['status' => 'error', 'message' => 'Duplicate assessment types are not allowed.']);
        exit;
    }

    // Initialize total weight to 0 for validation
    $totalWeight = 0;

    // Loop through the grade structure inputs
    foreach ($AssessmentTypes as $index => $AssessmentType) {
        $Weight = $Weights[$index]; // Get corresponding weight

        // Add the current weight to the total weight
        $totalWeight += $Weight;

        // Check if total weight exceeds 100%
        if ($totalWeight > 100) {
            echo json_encode(['status' => 'error', 'message' => 'Total weight exceeds 100%!']);
            exit;
        }
    }

    // Delete any existing grade structure related to the CourseCode
    $userManagement->deleteGradeStructureByCourseCode($CourseID);

    // If all checks pass, proceed to add the grade structures
    foreach ($AssessmentTypes as $index => $AssessmentType) {
        $Weight = $Weights[$index]; // Get corresponding weight

        // Insert the new grade structure
        $userManagement->addNewGradeStructure($CourseID, $AssessmentType, $Weight);
    }

    echo json_encode(['status' => 'success', 'message' => 'Grade structure updated successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid inputs']);
}
