<?php
require('dal.class.php');

class UniversityDataRetrieval extends DAL
{
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
    public function getFaculity($id)
    {
        $sql = "SELECT FaculityName FROM faculties where FacultyID=?";
        return $this->getdata($sql, [$id]);
    }
    public function getAllBranchesLocation()
    {
        $sql = "SELECT * FROM branches";
        return $this->getdata($sql, []);
    }
    public function getAllDepartments()
    {
        $sql = "SELECT * FROM departments";
        return $this->getdata($sql, []);
    }
    public function getAllDepartmentsInFaculty($facultyID)
    {
        $sql = "SELECT * FROM departments where FacultyID=?";
        return $this->getdata($sql, [$facultyID]);
    }

    function getDepartment()
    {
        $sql = "SELECT DepartmentName FROM departments ";

        return $this->getdata($sql);
    }

    function getFaculty()
    {
        $sql = "SELECT * FROM faculties";

        return $this->getdata($sql);
    }

    function getAvailableJobs()
    {
        $sql = "SELECT job_title FROM available_jobs";

        return $this->getdata($sql);
    }
    // Additional utility functions



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




    public function searchStudentByID($userID)
    {
        $sql = "SELECT * FROM users 
                WHERE UserID = ? 
                AND Role IN ('Student','Freshman')";

        return $this->getData($sql, [$userID]);
    }

    public function searchEmployeeByID($userID)
    {
        $sql = "SELECT * FROM users 
                WHERE UserID = ? 
                AND Role not in ('Student','Freshman')";

        return $this->getData($sql, [$userID]);
    }


    ///dashboard queries:

    public function getMajorCountByFaculty($facultyID)
    {
        $sql = "SELECT FacultyID, COUNT(*) AS majorCount
                FROM departments 
                WHERE FacultyID=? ";
        return $this->getData($sql,[$facultyID]);
    }
    public function getSalary()
    {
        $sql = "SELECT FacultyID  AS Salary
                FROM users 
                WHERE Role='Dean' ";
        return $this->getData($sql);
    }
    public function getProfessorCountByFaculty($facultyID)
    {
        $sql = "SELECT FacultyID, COUNT(*) AS ProfessorCount
                FROM users u
                WHERE u.Role IN ('Professor') and FacultyID=? ";
        return $this->getData($sql,[$facultyID]);
    }

    public function getStudentCountByFaculty($facultyID)
    {
        $sql = "SELECT FacultyID, COUNT(*) AS StudentCount
                FROM users u
                WHERE u.Role IN ('Student','Freshman') and FacultyID=? ";
        return $this->getData($sql,[$facultyID]);
    }

    function getTopDepartmentEnrollmentsByFaculty($facultyId)
    {
        $sql = "SELECT 
    d.DepartmentName, 
    COUNT(u.UserID) AS StudentCount
FROM 
    departments d
JOIN 
    users u ON u.DepartmentID = d.DepartmentID
WHERE 
    d.FacultyID = ?
    AND u.Role IN ('Freshman', 'Student')  -- Count only students
GROUP BY 
    d.DepartmentName;
";

        return $this->getdata($sql, [$facultyId]);
    }
    
    
    public function getfacultyPerBranch($facultyID)
    {
        $sql = "SELECT 
    b.BranchName, 
    COUNT(u.UserID) AS StudentCount
FROM 
    faculty_branches fb
JOIN 
    branches b ON fb.BranchID = b.BranchID
JOIN 
    users u ON u.BranchID = b.BranchID AND u.FacultyID = fb.FacultyID
WHERE 
    fb.FacultyID = ?
    AND u.Role IN ('Freshman', 'Student')  -- Count only students within FacultyID 12
GROUP BY 
    b.BranchName;
 ";
        return $this->getData($sql,[$facultyID]);
    }
    public function getFacultyCountByYear($facultyID)
    {
        $sql = "SELECT 
    YEAR(CreatedAt) AS Year,
    COUNT(*) AS FacultyCount,
    SUM(COUNT(*)) OVER (ORDER BY YEAR(CreatedAt)) AS CumulativeFacultyCount
FROM 
    users
WHERE 
    FacultyID = ?
    AND Role IN ('Student','Freshman')
    
GROUP BY 
    YEAR(CreatedAt)
ORDER BY 
    Year;

 ";
        return $this->getData($sql,[$facultyID]);
    }
    public function getAllCourses()
    {
        $sql = "SELECT 
                   *
                    FROM 
                    courses
                  ;";
        return $this->getData($sql);
    }
    public function getAllCoursesINDepartments($departmentID)
    {
        // Using FIND_IN_SET with REPLACE to check for department IDs in a slash-separated string
        $sql = "SELECT 
                    *
                FROM 
                    courses 
                WHERE 
                    FIND_IN_SET(?, REPLACE(DepartmentID, '/', ',')) > 0;";
                    
        return $this->getData($sql, [$departmentID]);
    }
    
    public function getStudents()
    {
        $sql = "SELECT * FROM users 
WHERE Role IN ('Student','Freshman')
";


        return $this->getData($sql, []);
    }
    

    public function getRecentNewsletters()
    {
        $sql = "SELECT NewsLetterID, Title, Content, CreatedAt
                FROM obligatorynewsletter
                ORDER BY CreatedAt DESC
                LIMIT 3";
        return $this->getData($sql);
    }


    // Function to get all information from the 'about' table

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
}
