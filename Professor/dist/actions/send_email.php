<?php
// Include your database retrieval and other necessary files
require_once('../DAL/retrieve.class.php');

// Create an instance of the data retrieval class
$dataRetrieve = new UniversityDataRetrieval();

// Get course ID from query parameters
$courseID = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

// Fetch students from the course
$studentsInCourse = $dataRetrieve->getStudentsInCourse($courseID);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $sendToAll = isset($_POST['sendToAll']) && $_POST['sendToAll'] === 'true';
    $email = $_POST['email'] ?? '';

    // Determine recipients
    $recipients = $sendToAll ? array_column($studentsInCourse, 'Email') : [$email];

    // Function to send email
    function sendEmail($to, $subject, $message) {
        $headers = "From: no-reply@example.com\r\n";
        $headers .= "Reply-To: no-reply@example.com\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        return mail($to, $subject, $message, $headers);
    }

    $responses = [];
    foreach ($recipients as $recipient) {
        if (sendEmail($recipient, 'Course Notification', $message)) {
            $responses[] = ['status' => 'success', 'email' => $recipient];
        } else {
            $responses[] = ['status' => 'error', 'email' => $recipient];
        }
    }

    echo json_encode($responses);
    exit;
}
?>
