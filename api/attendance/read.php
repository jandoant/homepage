<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';

// instantiate database and product object
$db = new Database();
$db->open();

$result = $db->read_attendance(); 

echo json_encode($result); 