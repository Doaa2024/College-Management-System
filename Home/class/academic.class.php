<?php
require_once('DAL.class.php');

class Academic extends DAL
{

    function getFreshman()
    {
        $sql = "SELECT * FROM freshman ";

        return $this->getdata($sql);
    }

    function getSchool()
    {
        $sql = "SELECT * FROM school ";

        return $this->getdata($sql);
    }
}
