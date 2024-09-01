<?php
require_once('DAL.class.php');

class Addmission extends DAL
{

    function getTransfer()
    {
        $sql = "SELECT * FROM transfer ";

        return $this->getdata($sql);
    }

    function getRequirments()
    {
        $sql = "SELECT * FROM admissionrequirements ";

        return $this->getdata($sql);
    }
}
