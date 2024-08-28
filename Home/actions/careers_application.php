<?php
require_once("../class/apply.class.php");
$apply = new Apply();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $position = $_POST['position_applied'];
    $comments = $_POST['comments'];
    $cover_letter = $_FILES['cover_letter'];
    $additional_files = $_FILES['additional_files'];
    $cv_path = $_FILES['cv_path'];

    echo '<pre>';
    print_r($_FILES['cv_path']);
    print_r($_FILES['cover_letter']);
    print_r($_FILES['additional_files']);
    echo '</pre>';


    $validExtensions = array("jpg", "jpeg", "png", "pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "txt", "csv", "zip", "rar");

    // Function to process each file upload
    function processFileUpload($file, $apply, $validExtensions)
    {
        $file_names = [];
        if (isset($file['name']) && is_array($file['name'])) {
            foreach ($file['name'] as $k => $value) {
                // Get file extension
                $extension = strtolower(pathinfo($file["name"][$k], PATHINFO_EXTENSION));

                // Check if the extension is valid
                if (in_array($extension, $validExtensions)) {
                    // Move the file
                    $file_name = $apply->movemultiplefiles($file, $k);
                    if ($file_name !== false) {
                        $file_names[] = $file_name;
                    } else {
                        echo '<p>Failed to move file: ' . $file["name"][$k] . '</p>';
                        return false;
                    }
                } else {
                    echo '<p>Invalid file extension: ' . $extension . '</p>';
                    return false;
                }
            }
            return implode(",", $file_names);
        } else {
            $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
            if (in_array($extension, $validExtensions)) {
                $file_name = $apply->movemultiplefiles($file, 0);
                return $file_name;
            } else {
                echo '<p>Invalid file extension: ' . $extension . '</p>';
                return false;
            }
        }
    }


    // Process each file
    $cv_file_name = processFileUpload($cv_path, $apply, $validExtensions);
    $cover_letter_file_name = processFileUpload($cover_letter, $apply, $validExtensions);

    // Check if additional files are provided before processing
    $additional_files_name = null;
    if (!empty($additional_files['name'][0])) {
        $additional_files_name = processFileUpload($additional_files, $apply, $validExtensions);
    }

    if ($cv_file_name && $cover_letter_file_name && ($additional_files_name !== false || $additional_files_name === null)) {
        // Insert into the database if all files are successfully uploaded
        $insertion = $apply->insertApplicationJob($position, $comments, $cv_file_name, $additional_files_name, $cover_letter_file_name);
        if ($insertion) {
            echo '<script>window.location.href="http://localhost/collegeMS/mosque-website-template/mosque-website-template/submission.php"</script>';
        } else {
            echo '<p>Database insertion failed.</p>';
        }
    } else {
        echo '<p>Upload not successful. Please check the file formats.</p>';
    }
}
