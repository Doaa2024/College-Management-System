<?php
require('dal.class.php');

class UniversityDataRetrieval extends DAL
{

    public function getAttestations($studentId = null)
    {
        $sql = "SELECT a.*, f.FaculityName as FacultyName 
                FROM attestations a
                JOIN faculties f ON a.faculty_id = f.FacultyID";
        $params = [];
        if ($studentId) {
            $sql .= " WHERE a.student_id = ?";
            $params[] = $studentId;
        }
        return $this->getdata($sql, $params);
    }

    public function getPetitions($facultyId = null)
    {
        $sql = "SELECT p.*, f.FaculityName as FacultyName 
                FROM petitions p
                JOIN faculties f ON p.faculty_id = f.FacultyID";
        $params = [];
        if ($facultyId) {
            $sql .= " WHERE p.faculty_id = ?";
            $params[] = $facultyId;
        }
        return $this->getdata($sql, $params);
    }

    public function getFinancialAids($studentId = null)
    {
        $sql = "SELECT fa.*, f.FaculityName as FacultyName 
                FROM financial_aids fa
                JOIN users u ON fa.student_id = u.UserID
                JOIN faculties f ON u.FacultyID = f.FacultyID";
        $params = [];
        if ($studentId) {
            $sql .= " WHERE fa.student_id = ?";
            $params[] = $studentId;
        }
        return $this->getdata($sql, $params);
    }

    public function getFaculties()
    {
        $sql = "SELECT * FROM faculties";
        return $this->getdata($sql, []);
    }

    public function getDepartmentsInBranch($branchID = null)
    {
        // Define the SQL query with JOINs to fetch departments based on the branchID
        $sql = "
            SELECT d.*, f.FaculityName
            FROM departments d
            INNER JOIN faculties f ON d.FacultyID = f.FacultyID
            INNER JOIN faculty_branches fb ON f.FacultyID = fb.FacultyID
            WHERE fb.BranchID = ? order by d.DepartmentID
        ";

        // Define the parameter for the branchID
        $params = [$branchID];

        // Fetch the data using the getdata method
        return $this->getdata($sql, $params);
    }
    public function getFacInBranch($branchID = null)
    {
        // Define the SQL query with JOINs to fetch departments based on the branchID
        $sql = " Select
            fb.FacultyID, f.FaculityName
            FROM faculty_branches fb
            left JOIN faculties f ON fb.FacultyID = f.FacultyID
            WHERE fb.BranchID = ?
           

        ";

        // Define the parameter for the branchID
        $params = [$branchID];

        // Fetch the data using the getdata method
        return $this->getdata($sql, $params);
    }


    public function getDepartmentInfo($departmentId)
    {
        $sql = "SELECT d.*, 
                       f.FaculityName as FacultyName, 
                       u.Username as DepartmentHeadName,
                       (SELECT COUNT(*) FROM courses WHERE DepartmentID = d.DepartmentID) as TotalCourses,
                       (SELECT COUNT(DISTINCT e.UserID) 
                        FROM courses c
                        LEFT JOIN enrollments e ON c.CourseID = e.CourseID
                        WHERE c.DepartmentID = d.DepartmentID) as TotalStudents
                FROM departments d
                LEFT JOIN faculties f ON d.FacultyID = f.FacultyID
                LEFT JOIN departmentheads dh ON d.DepartmentID = dh.DepartmentID
                LEFT JOIN users u ON dh.DepartmentHeadID = u.UserID
                WHERE d.DepartmentID = ?";

        $params = [$departmentId];
        return $this->getdata($sql, $params);
    }

    public function getRecentNewsletters()
    {
        $sql = "SELECT NewsLetterID, Title, Content, CreatedAt
                FROM obligatorynewsletter
                ORDER BY CreatedAt DESC
                LIMIT 3";
        return $this->getData($sql);
    }
    public function getNewsletterSubscriptions($userId = null)
    {
        $sql = "SELECT ns.*, on.Title FROM newslettersubscriptions ns
                JOIN optionalnewsletter on ON ns.OptionalNewsLetterID = on.OptionalNewsLetterID";
        $params = [];
        if ($userId) {
            $sql .= " WHERE ns.UserID = ?";
            $params[] = $userId;
        }
        return $this->getdata($sql, $params);
    }

    public function getObligatoryNewsletters($limit, $offset)
    {
        $sql = "SELECT * FROM obligatorynewsletter ORDER BY IssueDate DESC LIMIT ? OFFSET ?";
        return $this->getdata($sql, [$limit, $offset]);
    }

    public function getOptionalNewsletters($limit, $offset)
    {
        $sql = "SELECT * FROM optionalnewsletter ORDER BY IssueDate DESC LIMIT ? OFFSET ?";
        return $this->getdata($sql, [$limit, $offset]);
    }



    public function countObligatoryNewsletters()
    {
        $sql = "SELECT COUNT(*) AS count FROM obligatorynewsletter";
        $result = $this->getdata($sql, []);
        return $result[0]['count'];
    }

    public function countOptionalNewsletters()
    {
        $sql = "SELECT COUNT(*) AS count FROM optionalnewsletter";
        $result = $this->getdata($sql, []);
        return $result[0]['count'];
    }



    public function getEmployeesByBranch($branchId)
    {
        $sql = "SELECT * FROM users WHERE BranchID = ? AND Role IN ('Professor', 'Admin')";
        return $this->getdata($sql, [$branchId]);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Retrieves the total number of students enrolled in a specific branch.
     *
     * @param int $branchId The ID of the branch to filter students.
     * @return mixed The result of the query containing the total number of students.
     */
    public function getTotalStudentsInBranch($branchId)
    {
        // Use ? as placeholder for PDO
        $sql = "SELECT COUNT(u.UserID) as total_students
                FROM users u
                JOIN enrollments e ON u.UserID = e.UserID
                WHERE u.BranchID = ?";

        // Return data using the modified getdata method
        return $this->getdata($sql, [$branchId]);
    }

    /**
     * Retrieves the list of courses offered in the current semester.
     *
     * The current semester is determined based on the current month: 
     * Fall (August to December) or Spring (January to July).
     *
     * @return mixed The result of the query containing course details for the current semester.
     */
    public function getCurrentSemesterCourses()
    {
        $currentYear = date('Y');
        $currentMonth = date('n');
        $semester = ($currentMonth >= 8 && $currentMonth <= 12) ? 'Fall' : 'Spring';

        // Use ? as placeholders for PDO
        $sql = "SELECT DISTINCT c.CourseID, c.CourseName, c.CourseCode
                FROM courses c
                JOIN enrollments e ON c.CourseID = e.CourseID
                WHERE e.Year = ? AND e.Semester = ?";

        // Return data using the modified getdata method
        return $this->getdata($sql, [$currentYear, $semester]);
    }


    /**
     * Retrieves the total revenue generated by a specific branch.
     *
     * @param int $branchId The ID of the branch to filter revenue.
     * @return mixed The result of the query containing the total revenue for the branch.
     */
    public function getBranchRevenue($branchId)
    {
        // Use ? as a placeholder for PDO
        $sql = "SELECT SUM(amount) as total_revenue
                FROM branch_revenues
                WHERE branch_id = ?";

        // Return data using the modified getdata method
        return $this->getdata($sql, [$branchId]);
    }


    /**
     * Retrieves the number of students enrolled and the number of applications for each course.
     *
     * The data includes the number of students enrolled in each course and the number of applications received.
     *
     * @return mixed The result of the query containing the enrollment vs demand data for each course.
     */
    public function getEnrollmentVsDemand()
    {
        $sql = "SELECT 
                e.Year AS Year,
                COUNT(DISTINCT e.UserID) AS TotalEnrollments,
                (SELECT COUNT(DISTINCT c.CourseID) 
                 FROM courses c
                 WHERE YEAR(c.CreatedAt) = e.Year) AS TotalCourses
            FROM enrollments e
            GROUP BY e.Year
            ORDER BY e.Year";


        return $this->getdata($sql, []);
    }



    /**
     * Retrieves available rooms that are not currently booked for the day and time.
     *
     * The query excludes rooms that are already scheduled for the current day and time.
     *
     * @return mixed The result of the query containing details of available rooms.
     */
    public function getAvailableRooms($branchId)
    {
        $sql = "SELECT COUNT(r.RoomID) AS AvailableRoomCount
                    FROM rooms r
                    WHERE r.BranchID = ?
                    AND r.RoomID NOT IN (
                        SELECT DISTINCT t.RoomID
                        FROM timetables t
                        JOIN courses c ON t.CourseID = c.CourseID
                        JOIN departments d ON c.DepartmentID = d.DepartmentID
                        JOIN faculties f ON d.FacultyID = f.FacultyID
                        JOIN faculty_branches fb ON f.FacultyID = fb.FacultyID
                        WHERE fb.BranchID = ?
                        AND t.DayOfWeek = DAYNAME(CURDATE())
                        AND CURTIME() BETWEEN t.StartTime AND t.EndTime
                    );
";

        // Pass parameters in the correct order
        $params = [$branchId, $branchId];
        return $this->getdata($sql, $params);
    }

    /**
     * Retrieves the number of students enrolled in each department.
     *
     * The query groups the data by department and counts the number of students per department.
     *
     * @return mixed The result of the query containing student counts by department.
     */
    function getTopDepartmentEnrollmentsByBranch($branchId)
    {
        $sql = "SELECT 
                    d.DepartmentName,
                    COUNT(DISTINCT e.UserID) as TotalEnrollments
                FROM departments d
                JOIN courses c ON d.DepartmentID = c.DepartmentID
                JOIN enrollments e ON c.CourseID = e.CourseID
                JOIN users u ON e.UserID = u.UserID
                WHERE u.BranchID = ?
                GROUP BY d.DepartmentID, d.DepartmentName
                ORDER BY TotalEnrollments DESC
                LIMIT 5";

        return $this->getdata($sql, [$branchId]);
    }
    /**
     * Retrieves the top 5 departments by revenue distribution.
     *
     * The data includes the total revenue generated by each department and the percentage of total revenue.
     *
     * @return mixed The result of the query containing the top 5 departments by revenue.
     */
    public function getTopDepartmentRevenueDistribution($branchId)
    {
        $sql = "SELECT 
                d.DepartmentName,
                SUM(sf.Amount) as TotalRevenue
            FROM departments d
            JOIN courses c ON d.DepartmentID = c.DepartmentID
            JOIN enrollments e ON c.CourseID = e.CourseID
            JOIN users u ON e.UserID = u.UserID
            JOIN studentfees sf ON u.UserID = sf.StudentID
            WHERE u.BranchID = ?
            GROUP BY d.DepartmentID, d.DepartmentName
            ORDER BY TotalRevenue DESC
            LIMIT 5";
        $params = [$branchId];
        return $this->getdata($sql, $params);
    }

    public function getDepartment($departmentID)
    {
        $sql = "SELECT * FROM departments WHERE DepartmentID = ?";
        $params = [$departmentID];
        return $this->getdata($sql, $params);
    }
    public function getBranchHeadByBranchId($branchId)
    {
        $sql = "SELECT UserID FROM branches_heads WHERE BranchID = ?";
        return $this->getData($sql, [$branchId]);
    }
}
