<?php
require('dal.class.php');

class UserManagement extends DAL
{

    public function insertEvaluation($courseID, $studentID, $professorID, $rating, $comments) {
        $sql = "INSERT INTO evaluations (CourseID, StudentID, ProfessorID, EvaluationDate, Rating, Comments)
                VALUES (?, ?, ?, CURDATE(), ?, ?)";
        
        $params = [$courseID, $studentID, $professorID, $rating, $comments];
        
        return $this->execute($sql, $params);   $sql = "INSERT INTO requests(student_id, faculty_id, request_type, file_path, comments) VALUES (?, ?, ?, ?, ?)";
        $params = [$studentID, $facultyID, $requestType, $filePathsStr, $comments];
    }
    

    public function insertStudentRequest($studentID, $facultyID, $requestType, $filePathsStr, $comments) {
        $sql = "INSERT INTO requests(student_id, faculty_id, request_type, file_path, comments) VALUES (?, ?, ?, ?, ?)";
        
        $params = [$studentID, $facultyID, $requestType, $filePathsStr, $comments];
        
        return $this->execute($sql, $params); 
        
    }
    function registerCourse($userID, $courseID, $timeTableID) {
        $sql = "INSERT INTO enrollments (UserID, CourseID, TimeTableID, Role) VALUES (?, ?, ?, 'Student')";
        $params = [$userID, $courseID, $timeTableID];

           return $this->execute($sql, $params);
    }
    
}
