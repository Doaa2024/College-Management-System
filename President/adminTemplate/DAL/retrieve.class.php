<?php
require('dal.class.php');

class UniversityDataRetrieval extends DAL
{

    public function getAllStudents()
    {
        $sql = "SELECT * FROM users WHERE Role = 'Student' AND Status = 'Active'";
        return $this->getdata($sql, []);
    }

    public function getAllProfessors()
    {
        $sql = "SELECT * FROM users WHERE Role = 'Professor'";
        return $this->getdata($sql, []);
    }

    public function getAllOtherEmployees()
    {
        $sql = "SELECT * FROM users WHERE Role != 'Student' ";
        return $this->getdata($sql, []);
    }

    public function getAllBranches()
    {
        $sql = "SELECT * FROM branches";
        return $this->getdata($sql, []);
    }

    public function getAllFaculties()
    {
        $sql = "SELECT * FROM faculties";
        return $this->getdata($sql, []);
    }

    public function getAllDepartments()
    {
        $sql = "SELECT * FROM departments";
        return $this->getdata($sql, []);
    }

    // Additional utility functions

    public function getStudentsByBranch($branchID)
    {
        $sql = "SELECT * FROM users WHERE Role = 'Student' AND BranchID = ? AND Status = 'Active'";
        return $this->getdata($sql, [$branchID]);
    }

    public function getProfessorsByFaculty($facultyID)
    {
        $sql = "SELECT * FROM users WHERE Role = 'Professor' AND FacultyID = ? AND Status = 'Active'";
        return $this->getdata($sql, [$facultyID]);
    }

    public function getDepartmentsByFaculty($facultyID)
    {
        $sql = "SELECT * FROM departments WHERE FacultyID = ?";
        return $this->getdata($sql, [$facultyID]);
    }
    public function getBranchRevenueDetails($branchID)
    {
        $sql = "SELECT br.revenue_id, b.BranchName, rs.source_name, br.amount, br.revenue_date
                FROM branch_revenues br
                JOIN branches b ON br.branch_id = b.BranchID
                JOIN revenue_sources rs ON br.source_id = rs.source_id
                WHERE br.branch_id = ?
                ORDER BY br.revenue_date DESC";

        return $this->getdata($sql, [$branchID]);
    }


    public function getFacultyCompleteInfo($facultyID)
    {
        $sql = "
        SELECT
            f.FacultyID,
            f.FaculityName,
            f.CreditFee,
            b.BranchID,
            b.BranchName,
            b.Location AS BranchLocation,
            d.DepartmentID,
            d.DepartmentName,
            c.CourseID,
            c.CourseName,
            c.CourseCode,
            c.Credits,
            fh.FacultyHeadID,
            ufh.Username AS FacultyHeadName,
            dh.DepartmentHeadID,
            udh.Username AS DepartmentHeadName,
            COUNT(DISTINCT us.UserID) AS StudentCount,
            COUNT(DISTINCT up.UserID) AS ProfessorCount
        FROM faculties f
        LEFT JOIN faculty_branches fb ON f.FacultyID = fb.FacultyID
        LEFT JOIN branches b ON fb.BranchID = b.BranchID
        LEFT JOIN departments d ON d.FacultyID = f.FacultyID
        LEFT JOIN courses c ON c.DepartmentID = d.DepartmentID
        LEFT JOIN facultyheads fh ON fh.FacultyID = f.FacultyID
        LEFT JOIN users ufh ON ufh.UserID = fh.FacultyHeadID
        LEFT JOIN departmentheads dh ON dh.DepartmentID = d.DepartmentID
        LEFT JOIN users udh ON udh.UserID = dh.DepartmentHeadID
        LEFT JOIN users us ON us.FacultyID = f.FacultyID AND us.Role = 'Student' AND us.Status = 'Active'
        LEFT JOIN users up ON up.FacultyID = f.FacultyID AND up.Role = 'Professor' AND up.Status = 'Active'
        WHERE f.FacultyID = ?
        GROUP BY f.FacultyID, b.BranchID, d.DepartmentID, c.CourseID, fh.FacultyHeadID, dh.DepartmentHeadID
        ORDER BY d.DepartmentName, c.CourseName;
    ";

        return $this->getdata($sql, [$facultyID]);
    }
    public function getCoursesGroupedByDepartmentAndFaculty($facultyID)
    {
        $sql = "
    SELECT
        f.FacultyID,
        f.FaculityName,
        d.DepartmentID,
        d.DepartmentName,
        dh.DepartmentHeadID,
        u.Username,
        c.CourseID,
        c.CourseName,
        c.CourseCode,
        c.Credits
    FROM faculties f
    LEFT JOIN departments d ON d.FacultyID = f.FacultyID
    LEFT JOIN departmentheads dh ON dh.DepartmentID = d.DepartmentID
    LEFT JOIN users u ON u.UserID = dh.DepartmentHeadID
    LEFT JOIN courses c ON c.DepartmentID = d.DepartmentID
    WHERE f.FacultyID = ?
    GROUP BY f.FacultyID, d.DepartmentID, c.CourseID
    ORDER BY d.DepartmentName, c.CourseName;
    ";

        return $this->getdata($sql, [$facultyID]);
    }

    public function getCurrentEmployers()
    {
        // SQL query to select current employers excluding students, professors, and secretaries
        $sql = "SELECT UserID, Username, Email, Role, BranchID, FacultyID, DepartmentID
                    FROM users
                    WHERE Role NOT IN ('Student', 'Professor', 'Secretary') AND Role IS NOT NULL";

        // Execute the query and return the results
        return $this->getdata($sql, []);
    }
    public function getBranchesForFaculty($facultyID)
    {
        $sql = "
            SELECT
                b.BranchID,
                b.BranchName,
                b.Location
            FROM faculty_branches fb
            INNER JOIN branches b ON fb.BranchID = b.BranchID
            WHERE fb.FacultyID = ?
        ";

        return $this->getdata($sql, [$facultyID]);
    }
    public function getFacultyInfo($facultyID)
    {
        // Corrected query
        $sql = "
             SELECT FacultyID, FaculityName, CreditFee FROM faculties WHERE FacultyID = ?
    ";

        $result = $this->getdata($sql, [$facultyID]);

        return $result;
    }
    public function searchStudentByID($userID)
    {
        $sql = "SELECT * FROM users 
                WHERE UserID = ? 
                AND Role = 'Student'";

        return $this->getData($sql, [$userID]);
    }
    public function searchEmployeeByID($userID)
    {
        $sql = "SELECT * FROM users 
                WHERE UserID = ? 
                AND Role != 'Student'";

        return $this->getData($sql, [$userID]);
    }

    ///dashboard queries:
    public function getAverageEarningsPerSemester()
    {
        $sql = "SELECT AVG(Amount) AS AverageEarningsPerSemester
                FROM studentfees
                WHERE FeeType = 'Tuition'";
        return $this->getData($sql);
    }

    public function getAverageEarningsPerYear()
    {
        $sql = "SELECT SUM(Amount) * 2 AS AverageEarningsPerYear
                FROM studentfees
                WHERE FeeType = 'Tuition'";
        return $this->getData($sql);
    }

    public function getCurrentSemesterEnrollments()
    {
        $sql = "SELECT COUNT(*) AS CurrentSemesterEnrollments
                FROM enrollments
                WHERE Semester = 'Fall' AND Year = YEAR(CURDATE())";
        return $this->getData($sql);
    }
    public function getMonthlyEnrollments()
    {
        $sql = "SELECT 
                        Year,
                        COUNT(*) AS EnrollmentCount,
                        SUM(COUNT(*)) OVER (ORDER BY Year) AS CumulativeEnrollment
                    FROM 
                        enrollments
                    WHERE 
                        Role = 'Student'
                    GROUP BY 
                        Year
                    ORDER BY 
                        Year;";
        return $this->getData($sql);
    }

    public function getStudentCountByBranch()
    {
        $sql = "SELECT b.BranchName, COUNT(*) AS StudentCount
                FROM users u
                JOIN branches b ON u.BranchID = b.BranchID
                WHERE u.Role = 'Student'
                GROUP BY b.BranchID, b.BranchName";
        return $this->getData($sql);
    }

    public function getTotalRevenueByBranch()
    {
        $sql = "SELECT b.BranchName, SUM(br.amount) AS TotalRevenue
                FROM branch_revenues br
                JOIN branches b ON br.branch_id = b.BranchID
                GROUP BY b.BranchID, b.BranchName
                ORDER BY TotalRevenue DESC
                LIMIT 5";
        return $this->getData($sql);
    }

    public function getRecentNewsletters()
    {
        $sql = "SELECT NewsLetterID, Title, Content, CreatedAt
                FROM obligatorynewsletter
                ORDER BY CreatedAt DESC
                LIMIT 3";
        return $this->getData($sql);
    }

    public function getOpenFacultyPositions()
    {
        $sql = "SELECT COUNT(*) AS OpenFacultyPositions
                FROM available_jobs
                WHERE status = 'Pending'";
        return $this->getData($sql);
    }

    // Function to get all information from the 'about' table
    public function getAllAboutInfo()
    {
        $sql = "SELECT * FROM `about`";
        return $this->getData($sql);
    }

    // Function to get all information from the 'home' table
    public function getAllHomeInfo()
    {
        $sql = "SELECT * FROM `home`";
        return $this->getData($sql);
    }

    // Function to get all information from the 'moreinfo' table
    public function getAllMoreInfo()
    {
        $sql = "SELECT * FROM `moreinfo`";
        return $this->getData($sql);
    }
}
