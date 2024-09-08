<?php
require_once("../DAL/edit.class.php");

$dataRetrieve = new UserManagement();
$courseID = $_POST['course_id'];

try {
    $exams = $dataRetrieve->getPreviousExams($courseID);
    
    if ($exams) {
        $output = '<div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Exam File</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>';
        foreach ($exams as $exam) {
            $output .= '<tr>
                            <td><a href="dataClient/PreviousExams/' . $exam['previousExamPath'] . '" target="_blank">' . basename($exam['previousExamPath']) . '</a></td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-exam-btn" data-exam-id="' . $exam['id'] . '"  data-exam-path="' . $exam['previousExamPath'] . '" >Delete</button>
                            </td>
                        </tr>';
        }
        $output .= '   </tbody>
                    </table>
                </div>';
        echo json_encode(['status' => 'success', 'output' => $output]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No exams found for this course.']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
}
?>
