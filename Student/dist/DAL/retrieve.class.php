<?php
require('dal.class.php');

class UniversityDataRetrieval extends DAL
{


    // Function 1: Get courses the student is enrolled in but hasn't completed
    public function getUncompletedCourses($userID)
    {
        $sql = "
        SELECT DISTINCT
            e.*, 
            t.*, 
            c.*, 
            u.*, 
            r.*,
             GROUP_CONCAT(DISTINCT pe.previousExamPath SEPARATOR ', ') AS PreviousExams
        FROM 
            enrollments e
        LEFT JOIN 
            timetables t ON e.CourseID = t.CourseID
       
        LEFT JOIN 
            courses c ON c.CourseID = t.CourseID
        LEFT JOIN 
            previousexams pe ON c.CourseID = pe.courseID
        LEFT JOIN 
            users u ON u.UserID = e.UserID 
        LEFT JOIN 
            rooms r ON t.RoomID = r.RoomID
        WHERE 
            u.UserID = ? 
            AND u.Role = 'Student'
    ";
        return $this->getdata($sql, [$userID]);
    }
    public function getCourseAttendance($userID, $courseID)
    {
        // SQL query
        $sql = "SELECT 
            c.CourseID,
            c.CourseName,
            c.CourseCode,
            COUNT(*) AS Attendance_Records,
            SUM(CASE WHEN a.Status = 'Present' THEN 1 ELSE 0 END) AS PresentCount,
            SUM(CASE WHEN a.Status = 'Absent' THEN 1 ELSE 0 END) AS AbsentCount,
            SUM(CASE WHEN a.Status = 'Late' THEN 1 ELSE 0 END) AS LateCount,
            (SUM(CASE WHEN a.Status IN ('Present', 'Late') THEN 1 ELSE 0 END) * 100.0 / COUNT(*)) AS AttendancePercentage
        FROM 
            attendance a
        JOIN 
            enrollments e ON a.EnrollmentID = e.EnrollmentID
        JOIN 
            courses c ON e.CourseID = c.CourseID
            
        WHERE 
            e.UserID = ? 
            AND c.CourseID = ?
        GROUP BY 
            c.CourseID, c.CourseName, c.CourseCode;
    ";

        // Fetch the result
        return $this->getdata($sql, [$userID, $courseID]);
    }


    // Function 2: Get courses the student has failed
    public function getFailedCourses($userID)
    {
        $sql = "
            SELECT c.CourseID, c.CourseName, c.CourseCode, scp.Grade
            FROM enrollments e
            JOIN courses c ON e.CourseID = c.CourseID
            JOIN student_course_progress scp ON e.EnrollmentID = scp.EnrollmentID
            WHERE e.UserID = ?
              AND e.Role = 'Student'
              AND scp.Status = 'Failed'
        ";
        return $this->getdata($sql, [$userID]);
    }

    // Function 3: Get courses the student has completed
    public function getCompletedCourses($userID)
    {
        $sql = "
            SELECT c.CourseID, c.CourseName, c.CourseCode, scp.Grade
            FROM enrollments e
            JOIN courses c ON e.CourseID = c.CourseID
            JOIN student_course_progress scp ON e.EnrollmentID = scp.EnrollmentID
            WHERE e.UserID = ?
              AND e.Role = 'Student'
              AND scp.Status = 'Completed'
        ";
        return $this->getdata($sql, [$userID]);
    }

    // Function 4: Get total credits and fees for each student
    public function getTotalCreditsAndFees($UserId, $semester, $year)
    {
        $sql = "
             SELECT 
            u.UserID, 
            u.Username, 
            SUM(c.Credits) AS TotalCredits, 
            SUM(c.Credits * f.CreditFee) AS TotalFees
        FROM 
            users u
        JOIN 
            enrollments e ON u.UserID = e.UserID
        JOIN 
            courses c ON e.CourseID = c.CourseID
        JOIN 
            faculties f ON u.FacultyID = f.FacultyID
        LEFT JOIN 
            student_course_progress scp ON e.EnrollmentID = scp.EnrollmentID
        LEFT JOIN 
            timetables t ON c.CourseID = t.CourseID
        WHERE 
            u.Role = 'Student' 
            AND u.UserID = ? 
            AND scp.EnrollmentID IS NULL  -- Only current registrations
            AND t.Semester = ? 
            AND t.Year = ?
        GROUP BY 
            u.UserID, u.Username
        ";
        return $this->getdata($sql, [$UserId, $semester, $year]);
    }

    // Function 5: Get available course slots for the current semester
    public function getAvailableSlots($userID)
    {
        $sql = "
                 SELECT c.CourseID, c.CourseName, c.CourseCode, c.Credits,
                    r.Capacity - COUNT(e.EnrollmentID) AS AvailableSlots
                FROM courses c
                JOIN departments d ON FIND_IN_SET(d.DepartmentID, REPLACE(c.DepartmentID, '/', ',')) > 0
                JOIN users u ON d.DepartmentID = u.DepartmentID
                JOIN timetables t ON c.CourseID = t.CourseID
                JOIN rooms r ON t.RoomID = r.RoomID
                LEFT JOIN enrollments e ON c.CourseID = e.CourseID AND e.Role = 'Student'
                WHERE u.UserID = ? -- Replace with the specific student's UserID
                AND t.Year = YEAR(CURDATE()) -- Assuming current year courses
                AND t.Semester = 'Fall' -- Replace with the current semester
                GROUP BY c.CourseID, c.CourseName, c.CourseCode, c.Credits, r.Capacity
                HAVING COUNT(e.EnrollmentID) < r.Capacity;

        ";
        return $this->getdata($sql, [$userID]);
    }

    // Function 6: Get current enrollment and available slots for a specific course
    public function getCourseEnrollmentStatus($courseID)
    {
        $sql = "
            SELECT c.CourseID, c.CourseName, c.CourseCode,
                   COUNT(e.EnrollmentID) AS CurrentEnrollment,
                   r.Capacity AS CourseCapacity,
                   r.Capacity - COUNT(e.EnrollmentID) AS AvailableSlots
            FROM courses c
            JOIN timetables t ON c.CourseID = t.CourseID
            JOIN rooms r ON t.RoomID = r.RoomID
            LEFT JOIN enrollments e ON c.CourseID = e.CourseID AND e.Role = 'Student'
            LEFT JOIN student_course_progress scp ON e.EnrollmentID = scp.EnrollmentID
            WHERE c.CourseID = ?
              AND t.Year = YEAR(CURDATE()) -- Assuming current year
              AND t.Semester = 'Fall' -- Replace with the current semester
              AND scp.EnrollmentID IS NULL -- Exclude completed or failed courses
            GROUP BY c.CourseID, c.CourseName, c.CourseCode, r.Capacity
        ";
        return $this->getdata($sql, [$courseID]);
    }
    public function getGradesAndWeightedGrades($userID, $courseID)
    {
        $sql = "SELECT 
                    c.CourseID,
                    c.CourseName,
                    c.CourseCode,
                    gs.AssessmentType,
                    gs.Weight,
                    sg.Grade,
                    (sg.Grade * gs.Weight / 100) AS WeightedGrade
                FROM 
                    enrollments e
                JOIN 
                    courses c ON e.CourseID = c.CourseID
                JOIN 
                    gradestructures gs ON c.CourseID = gs.CourseID
                LEFT JOIN 
                    student_grades sg ON e.EnrollmentID = sg.EnrollmentID AND gs.GradeStructureID = sg.GradeStructureID
                WHERE 
                    e.UserID = ? 
                    AND c.CourseID = ?
                ORDER BY 
                    gs.AssessmentType";

        $params = [$userID, $courseID];

        return $this->getdata($sql, $params);
    }
    public function calculateTotalGrade($userID, $courseID)
    {
        $sql = "SELECT 
                    SUM(sg.Grade * gs.Weight / 100) AS TotalGrade
                FROM 
                    enrollments e
                JOIN 
                    courses c ON e.CourseID = c.CourseID
                JOIN 
                    gradestructures gs ON c.CourseID = gs.CourseID
                LEFT JOIN 
                    student_grades sg ON e.EnrollmentID = sg.EnrollmentID AND gs.GradeStructureID = sg.GradeStructureID
                WHERE 
                    e.UserID = ? 
                    AND c.CourseID = ?";

        $params = [$userID, $courseID];

        return $this->getdata($sql, $params);
    }
    public function hasStudentSubmittedEvaluation($studentID, $professorID, $courseID)
    {
        $sql = "
        SELECT 
            COUNT(*) AS EvaluationCount
        FROM 
            evaluations
        WHERE 
            StudentID = ? 
            AND ProfessorID = ?
            AND CourseID = ?
    ";

        $result = $this->getdata($sql, [$studentID, $professorID, $courseID]);

        return $result[0]['EvaluationCount'] > 0;
    }
    public function getStudentGPA($userID)
    {
        $sql = "
        SELECT 
            e.UserID,
            SUM(
                CASE 
                    WHEN g.Grade >= 90 THEN 4.0 * c.Credits
                    WHEN g.Grade >= 80 THEN 3.0 * c.Credits
                    WHEN g.Grade >= 70 THEN 2.0 * c.Credits
                    WHEN g.Grade >= 60 THEN 1.0 * c.Credits
                    ELSE 0.0 * c.Credits
                END
            ) / SUM(c.Credits) AS GPA
        FROM 
           student_course_progress g
        JOIN 
            enrollments e ON g.EnrollmentID = e.EnrollmentID
        JOIN 
            courses c ON e.CourseID = c.CourseID
        WHERE 
            e.UserID = ?  -- Placeholder for the student ID
        GROUP BY 
            e.UserID
    ";

        // Assuming $this->getdata() is used to execute queries
        $result = $this->getdata($sql, [$userID]);

        // Return the GPA result, or handle the case when no GPA is found
        return !empty($result) ? $result[0]['GPA'] : null;
    }

    public function getUserInfo($userID)
    {
        $sql = "SELECT * from users where UserID = ? ;
             ";

        $params = [$userID];

        return $this->getdata($sql, $params);
    }
    // Function to get attestations for a specific student ID
    public function getAttestationsByStudentId($studentId)
    {
        $sql = "SELECT 
                 id,
                 student_id,
                 faculty_id,
                 date,
                 status,
                 remarks,
                 created_at,
                 updated_at
             FROM 
                 attestations
             WHERE 
                 student_id = ?";

        return $this->getdata($sql, [$studentId]);
    }

    // Function to get petitions for a specific student ID
    public function getPetitionsByStudentId($studentId)
    {
        $sql = "SELECT 
                 id,
                 student_id,
                 faculty_id,
                 subject,
                 description,
                 status,
                 created_at,
                 updated_at
             FROM 
                 petitions
             WHERE 
                 student_id = ?";

        return $this->getdata($sql, [$studentId]);
    }

    // Function to get financial aids for a specific student ID
    public function getFinancialAidsByStudentId($studentId)
    {
        $sql = "SELECT 
                 id,
                 student_id,
                 aid_amount,
                 created_at,
                 updated_at
             FROM 
                 financial_aids
             WHERE 
                 student_id = ?";

        return $this->getdata($sql, [$studentId]);
    }
    public function getRequestsByStudentId($studentId)
    {
        $sql = "SELECT 
                id,
                student_id,
                request_type,
                file_path,
                status,
                created_at,
                updated_at,
                faculty_id,
                comments
            FROM 
                requests
            WHERE 
                student_id = ?";

        return $this->getdata($sql, [$studentId]);
    }

    public function getStudentGPAPerSemester($studentId)
    {
        $sql = "WITH AllSemesters AS (
    SELECT DISTINCT
        e.Semester AS SemesterTaken,
        e.Year AS YearTaken
    FROM 
        enrollments e
    WHERE 
        e.UserID = ?  
),
GPA_Calculations AS (
    SELECT 
        e.Semester AS SemesterTaken,
        e.Year AS YearTaken,
        SUM(
            CASE 
                WHEN g.Grade >= 90 THEN 4.0 * c.Credits
                WHEN g.Grade >= 80 THEN 3.0 * c.Credits
                WHEN g.Grade >= 70 THEN 2.0 * c.Credits
                WHEN g.Grade >= 60 THEN 1.0 * c.Credits
                ELSE 0.0 * c.Credits
            END
        ) / NULLIF(SUM(c.Credits), 0) AS GPA
    FROM 
        student_course_progress g
    JOIN 
        enrollments e ON g.EnrollmentID = e.EnrollmentID
    JOIN 
        courses c ON e.CourseID = c.CourseID
    WHERE 
        e.UserID = ? 
    GROUP BY 
        e.Semester, e.Year
)
SELECT
    a.SemesterTaken,
    a.YearTaken,
    COALESCE(g.GPA, 0) AS GPA
FROM
    AllSemesters a
LEFT JOIN
    GPA_Calculations g
ON
    a.SemesterTaken = g.SemesterTaken AND a.YearTaken = g.YearTaken
ORDER BY
    a.YearTaken, a.SemesterTaken;";

        return $this->getdata($sql, [$studentId, $studentId]);
    }
    public function getStudentCumulativeGPAPerSemester($studentId)
    {
        $sql = "WITH AllSemesters AS (
    SELECT DISTINCT
        e.Semester AS SemesterTaken,
        e.Year AS YearTaken
    FROM 
        enrollments e
    WHERE 
        e.UserID = ?  
),
GPA_Calculations AS (
    SELECT 
        e.Semester AS SemesterTaken,
        e.Year AS YearTaken,
        SUM(
            CASE 
                WHEN g.Grade >= 90 THEN 4.0 * c.Credits
                WHEN g.Grade >= 80 THEN 3.0 * c.Credits
                WHEN g.Grade >= 70 THEN 2.0 * c.Credits
                WHEN g.Grade >= 60 THEN 1.0 * c.Credits
                ELSE 0.0 * c.Credits
            END
        ) AS TotalGradePoints,
        SUM(c.Credits) AS TotalCredits
    FROM 
        student_course_progress g
    JOIN 
        enrollments e ON g.EnrollmentID = e.EnrollmentID
    JOIN 
        courses c ON e.CourseID = c.CourseID
    WHERE 
        e.UserID = ? 
    GROUP BY 
        e.Semester, e.Year
),
CumulativeGPA AS (
    SELECT
        a.SemesterTaken,
        a.YearTaken,
        COALESCE(SUM(g.TotalGradePoints) OVER (ORDER BY a.YearTaken, a.SemesterTaken ROWS UNBOUNDED PRECEDING), 0) AS CumulativeGradePoints,
        COALESCE(SUM(g.TotalCredits) OVER (ORDER BY a.YearTaken, a.SemesterTaken ROWS UNBOUNDED PRECEDING), 0) AS CumulativeCredits
    FROM
        AllSemesters a
    LEFT JOIN
        GPA_Calculations g
    ON
        a.SemesterTaken = g.SemesterTaken AND a.YearTaken = g.YearTaken
)
SELECT
    SemesterTaken,
    YearTaken,
    CASE 
        WHEN CumulativeCredits = 0 THEN 4
        ELSE CumulativeGradePoints / CumulativeCredits
    END AS CumulativeGPA
FROM
    CumulativeGPA
ORDER BY
    YearTaken, SemesterTaken;
";

        return $this->getdata($sql, [$studentId, $studentId]);
    }

    public function getGradesCount($studentId)
    {
        $sql = "SELECT SUM(CASE WHEN Grade BETWEEN 90 AND 100 THEN 1 ELSE 0 END) AS A, SUM(CASE WHEN Grade BETWEEN 85 AND 89 THEN 1 ELSE 0 END) AS B_Plus, SUM(CASE WHEN Grade BETWEEN 80 AND 84 THEN 1 ELSE 0 END) AS B, SUM(CASE WHEN Grade BETWEEN 75 AND 79 THEN 1 ELSE 0 END) AS C_Plus, SUM(CASE WHEN Grade BETWEEN 70 AND 74 THEN 1 ELSE 0 END) AS C, SUM(CASE WHEN Grade BETWEEN 65 AND 69 THEN 1 ELSE 0 END) AS D_Plus, SUM(CASE WHEN Grade BETWEEN 60 AND 64 THEN 1 ELSE 0 END) AS D, SUM(CASE WHEN Grade < 60 THEN 1 ELSE 0 END) AS F FROM student_course_progress AS scp JOIN enrollments AS e ON scp.EnrollmentID = e.EnrollmentID WHERE e.UserID = ?;";

        return $this->getdata($sql, [$studentId]);
    }

    public function getCreditsCount($studentId)
    {
        $sql = "
WITH TotalCredits AS (
   
    SELECT SUM(c.Credits) AS total_credits
    FROM courses c
    JOIN users u ON FIND_IN_SET(u.DepartmentID, REPLACE(c.DepartmentID, '/', ',')) > 0
    WHERE u.UserID = ?
),
CompletedCredits AS (
 
    SELECT SUM(c.Credits) AS completed_credits
    FROM student_course_progress scp
    JOIN enrollments e ON scp.EnrollmentID = e.EnrollmentID
    JOIN courses c ON e.CourseID = c.CourseID
    JOIN users u ON e.UserID = u.UserID
    WHERE u.UserID = ?
      AND FIND_IN_SET(u.DepartmentID, REPLACE(c.DepartmentID, '/', ',')) > 0
      AND scp.Status = 'Completed'
)

SELECT 
    tc.total_credits,
    cc.completed_credits,
    (tc.total_credits - COALESCE(cc.completed_credits, 0)) AS remaining_credits
FROM TotalCredits tc
LEFT JOIN CompletedCredits cc ON 1=1;";

        return $this->getdata($sql, [$studentId, $studentId]);
    }
}
