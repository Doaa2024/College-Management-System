<?php
require('dal.class.php');

class UserManagement extends DAL
{
    public function edit_creditPrice($facultyID, $newCreditFee)
    {
        $sql = "UPDATE faculties SET CreditFee = ? WHERE FacultyID = ?";
        return $this->execute($sql, [$newCreditFee, $facultyID]);
    }

    public function edit_BranchHead($branchID, $newBranchHeadID)
    {
        $sql = "UPDATE branches SET BranchHeadID = ? WHERE BranchID = ?";
        return $this->execute($sql, [$newBranchHeadID, $branchID]);
    }

    public function edit_facultyHead($facultyID, $newFacultyHeadID)
    {
        $sql = "UPDATE facultyheads SET FacultyHeadID = ? WHERE FacultyID = ?";
        return $this->execute($sql, [$newFacultyHeadID, $facultyID]);
    }

    public function edit_departementHead($departmentID, $newDepartmentHeadID)
    {
        $sql = "UPDATE departmentheads SET DepartmentHeadID = ? WHERE DepartmentID = ?";
        return $this->execute($sql, [$newDepartmentHeadID, $departmentID]);
    }

    public function add_faculty($facultyName, $creditFee)
    {
        $sql = "INSERT INTO faculties (FacultyName, CreditFee) VALUES (?, ?)";
        return $this->execute($sql, [$facultyName, $creditFee]);
    }

    public function remove_faculty($facultyID)
    {
        $sql = "DELETE FROM faculties WHERE FacultyID = ?";
        return $this->execute($sql, [$facultyID]);
    }

    public function add_department($departmentName)
    {
        $sql = "INSERT INTO departments (DepartmentName) VALUES (?)";
        return $this->execute($sql, [$departmentName]);
    }

    public function remove_department($departmentID)
    {
        $sql = "DELETE FROM departments WHERE DepartmentID = ?";
        return $this->execute($sql, [$departmentID]);
    }

    public function add_user($username, $password, $email, $role, $branchID = null, $facultyID = null, $departmentID = null)
    {
        $sql = "INSERT INTO users (Username, Password, Email, Role, BranchID, FacultyID, DepartmentID, Status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, 'Active')";
        return $this->execute($sql, [$username, $password, $email, $role, $branchID, $facultyID, $departmentID]);
    }

    public function remove_user($userID)
    {
        $sql = "UPDATE users SET Status = 'Inactive' WHERE UserID = ?";
        return $this->execute($sql, [$userID]);
    }
    public function remove_branch($branchID)
    {
        // Remove a branch by setting its status to 'Inactive' or by deleting it
        $sql = "delete from branches WHERE BranchID = ?";
        return $this->execute($sql, [$branchID]);
    }

    public function add_branch($branchName, $branchLocation)
    {
        $sql = "INSERT INTO branches (BranchName, Location) VALUES (?, ?)";
        return $this->execute($sql, [$branchName, $branchLocation]);
    }
    public function edit_branch($branchID, $branchName, $branchLocation)
    {
        $sql = "UPDATE branches SET BranchName = ?, Location = ? WHERE BranchID = ?";
        return $this->execute($sql, [$branchName, $branchLocation, $branchID]);
    }
    public function updateFacultyCreditFee($facultyID, $newCreditFee)
    {
        $sql = "UPDATE faculties SET CreditFee = ? WHERE FacultyID = ?";
        $params = [$newCreditFee, $facultyID];

        // Use the execute method to run the update query
        return $this->execute($sql, $params);
    }
    public function updateFacultyHead($facultyID, $newHeadUserID)
    {
        $sql = "UPDATE facultyheads SET FacultyHeadID = ? WHERE FacultyID = ?";
        $params = [$newHeadUserID, $facultyID];

        return $this->execute($sql, $params);
    }
    public function updateFacultyBranch($facultyID, $newBranchID)
    {
        $sql = "UPDATE faculties SET BranchID = ? WHERE FacultyID = ?";
        $params = [$newBranchID, $facultyID];

        return $this->execute($sql, $params);
    }
    public function updateDepartmentHead($departmentID, $newHeadUserID)
    {
        $sql = "UPDATE departmentheads SET DepartmentHeadID = ? WHERE DepartmentID = ?";
        $params = [$newHeadUserID, $departmentID];

        return $this->execute($sql, $params);
    }
    public function updateDepartmentName($departmentID, $newDepartmentName)
    {
        $sql = "UPDATE departments SET DepartmentName = ? WHERE DepartmentID = ?";
        $params = [$newDepartmentName, $departmentID];

        return $this->execute($sql, $params);
    }
    public function clearFacultyBranches($facultyID)
    {
        // SQL query to remove all branches associated with the given faculty
        $sql = "DELETE FROM faculties WHERE FacultyID = ?";

        // Execute the query with the provided faculty ID
        return $this->execute($sql, [$facultyID]);
    }
}
