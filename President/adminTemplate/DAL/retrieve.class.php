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
        $sql = "SELECT * FROM users WHERE Role = 'Professor' AND Status = 'Active'";
        return $this->getdata($sql, []);
    }

    public function getAllOtherEmployees()
    {
        $sql = "SELECT * FROM users WHERE Role NOT IN ('Student', 'Professor') AND Status = 'Active'";
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
    f.FaculityName,           -- Ensure this column name is correct
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
LEFT JOIN branches b ON f.BranchID = b.BranchID
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
        $sql = "SELECT b.BranchID, b.BranchName, b.Location
            FROM branches b
            INNER JOIN faculties f ON b.BranchID = f.BranchID
            WHERE f.FacultyID = ?";

        return $this->getdata($sql, [$facultyID]);
    }
}
