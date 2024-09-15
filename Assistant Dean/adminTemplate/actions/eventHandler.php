
<?php
session_start();
// Include database configuration file  
require('../DAL/edit.class.php');
// Retrieve JSON from POST body 
$jsonStr = file_get_contents('php://input');
$jsonObj = json_decode($jsonStr);
$userManagement = new UserManagement();
if ($jsonObj->request_type == 'addEvent' && isset($_SESSION['userID'])) {
    $start = $jsonObj->start;
    $end = $jsonObj->end;
    // Initialize variables
    $startTime = '';
    $endTime = '';
    $event_date = '';
    $event_end = '';

    // Helper function to format date and time
    function formatDate($date, $defaultStartTime, $defaultEndTime)
    {
        // Check if date includes a time (indicated by 'T')
        if (strpos($date, 'T') !== false) {
            $datetime = new DateTime($date);
            $formattedDate = $datetime->format('Y-m-d');
            $time = $datetime->format('H:i:s');

            return [
                'date' => $formattedDate,
                'startTime' => $time,
                'endTime' => $time
            ];
        } else {
            // Assume date is in 'Y-m-d' format and assign default times
            return [
                'date' => $date,
                'startTime' => $defaultStartTime,
                'endTime' => $defaultEndTime
            ];
        }
    }

    // Set default times
    $defaultStartTime = '08:00:00';
    $defaultEndTime = '8:00:00';

    // Process start date
    $startDetails = formatDate($start, $defaultStartTime, $defaultEndTime);
    $event_date = $startDetails['date'];
    $startTime = $startDetails['startTime'];

    // Process end date
    $endDetails = formatDate($end, $defaultStartTime, $defaultEndTime);
    $event_end = $endDetails['date'];
    $endTime = $endDetails['endTime'];
    $event_data = $jsonObj->event_data;
    $eventTitle = !empty($event_data[0]) ? $event_data[0] : '';
    $eventDesc = !empty($event_data[1]) ? $event_data[1] : '';
    $eventLocation = !empty($event_data[2]) ? $event_data[2] : '';
    $createdBy = $_SESSION['userID'];
    if (!empty($eventTitle) && !empty($eventLocation) && !empty($eventDesc)) {
        // Insert event data into the database 
        $insert = $userManagement->add_event($eventTitle, $eventDesc, $eventLocation, $startTime, $endTime, $event_date, $event_end, $createdBy);
        if ($insert) {
            $output = [
                'status' => 1
            ];
            echo json_encode($output);
        } else {
            echo json_encode(['error' => 'Event Add request failed!']);
        }
    } else {
        echo json_encode(['error' => 'All fields  are required!']);
    }
} elseif ($jsonObj->request_type == 'editEvent') {
    $start = $jsonObj->start;
    $end = $jsonObj->end;
    $event_id = $jsonObj->event_id;

    $event_data = $jsonObj->event_data;
    $eventTitle = !empty($event_data[0]) ? $event_data[0] : '';
    $eventDesc = !empty($event_data[1]) ? $event_data[1] : '';
    $eventLocation = !empty($event_data[2]) ? $event_data[2] : '';
    $date1 = !empty($event_data[0]) ? $event_data[3] : '';
    $date2 = !empty($event_data[1]) ? $event_data[4] : '';
    $time1 = !empty($event_data[2]) ? $event_data[5] : '';
    $time2 = !empty($event_data[0]) ? $event_data[6] : ''; 
    if (!empty($eventTitle)) {  
        // Update event data into the database 
        $update = $userManagement->update_event($eventTitle, $eventDesc, $eventLocation, $date1, $date2, $time1, $time2, $event_id);

        if ($update) {
            $output = [
                'status' => 1
            ];
            echo json_encode($output);
        } else {
            echo json_encode(['error' => 'Event Update request failed!']);
        }
    }
} elseif ($jsonObj->request_type == 'deleteEvent') {
    $id = $jsonObj->event_id;
    $delete = $userManagement->delete_event($id);
    if ($delete) {
        $output = [
            'status' => 1
        ];
        echo json_encode($output);
    } else {
        echo json_encode(['error' => 'Event Delete request failed!']);
    }
}
