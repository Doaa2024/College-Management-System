<?php
require_once('DAL.class.php');

class School extends DAL
{
    function getSchools()
    {
        $sql = "SELECT * FROM schools_home";
        return $this->getdata($sql);
    }
}
