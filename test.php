<?php

$persons = array();

$person_1 = array(
    "id"=>1,
    "firstname"=>"Jan",
    "lastname"=>"Doant", 
    "event_attendances"=>array(
        //Event 1
        array("event_id"=>1,"status"=>1, "info"=>"Bin dabei!"), 
        //Event 2
        array("event_id"=>2,"status"=>2, "info"=>"Liege krank im Bett"),
        )
);

$person_2 = array("id"=>2,"firstname"=>"Marvin","lastname"=>"Kreische");

$persons["players"] = array($person_1, $person_2);
echo json_encode($persons); 