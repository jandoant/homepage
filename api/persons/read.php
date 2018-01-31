<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';

//Find out wether a single person or all persons are requested
$requested_person_id = $_GET['id']; 

// instantiate database and product object
$db = new Database();
$db->open();

// Personen-Array aus DB laden
$persons_arr = $db->read_persons($requested_person_id);

//Personen-Liste als JSON-Objekt ausgeben
echo json_encode($persons_arr);

$db->close(); 


?>
