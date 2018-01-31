<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/DbHandler.php';

// instantiate database and product object
$dbh = new DbHandler();
$dbh->connect();

$result = $dbh->read_attendance(); 

$dbh->disconnect();

echo json_encode($result); 