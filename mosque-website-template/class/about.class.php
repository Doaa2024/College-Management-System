<?php
require_once('DAL.class.php');

class About extends DAL
{

    function getAbout()
    {
        $sql = "SELECT * FROM about ";

        return $this->getdata($sql);
    }
    function presidentName()
    {
        $sql = "SELECT Username FROM users where Role='President' ";

        return $this->getdata($sql);
    }
}
