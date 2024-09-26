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
    public function getAllSemesters()
    {
        $sql = "SELECT DISTINCT Semester, Year FROM timetables ORDER BY Year ASC, Semester ASC";
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


    public function getCoursesINSemester($semester, $year, $departmentid)
    {
        $sql = "SELECT t.TimetableID, t.Semester, t.Year, c.CourseName,c.CourseID, c.CourseCode, c.Credits, b.BranchName, r.RoomName, r.RoomID, t.DayOfWeek, t.time FROM timetables t JOIN courses c ON t.CourseID = c.CourseID JOIN rooms r ON t.RoomID = r.RoomID JOIN branches b ON r.BranchID = b.BranchID WHERE t.Semester =? AND t.Year =? AND FIND_IN_SET(?, REPLACE(c.DepartmentID, '/', ',')) > 0;
";
        return $this->getdata($sql, [$semester, $year, $departmentid]);
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

    // public function getSalary()
    // {
    //     $sql = "SELECT FacultyID  AS Salary
    //             FROM users 
    //             WHERE Role='Dean' ";
    //     return $this->getData($sql);
    // }

    public function  getDepartmentCountByBranch($departmentID)
    {
        $sql = "SELECT COUNT(DISTINCT fb.BranchID) AS NumberOfBranches
FROM departments d
JOIN faculty_branches fb ON d.FacultyID = fb.FacultyID
WHERE d.DepartmentID = ?;
 ";
        return $this->getData($sql, [$departmentID]);
    }
    public function  studentCountByDepartmentINBranch($departmentID)
    {
        $sql = "SELECT 
    b.BranchName,
    COUNT(s.UserID) AS NumberOfStudents
FROM 
    departments d
JOIN 
    faculty_branches fb ON d.FacultyID = fb.FacultyID
JOIN 
    branches b ON fb.BranchID = b.BranchID
LEFT JOIN 
    users s ON b.BranchID = s.BranchID
    AND s.Role IN ('Student', 'Freshman')
WHERE 
    d.DepartmentID =?
GROUP BY 
    b.BranchName;
;
 ";
        return $this->getData($sql, [$departmentID]);
    }
    public function  getCoursesCountINCertainDepartment($departmentID)
    {
        $sql = "SELECT COUNT(DISTINCT CourseID) AS CoursesCount
FROM courses
WHERE FIND_IN_SET(?, REPLACE(DepartmentID, '/', ',')) > 0;

;
 ";
        return $this->getData($sql, [$departmentID]);
    }
    public function studentCountByDepartment($departmentID)
    {
        $sql = "SELECT DepartmentID, COUNT(*) AS StudentCount
                FROM users u
                WHERE u.Role IN ('Student','Freshman') and DepartmentID=? ";
        return $this->getData($sql, [$departmentID]);
    }
    public function   getRegisteredStudentCountByDepartment($departmentID)
    {
        $sql = "SELECT 
    YEAR(CreatedAt) AS Year,
    COUNT(*) AS departmentCount,
    SUM(COUNT(*)) OVER (ORDER BY YEAR(CreatedAt)) AS CumulativedepartmentCount
FROM 
    users
WHERE 
    DepartmentID = ?
    AND Role IN ('Student','Freshman')
    
GROUP BY 
    YEAR(CreatedAt)
ORDER BY 
    Year;

 ";
        return $this->getData($sql, [$departmentID]);
    }
    public function getAllRooms($departmentID)
    {
        $sql = "SELECT
    d.DepartmentName,
    b.BranchName,
    r.RoomName,
    r.RoomID,
    b.BranchID
FROM
    departments d
JOIN
    faculty_branches fb ON d.FacultyID = fb.FacultyID
JOIN
    branches b ON fb.BranchID = b.BranchID
JOIN
    rooms r ON b.BranchID = r.BranchID
WHERE
    d.DepartmentID = ?;  -- Replace ? with the actual DepartmentID
";
        return $this->getData($sql, [$departmentID]);
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
    public function  getAllEvents()
    {
        $sql = "SELECT 
    e.*,  
    b.BranchName, 
    u.UserName
FROM 
    events e
LEFT JOIN 
    branches b ON e.BranchID = b.BranchID
LEFT JOIN 
    users u ON e.CreatedBy = u.UserID;

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
