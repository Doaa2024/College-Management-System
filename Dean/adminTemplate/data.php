<?php
header('Content-Type: application/json');

// Database connection
$host = 'localhost';
$db = 'university_db';
$user = 'root';
$pass = '';
$departmentID = ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['dept_id'])) ? $_GET['dept_id'] : 9;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Decode incoming JSON request
        $data = json_decode(file_get_contents('php://input'), true);
        // Check if departmentID is provided

        // Handle course (task) update request
        if (isset($data['id']) && isset($data['start_date']) && isset($data['end_date']) && isset($data['semester']) && isset($data['year'])) {
            $courseID = $data['id'];
            $semester = $data['semester'];
            $year = $data['year'];

            // Update the course's semester and year in the database
            $sql = "
                UPDATE courses
                SET semester = :semester, year = :year
                WHERE CourseID = :courseID
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'semester' => $semester,
                'year' => $year,
                'courseID' => $courseID
            ]);

            echo json_encode(['status' => 'success']);
        }
        // Handle link (prerequisite) insertion request
        elseif (isset($data['action']) && $data['action'] === 'addLink' && isset($data['source']) && isset($data['target'])) {
            $source = $data['source']; // PrerequisiteCourseID
            $target = $data['target']; // CourseID

            // Insert the link into the courseprerequisites table
            $sql = "
                INSERT INTO courseprerequisites (PrerequisiteCourseID, CourseID)
                VALUES (:source, :target)
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'source' => $source,
                'target' => $target
            ]);

            echo json_encode(['status' => 'success']);
        }
        // Handle link (prerequisite) deletion request
        elseif (isset($data['action']) && $data['action'] === 'deleteLink' && isset($data['source']) && isset($data['target'])) {
            $source = $data['source']; // PrerequisiteCourseID
            $target = $data['target']; // CourseID

            // Delete the link from the courseprerequisites table
            $sql = "
                DELETE FROM courseprerequisites 
                WHERE PrerequisiteCourseID = :source AND CourseID = :target
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'source' => $source,
                'target' => $target
            ]);

            if ($stmt->rowCount() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Link deleted']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Link not found']);
            }
        }
    } else {


        // Fetch courses for the department
        $sql = "
            SELECT c.CourseID, c.CourseName, c.CourseCode, c.DepartmentID, c.Credits, c.semester, c.year
            FROM courses c
            WHERE FIND_IN_SET(:departmentID, REPLACE(c.DepartmentID, '/', ',')) > 0
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['departmentID' => $departmentID]);

        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Convert courses to Gantt chart format
        $tasks = [];
        foreach ($courses as $course) {
            $year = intval($course['year']) + 2020 - 1; // Convert to calendar year
            $semesterStart = ($course['semester'] === 'Fall') ? '01-01' : '07-01'; // Fall starts in January, Spring in July
            $startDate = "{$year}-{$semesterStart}";
            $endDate = date('Y-m-d', strtotime("+6 months", strtotime($startDate))); // End date is 6 months later

            $tasks[] = [
                'id' => $course['CourseID'],
                'text' => $course['CourseName'],
                'start_date' => $startDate,
                'end_date' => $endDate,
                'progress' => 0,
                'parent' => 0
            ];
        }

        // Fetch prerequisites (links) data
        $sql = "
           SELECT cp.PrerequisiteCourseID AS source, cp.CourseID AS target
            FROM courseprerequisites cp
            JOIN courses c1 ON c1.CourseID = cp.CourseID
            JOIN courses c2 ON c2.CourseID = cp.PrerequisiteCourseID
            WHERE FIND_IN_SET($departmentID, REPLACE(c1.DepartmentID, '/', ',')) > 0
            AND FIND_IN_SET($departmentID, REPLACE(c2.DepartmentID, '/', ',')) > 0

        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $prerequisites = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Format prerequisites for Gantt chart
        $links = [];
        foreach ($prerequisites as $prerequisite) {
            $links[] = [
                'id' => uniqid(), // Unique ID for the link
                'source' => $prerequisite['source'],
                'target' => $prerequisite['target'],
                'type' => '0' // Type can be adjusted as needed (e.g., '0' for finish-to-start)
            ];
        }

        // Return tasks and links as JSON
        $response = [
            "data" => $tasks,
            "links" => $links
        ];

        echo json_encode($response);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
