<?php
session_start();
require_once('../DAL/edit.class.php');
$dataRetrieval = new UserManagement();

// Set the content type to JSON to return a response to AJAX
header('Content-Type: application/json');

// Initialize the response array
$response = [];

// Read the raw input


// Extract data
$newsletterType = isset($_POST['newsletterType']) ? trim($_POST['newsletterType']) : null;
$title = isset($_POST['title']) ? trim($_POST['title']) : null;
$issueDate = isset($_POST['issueDate']) ? trim($_POST['issueDate']) : null;
$content = isset($_POST['content']) ? trim($_POST['content']) : null;
$createdBy = isset($_SESSION['userID']) ? $_SESSION['userID'] : '';



// Validate the input data
$dump = $newsletterType;
if (!$newsletterType || !in_array($newsletterType, ['obligatory', 'optional'])) {
    $response['success'] = false;
    $response['message'] = "$dump";
    echo json_encode($response);
    exit;
}
if (!$title || strlen($title) < 3) {
    $response['success'] = false;
    $response['message'] = "Title is required and must be at least 3 characters long.";
    echo json_encode($response);
    exit;
}

if (!$issueDate || !validateDate($issueDate)) {
    $response['success'] = false;
    $response['message'] = "Invalid issue date.";
    echo json_encode($response);
    exit;
}

if (!$content || strlen($content) < 5) {
    $response['success'] = false;
    $response['message'] = "Content is required and must be at least 10 characters long.";
    echo json_encode($response);
    exit;
}




try {
    // Choose the correct table based on newsletter type and call the corresponding function
    if ($newsletterType === 'obligatory') {
        // Insert into obligatorynewsletter table
        $dataRetrieval->insertObligatoryNewsletter($title, $issueDate, $content, $createdBy);
    } elseif ($newsletterType === 'optional') {
        // Insert into optionalnewsletter table
        $dataRetrieval->insertOptionalNewsletter($title, $issueDate, $content, $createdBy);
    }

    // If everything is successful
    $response['success'] = true;
    $response['message'] = "Newsletter created successfully!";
} catch (Exception $e) {
    // If any error occurs
    $response['success'] = false;
    $response['message'] = "Error: " . $e->getMessage();
}

// Return the response in JSON format
echo json_encode($response);
exit;

// Function to validate date format
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}
