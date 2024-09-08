<?php
require('dal.class.php');

class UniversityDataRetrieval extends DAL
{

    public function getAllStudents()
    {
        $sql = "SELECT * FROM users WHERE Role = 'Student' AND Status = 'Active'";
        return $this->getdata($sql, []);
    }
    public function getTotalStudents($professorID)
    {
        $sql = "
        SELECT COUNT(DISTINCT e.UserID) as total_students
        FROM enrollments e
        JOIN users u ON e.UserID = u.UserID
        WHERE e.Role = 'Student' AND e.CourseID IN (
            SELECT CourseID FROM enrollments WHERE UserID = ? AND Role = 'Professor'
        )";
        $params = [$professorID];
        return $this->getdata($sql, $params);
    }

    public function getAvgGpa($professorID)
    {
        $sql = "
        SELECT AVG(sg.gpa) as avg_gpa
        FROM student_gpa sg
        JOIN enrollments e ON sg.student_id = e.UserID
        WHERE e.CourseID IN (
            SELECT CourseID FROM enrollments WHERE UserID = ? AND Role = 'Professor'
        )";
        $params = [$professorID];
        return $this->getdata($sql, $params);
    }

    public function getGradeDistribution($professorID)
    {
        $sql = "
        SELECT g.Grade, COUNT(*) as count
        FROM grades g
        JOIN enrollments e ON g.EnrollmentID = e.EnrollmentID
        WHERE e.CourseID IN (
            SELECT CourseID FROM enrollments WHERE UserID = ? AND Role = 'Professor'
        )
        GROUP BY g.Grade
        ORDER BY g.Grade DESC";
        $params = [$professorID];
        return $this->getdata($sql, $params);
    }

    public function getAttendanceStatus($professorID)
    {
        $sql = "
        SELECT a.Status, COUNT(*) as count
        FROM attendance a
        JOIN enrollments e ON a.EnrollmentID = e.EnrollmentID
        WHERE e.CourseID IN (
            SELECT CourseID FROM enrollments WHERE UserID = ? AND Role = 'Professor'
        )
        GROUP BY a.Status";
        $params = [$professorID];
        return $this->getdata($sql, $params);
    }

    public function getCoursesTaught($professorID)
    {
        $sql = "
        SELECT COUNT(DISTINCT CourseID) as courses_taught
        FROM enrollments
        WHERE UserID = ? AND Role = 'Professor'";
        $params = [$professorID];
        return $this->getdata($sql, $params);
    }

    public function MyRating($professorID)
    {
        $sql = "SELECT AVG(Rating) as avg_rating
            FROM evaluations
            WHERE ProfessorID = ?;";
        $params = [$professorID];
        return $this->getdata($sql, $params);
    }
    public function getOfficeHours($professorId)
    {
        $sql = "SELECT * FROM office_hours WHERE UserID = ?";
        $params = [$professorId];
        return $this->getdata($sql, $params);
    }

    public function getRegisteredCourses($professorId)
    {
        $sql = "SELECT c.CourseID, c.CourseName, c.CourseCode, c.Credits,c.GCRLink,
                   d.DepartmentName, f.FaculityName
            FROM enrollments e
            JOIN courses c ON e.CourseID = c.CourseID
           
            JOIN departments d ON c.DepartmentID = d.DepartmentID
            JOIN faculties f ON d.FacultyID = f.FacultyID
          
            WHERE e.UserID = ? AND e.Role = 'Professor'";
        $params = [$professorId];
        return $this->getdata($sql, $params);
    }

    public function getStudentsInCourse($courseId)
    {
        $sql = "SELECT DISTINCT(e.EnrollmentID),u.UserID, u.Email, u.Username
            FROM enrollments e
             JOIN users u ON e.UserID = u.UserID
            WHERE e.CourseID = ? AND e.Role = 'Student'";
        $params = [$courseId];
        return $this->getdata($sql, $params);
    }


    public function getProfessorSchedule($professorId)
    {
        $sql = "SELECT c.CourseName, t.DayOfWeek, t.time, r.RoomName
            FROM timetables t
            JOIN courses c ON t.CourseID = c.CourseID
            JOIN rooms r ON t.RoomID = r.RoomID
            WHERE t.ProfessorID = ?
            ORDER BY FIELD(t.DayOfWeek, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
        $params = [$professorId];
        return $this->getdata($sql, $params);
    }


    public function getProfessorSalary($professorId)
    {
        $sql = "SELECT COALESCE(SUM(c.Credits * f.CreditFee), 0) AS Salary
                FROM enrollments e
                INNER JOIN courses c ON e.CourseID = c.CourseID
                INNER JOIN faculties f ON c.DepartmentID = f.FacultyID
                WHERE e.UserID = ? AND e.Role = 'Professor'";
        $params = [$professorId];

        return $this->getdata($sql, $params);
    }

    public function getAvailableCoursesForRegistration()
    {
        // Get the current date and extract the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Build dynamic SQL query based on the current date
        $sql = "
            SELECT 
                t.TimetableID, 
                t.CourseID, 
                c.CourseName, 
                c.CourseCode, 
                b.BranchName, 
                b.Location,
                t.time, 
               
                t.Semester, 
                t.Year
            FROM 
                timetables t
            LEFT JOIN 
                courses c ON t.CourseID = c.CourseID
            LEFT JOIN 
                rooms r ON t.RoomID = r.RoomID
            LEFT JOIN 
                branches b ON r.BranchID = b.BranchID
            WHERE 
                t.ProfessorID IS NULL
                AND (
                    (t.Semester = 'Fall' AND (
                        (t.Year = ? AND ? >= 10)  -- Current year, October to December
                        OR t.Year > ?  -- Future years
                        OR (t.Year = ? AND ? < 10)  -- Current year, before October
                    ))
                    OR (t.Semester = 'Spring' AND (
                        (t.Year = ? AND ? BETWEEN 2 AND 5)  -- Current year, February to May
                        OR t.Year > ?  -- Future years
                        OR (t.Year = ? AND ? < 2)  -- Current year, before February
                    ))
                    OR (t.Semester = 'Summer' AND (
                        (t.Year = ? AND ? = 7)  -- Current year, July
                        OR t.Year > ?  -- Future years
                        OR (t.Year = ? AND ? < 7)  -- Current year, before July
                    ))
                )
            ORDER BY 
                t.Year DESC, 
                FIELD(t.Semester, 'Fall', 'Spring', 'Summer') ASC, 
                c.CourseName ASC
        ";

        // Parameters for dynamic query
        $params = [
            $currentYear,
            $currentMonth,
            $currentYear,
            $currentYear,
            $currentMonth,
            $currentYear,
            $currentMonth,
            $currentYear,
            $currentYear,
            $currentMonth,
            $currentYear,
            $currentMonth,
            $currentYear,
            $currentYear,
            $currentMonth
        ];

        // Execute the query with parameters
        return $this->getdata($sql, $params); // Assuming getdata method executes the query with parameters
    }





    public function getGradeStructureByCourseId($courseId)
    {
        $sql = "SELECT * FROM gradestructures WHERE CourseID = ?";
        $params = [$courseId];
        return $this->getdata($sql, $params);
    }
}
