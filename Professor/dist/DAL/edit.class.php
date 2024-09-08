<?php
require('dal.class.php');

class UserManagement extends DAL
{

    public function getGCRLink($courseID)
    {
        $sql = "SELECT GCRLink FROM courses WHERE CourseID = ?";
        return $this->getdata($sql, [$courseID]);
    }

    public function saveGCRLink($courseID, $gcrLink)
    {
        $sql = "UPDATE courses SET GCRLink = ? WHERE CourseID = ?";
        return $this->execute($sql, [$gcrLink, $courseID]);
    }

    public function getPreviousExams($courseID)
    {
        $sql = "SELECT id, previousExamPath FROM previousexams WHERE CourseID = ?";
        return $this->getdata($sql, [$courseID]);
    }

    public function deleteExam($examID)
    {
        $sql = "DELETE FROM previousexams WHERE id = ?";
        return $this->execute($sql, [$examID]);
    }
    public function saveExam($courseID, $examPath)
    {
        $sql = "INSERT INTO previousexams (courseID, previousExamPath) VALUES (?, ?)";
        $params = [$courseID, $examPath];
        return $this->execute($sql, $params);
    }
    public function updateOfficeHours($officeHourID, $dayOfWeek, $startTime, $endTime)
    {


        $sql = "UPDATE office_hours SET DayOfWeek = ?, StartTime = ?, EndTime = ? WHERE OfficeHourID = ?";

        $params = [$dayOfWeek, $startTime, $endTime, $officeHourID];

        return $this->execute($sql, $params);
    }
    public function deleteOfficeHour($officeHourID)
    {
        $sql = "DELETE FROM office_hours WHERE OfficeHourID = ?";
        $params = [$officeHourID];
        return $this->execute($sql, $params);
    }
    public function addOfficeHour($professorID, $dayOfWeek, $startTime, $endTime)
    {
        // Assuming you have a database connection stored in $this->db
        $sql = "INSERT INTO office_hours (UserID, DayOfWeek, StartTime, EndTime) VALUES (?, ?, ?, ?)";
        $param = [$professorID, $dayOfWeek, $startTime, $endTime];

        return $this->execute($sql, $param);
    }
    public function submitAttendance($enrollmentID, $date, $status)
    {
        $sql = "INSERT INTO attendance (EnrollmentID, Date, Status) VALUES (?, ?, ?)";
        return $this->execute($sql, [$enrollmentID, $date, $status]);
    }
    public function RegisterCourse($courseID, $professorID)
    {
        $sql = "INSERT INTO enrollments (CourseID, UserID, Role) VALUES (?, ?, 'Professor')";
        $params = [$courseID, $professorID];
        return $this->execute($sql, $params);
    }
    public function UpdateTimetable($courseID, $professorID, $time)
    {
        $sql = "
            UPDATE timetables 
            SET ProfessorID = ? 
            WHERE CourseID = ? 
            AND time = ? 
          
            AND ProfessorID IS NULL
        ";
        $params = [$professorID, $courseID, $time];
        return $this->execute($sql, $params);
    }


    // Add a new enrollment record
    public function AddEnrollment($userID, $courseID, $role, $semester, $year)
    {
        $sql = "
        INSERT INTO enrollments (UserID, CourseID, Role, Semester, Year)
        VALUES (?, ?, ?, ?, ?)
    ";
        $params = [$userID, $courseID, $role, $semester, $year];
        return $this->execute($sql, $params);
    }
}
