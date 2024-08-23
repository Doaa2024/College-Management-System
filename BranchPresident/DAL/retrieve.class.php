<?php
require('dal.class.php');

class UniversityDataRetrieval extends DAL
{

    public function getAllStudents()
    {
        $sql = "SELECT * FROM users WHERE Role = 'Student' AND Status = 'Active'";
        return $this->getdata($sql, []);
    }

}
