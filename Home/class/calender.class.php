<?php
require_once('DAL.class.php');

class Calender extends DAL
{

    function getCalender()
    {
        $sql = "SELECT EventName, EventDate, StartTime FROM events ";

        return $this->getdata($sql);
    }
}
