<?php
require_once('DAL.class.php');

class Offers extends DAL
{

    function getJobsOffers()
    {
        $sql = "SELECT * FROM available_jobs ";

        return $this->getdata($sql);
    }
}
