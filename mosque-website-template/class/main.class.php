<?php
require_once('DAL.class.php');

class Main extends DAL
{
    function getAllInfo()
    {
        $sql = "SELECT * FROM moreinfo";
        return $this->getdata($sql);
    }
    function getAllDetails()
    {
        $sql = "SELECT * FROM home";
        return $this->getdata($sql);
    }
    function getEvents()
    {
        $sql = "SELECT * FROM events ORDER BY RAND() LIMIT 3";

        return $this->getdata($sql);
    }
}
