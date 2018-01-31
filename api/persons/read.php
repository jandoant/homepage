<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/DbHandler.php';

//Find out wether a single person or all persons are requested
$requested_person_id = $_GET['id']; 

// instantiate database and product object
$dbh = new DbHandler();
$dbh->connect();

// Personen-Array aus DB laden
$persons_arr = $dbh->read_persons($requested_person_id);

//Personen-Liste als JSON-Objekt ausgeben
echo json_encode($persons_arr);

$dbh->disconnect();
?>
