<?php
require('../DAL/retrieve.class.php');

$dal = new UniversityDataRetrieval();
$employers = $dal->getCurrentEmployers();

header('Content-Type: application/json');
echo json_encode($employers);
