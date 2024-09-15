<?php
require_once('DAL.class.php');

class Calender extends DAL
{

    function getCalender()
    {
        $sql = "SELECT 
    EventName, 
    EventDate, 
    BranchName, 
    StartTime 
FROM 
    events 
JOIN 
    branches 
ON 
    events.BranchID = branches.BranchID;
 ";

        return $this->getdata($sql);
    }
}
