<?php
require('dal.class.php');

class UserManagement extends DAL
{
    public function insertOptionalNewsletter($title, $issueDate, $content, $createdBy)
    {
        $sql = "INSERT INTO optionalnewsletter (Title, IssueDate, Content, CreatedBy) VALUES (?, ?, ?, ?)";
        $this->execute($sql, [$title, $issueDate, $content, $createdBy]);
    }

    public function insertObligatoryNewsletter($title, $issueDate, $content, $createdBy)
    {
        $sql = "INSERT INTO obligatorynewsletter (Title, IssueDate, Content, CreatedBy) VALUES (?, ?, ?, ?)";
        $this->execute($sql, [$title, $issueDate, $content, $createdBy]);
    }
    public function  remove_course($courseid)
    {
        // Remove a branch by setting its status to 'Inactive' or by deleting it
        $sql = "delete from courses WHERE CourseID = ?";
        return $this->execute($sql, [$courseid]);
    }
    public function remove_courseFromDepartment($courseID, $departmentID)
    {
        // Step 1: Retrieve the current departments associated with the course
        $sqlSelect = "SELECT DepartmentID FROM courses WHERE CourseID = ?";
        $currentDepartments = $this->getData($sqlSelect, [$courseID]);

        if ($currentDepartments) {
            // Explode the DepartmentID string to an array
            $departmentsArray = explode('/', $currentDepartments[0]['DepartmentID']);

            // Step 2: Remove the specific department ID from the array
            $updatedDepartmentsArray = array_filter($departmentsArray, function ($id) use ($departmentID) {
                return $id != $departmentID;
            });

            // Step 3: Implode the array back into a string
            $updatedDepartmentsString = implode('/', $updatedDepartmentsArray);

            // Step 4: Update the course with the new department string
            $sqlUpdate = "UPDATE courses SET DepartmentID = ? WHERE CourseID = ?";
            return $this->execute($sqlUpdate, [$updatedDepartmentsString, $courseID]);
        }

        // If the course or department ID was not found, return false or handle the error accordingly
        return false;
    }
    public function add_CourseInDepartment($courseID, $departmentID)
    {
        // Update the existing DepartmentID by appending the new departmentID with a slash
        $sql = "UPDATE courses 
                SET DepartmentID = CONCAT(DepartmentID, '/', ?) 
                WHERE CourseID = ? 
                AND FIND_IN_SET(?, REPLACE(DepartmentID, '/', ',')) = 0"; // Check to ensure it does not already exist

        // Execute the query with the departmentID and courseID
        return $this->execute($sql, [$departmentID, $courseID, $departmentID]);
    }
    public function checkcourse($courseID, $departmentID)
    {
        // Using FIND_IN_SET to check if the courseID exists for the given departmentID
        $sql = "SELECT 
                    *
                FROM 
                    courses 
                WHERE 
                    CourseID = ? 
                    AND FIND_IN_SET(?, REPLACE(DepartmentID, '/', ',')) > 0;";

        return $this->getData($sql, [$courseID, $departmentID]);
    }


    public function add_course($name, $code, $credits)
    {
        $sql = "INSERT INTO courses (CourseName, CourseCode, Credits) VALUES (?, ?, ?)";
        return $this->execute($sql, [$name, $code, $credits]);
    }
    public function updateUserPassword($id, $hashedPassword)
    {
        // SQL query to update the user's password in the `users` table
        $sql = "UPDATE users 
                SET Password = ?
                WHERE UserID = ?";

        // Execute the query with the provided parameters
        return $this->execute($sql, [$hashedPassword, $id]);
    }

    public function  getCourseNameCode($id, $coursename, $coursecode)
    {
        $sql = "SELECT CourseName, CourseCode 
FROM courses
WHERE (CourseName = ? OR CourseCode = ?)
  AND CourseID != ?
";
        return $this->getdata($sql, [$coursename, $coursecode, $id]);
    }
    public function checkAssessmentTypeAndWeight($CourseCode, $AssessmentType)
    {
        // Query to get the total weight of all assessment types for the course
        // and check if the specific assessment type exists.
        $sql = "
        SELECT 
            (SELECT SUM(gs.Weight) 
             FROM gradestructures gs
             WHERE gs.CourseID = (SELECT CourseID FROM courses WHERE CourseCode = ?)) AS TotalWeight,
            COUNT(gs.AssessmentType) AS AssessmentExists
        FROM gradestructures gs
        WHERE gs.CourseID = (SELECT CourseID FROM courses WHERE CourseCode = ?)
          AND gs.AssessmentType = ?
        GROUP BY gs.CourseID";

        return $this->getdata($sql, [$CourseCode, $CourseCode, $AssessmentType]);
    }
    public function checkAssessmentTypeExists($CourseCode, $AssessmentType)
    {
        $sql = "SELECT COUNT(*) AS AssessmentExists
                FROM gradestructures gs
                WHERE gs.CourseID = (SELECT CourseID FROM courses WHERE CourseCode = ?)
                  AND gs.AssessmentType = ?";

        return $this->getdata($sql, [$CourseCode, $AssessmentType]);
    }
    public function deleteGradeStructureByCourseCode($CourseID)
    {
        $sql = "DELETE FROM gradestructures WHERE CourseID =?";
        return $this->execute($sql, [$CourseID]);
    }

    public function addGradeStructure($CourseCode, $AssessmentType, $Weight)
    {
        $sql = "INSERT INTO gradestructures (CourseID, AssessmentType, Weight, CreatedAt)
            VALUES ((SELECT CourseID FROM courses WHERE CourseCode = ?), ?, ?, NOW())";

        return $this->execute($sql, [$CourseCode, $AssessmentType, $Weight]);
    }
    public function addNewGradeStructure($CourseID, $AssessmentType, $Weight)
    {
        $sql = "INSERT INTO gradestructures (CourseID, AssessmentType, Weight, CreatedAt)
            VALUES (?, ?, ?, NOW())";

        return $this->execute($sql, [$CourseID, $AssessmentType, $Weight]);
    }
    public function  getCourseNameCodeAdd($coursename, $coursecode)
    {
        $sql = "SELECT CourseName, CourseCode 
        FROM courses
        WHERE CourseName=? OR CourseCode=?
";
        return $this->getdata($sql, [$coursename, $coursecode]);
    }
    public function  getCourseInfo($CourseID, $CourseName, $CourseCode, $CourseCredits)
    {
        $sql = "SELECT *
FROM courses
WHERE CourseID=? AND CourseName=? AND CourseCode=? AND Credits=?;
";
        return $this->getdata($sql, [$CourseID, $CourseName, $CourseCode, $CourseCredits]);
    }
    public function updateCourseInfo($id, $coursename, $coursecode, $coursecredits)
    {
        // SQL query to update the user's password in the `users` table
        $sql = "UPDATE courses
                SET CourseName = ?,
                CourseCode=?,
                Credits=?
                WHERE CourseID = ?";

        // Execute the query with the provided parameters
        return $this->execute($sql, [$coursename, $coursecode, $coursecredits, $id]);
    }
}
