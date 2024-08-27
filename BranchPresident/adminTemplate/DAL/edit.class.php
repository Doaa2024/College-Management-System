<?php
require('dal.class.php');

class UserManagement extends DAL
{
    public function updateAttestationStatus($newStatus, $studentId)
    {
        // Define the SQL query
        $sql = "UPDATE attestations SET status = ? WHERE id = ?";

        // Execute the query with parameters
        return $this->execute($sql, [$newStatus, $studentId]);
    }
    public function deleteAttestation($id)
    {
        $sql = "DELETE FROM attestations WHERE id = ?";
        return $this->execute($sql, [$id]);
    }
    public function updatePetitionStatus($newStatus, $studentId)
    {
        // Define the SQL query
        $sql = "UPDATE petitions SET status = ? WHERE id = ?";

        // Execute the query with parameters
        return $this->execute($sql, [$newStatus, $studentId]);
    }
    public function deletePetition($id)
    {
        $sql = "DELETE FROM petitions WHERE id = ?";
        return $this->execute($sql, [$id]);
    }
    public function updateFA($FA, $studentId)
    {
        // Define the SQL query
        $sql = "UPDATE financial_aids SET aid_amount = ? WHERE id = ?";

        // Execute the query with parameters
        return $this->execute($sql, [$FA, $studentId]);
    }
    public function deleteFA($id)
    {
        $sql = "DELETE FROM financial_aids WHERE id = ?";

        return $this->execute($sql, [$id]);
    }
    public function addDepartment($departmentName, $facultyID, $branchID)
    {
        $sql = "INSERT INTO departments (DepartmentName, FacultyID) VALUES (?, ?)";
        $params = [$departmentName, $facultyID];

        // Execute the query and return the result
        return $this->execute($sql, $params);
    }
    public function updateDepartment($departmentID, $departmentName, $facultyID)
    {
        // Define the SQL query to update the department
        $sql = "
            UPDATE departments
            SET DepartmentName = ?, FacultyID = ?
            WHERE DepartmentID = ?
        ";

        // Define the parameters for the query
        $params = [$departmentName, $facultyID, $departmentID];

        // Execute the query
        return $this->execute($sql, $params);
    }
    public function deleteDepartment($departmentID)
    {
        $sql = "DELETE FROM departments WHERE DepartmentID = ?";
        $params = [$departmentID];

        try {
            $this->execute($sql, $params);
            return true;
        } catch (PDOException $e) {
            // Log error and return false
            error_log($e->getMessage());
            return false;
        }
    }
    public function searchStudentByID($userID, $branchID)
    {
        $sql = "SELECT * FROM users 
            WHERE UserID = ? 
            AND Role = 'Student'
            AND BranchID = ?";

        return $this->getData($sql, [$userID, $branchID]);
    }

    public function searchEmployeeByID($userID, $branchID)
    {
        $sql = "SELECT * FROM users 
            WHERE UserID = ? 
            AND Role != 'Student'
            AND BranchID = ?";

        return $this->getData($sql, [$userID, $branchID]);
    }
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
}
