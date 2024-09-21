<?php
require('../DAL/edit.class.php');

if (isset($_POST['CourseCode']) && isset($_POST['CourseName']) && isset($_POST['CourseCredits']) && isset($_POST['AssessmentType']) && isset($_POST['Weight'])) {
    $CourseCode = $_POST['CourseCode'];
    $CourseName = $_POST['CourseName'];
    $CourseCredits = $_POST['CourseCredits'];
    $AssessmentTypes = $_POST['AssessmentType']; // Array of AssessmentTypes
    $Weights = $_POST['Weight']; // Array of Weights

    $userManagement = new UserManagement();

    // Check if CourseName or CourseCode already exists
    $result1 = $userManagement->getCourseNameCodeAdd($CourseName, $CourseCode);
    if ($result1) {
        echo json_encode(['status' => 'error', 'message' => 'Course Name or Code already exists! Please choose another one.']);
        exit;
    }

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

        // Check if the AssessmentType already exists for the course
        $result2 = $userManagement->checkAssessmentTypeExists($CourseCode, $AssessmentType);

        if ($result2[0]['AssessmentExists'] > 0) {
            echo json_encode(['status' => 'error', 'message' => "Assessment type '$AssessmentType' already exists for this course."]);
            exit;
        }

        // Add the current weight to the total weight
        $totalWeight += $Weight;

        // Check if total weight exceeds 100%
        if ($totalWeight > 100) {
            echo json_encode(['status' => 'error', 'message' => 'Total weight exceeds 100%!']);
            exit;
        }
    }

    // If all checks pass, proceed to add the course and grade structures
    $courseId = $userManagement->add_course($CourseName, $CourseCode, $CourseCredits);

    if ($courseId > 0) {
        // Add each grade structure for the course
        foreach ($AssessmentTypes as $index => $AssessmentType) {
            $Weight = $Weights[$index]; // Get corresponding weight
            $userManagement->addGradeStructure($CourseCode, $AssessmentType, $Weight);
        }

        echo json_encode(['status' => 'success', 'message' => 'Course and Grade structure added successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add course']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
