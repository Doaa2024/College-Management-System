<?php

require_once('../DAL/edit.class.php');
$dataRetrieve = new UserManagement(); // Assuming UserManagement contains the movemultiplefiles method

// Check if files are uploaded
if (isset($_FILES['examFile']) && isset($_POST['course_id'])) {
    $courseID = $_POST['course_id']; // Correctly retrieve courseID
    $files = $_FILES['examFile']; // Access the files array

    $response = [];

    // Check if files array is properly structured
    if (is_array($files['name'])) {
        // Iterate through all uploaded files
        for ($i = 0; $i < count($files['name']); $i++) {
            // Check if the file has no upload error
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                $filePath = $dataRetrieve->movemultiplefiles($files, $i);

                if ($filePath !== false) {
                    // If the file was successfully moved, save the file path to the database
                    try {
                        $result = $dataRetrieve->saveExam($courseID, $filePath);

                        if ($result) {
                            $response[] = ['status' => 'success', 'message' => 'File uploaded and saved successfully.', 'file' => $filePath];
                        } else {
                            $response[] = ['status' => 'error', 'message' => 'Failed to save file path in the database.', 'file' => $filePath];
                        }
                    } catch (Exception $e) {
                        $response[] = ['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage(), 'file' => $filePath];
                    }
                } else {
                    $response[] = ['status' => 'error', 'message' => 'Failed to move file: ' . $files['name'][$i], 'file' => $files['name'][$i]];
                }
            } else {
                $response[] = ['status' => 'error', 'message' => 'Upload error for file: ' . $files['name'][$i], 'file' => $files['name'][$i]];
            }
        }
    } else {
        $response[] = ['status' => 'error', 'message' => 'Invalid files array structure.'];
    }

    // Return JSON response
    echo json_encode($response);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No files uploaded or missing course ID.']);
}
