<?php
require('dal.class.php');

class UserManagement extends DAL
{
    public function edit_creditPrice($facultyID, $newCreditFee)
    {
        $sql = "UPDATE faculties SET CreditFee = ? WHERE FacultyID = ?";
        return $this->execute($sql, [$newCreditFee, $facultyID]);
    }

}
