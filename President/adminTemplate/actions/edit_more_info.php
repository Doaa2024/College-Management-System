<?php
require_once('../DAL/edit.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $name = $_POST['name'];
    $welcomeStatement = $_POST['welcomeStatement'];
    $phoneNumber = $_POST['phoneNumber'];
    $instagram = $_POST['instagram'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $linkedin = $_POST['linkedin'];
    $email = $_POST['email'];
    $location = $_POST['location'];

    // Create an instance of the UserManagement class
    $dataFetch = new UserManagement();

    // Call the update function
    $result = $dataFetch->updateMoreInfo($name, $welcomeStatement, $phoneNumber, $instagram, $facebook, $twitter, $linkedin, $email, $location);

    // Send JSON response
    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Record updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update record.']);
    }
} else {
    // Not a POST request
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
