<?php
session_start();
require_once('../DAL/edit.class.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the request method is POST and user is logged in
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['userID'])) {
    // Retrieve POST data
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $id = $_SESSION['userID'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo json_encode(['status' => 'error', 'message' => 'Passwords do not match.']);
        exit;
    }

    // Hash the password before saving to the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Create an instance of the UserManagement class
    $dataFetch = new UserManagement();

    // Call the update password function
    $result = $dataFetch->updateUserPassword($id, $hashedPassword);

    // Send JSON response
    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Password updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update password.']);
    }
} else {
    // Handle invalid request method or user not logged in
    echo json_encode(['status' => 'error', 'message' => 'Invalid request or user not logged in.']);
}
