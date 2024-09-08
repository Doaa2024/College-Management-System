<?php
$host = 'localhost'; // Replace with your MySQL host
$db = 'university_db'; // Replace with your database name
$user = 'root'; // Replace with your MySQL username
$pass = ''; // Replace with your MySQL password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve action and data
$action = $_POST['action'];
$response = ['status' => 'success'];

if ($action === 'add') {
    $task = $_POST['task'];
    $createdAt = date('Y-m-d H:i:s'); // Set current timestamp for CreatedAt
    $stmt = $conn->prepare("INSERT INTO todos (task, completed, CreatedAt) VALUES (?, 0, ?)");
    $stmt->bind_param("ss", $task, $createdAt);
    if ($stmt->execute()) {
        // Retrieve the ID of the newly inserted task
        $new_id = $stmt->insert_id;
        $response['id'] = $new_id;
        $response['createdAt'] = $createdAt; // Return the created date to the frontend
    } else {
        $response = ['status' => 'error', 'message' => 'Failed to add task'];
    }
    $stmt->close();
} elseif ($action === 'delete') {
    $id = $_POST['id'];
    error_log("Attempting to delete item with ID: $id");
    $stmt = $conn->prepare("DELETE FROM todos WHERE id = ?");
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        $response = ['status' => 'error', 'message' => 'Failed to delete task'];
    }
    $stmt->close();
} elseif ($action === 'update') {
    $id = $_POST['id'];
    $completed = isset($_POST['completed']) ? $_POST['completed'] : null;
    $task = isset($_POST['task']) ? $_POST['task'] : null;
    error_log("Attempting to update item with ID: $id, completed: $completed, task: $task");

    if ($completed !== null) {
        // If the task is being marked as completed, update CompletedAt
        if ($completed == 1) {
            $completedAt = date('Y-m-d H:i:s');
            $stmt = $conn->prepare("UPDATE todos SET completed = ?, CompletedAt = ? WHERE id = ?");
            $stmt->bind_param("isi", $completed, $completedAt, $id);
            $response['completedAt'] = $completedAt; // Send back the completed date
        } else {
            // If the task is being marked as incomplete, remove CompletedAt
            $stmt = $conn->prepare("UPDATE todos SET completed = ?, CompletedAt = NULL WHERE id = ?");
            $stmt->bind_param("ii", $completed, $id);
            $response['completedAt'] = null; // No completed date if task is incomplete
        }
    } elseif ($task !== null) {
        $stmt = $conn->prepare("UPDATE todos SET task = ? WHERE id = ?");
        $stmt->bind_param("si", $task, $id);
    }
    if (!$stmt->execute()) {
        $response = ['status' => 'error', 'message' => 'Failed to update task'];
    }
    $stmt->close();
} elseif ($action === 'get') {
    $result = $conn->query("SELECT id, task, completed, CreatedAt, CompletedAt FROM todos");
    $todos = [];
    while ($row = $result->fetch_assoc()) {
        $todos[] = $row;
    }
    echo json_encode($todos);
    exit;
}

$conn->close();
echo json_encode($response);
