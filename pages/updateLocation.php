<?php

include_once 'db.connect.php';
error_reporting(E_ERROR | E_PARSE);

$satellite_name = $_POST['Name']
$satellite_model  = $_POST['Model'];
$satellite_id  = $_POST['id'];
$latitiude  = $_POST['Lati'];
$longitude  = $_POST['Longi'];
$launch_date = $_POST['Date'];
$company_id = 1; //1 for now but will get this from the cookie when it is done
$typeLaunched = "In-Orbit";
$altitude= $_POST["Alt"];
$inclination= $_POST["Incl"];
$launch_location = $_POST["Location"];

//update data in Satellite table

$sql = "UPDATE Satellites
SET satellite_model = '$satellite_model';
WHERE satellite_name = '$satellite_name"; 

//update data in In-Orbit Satellite table

$sqlTwo = "UPDATE Orbit 
SET latitude = '$latitiude', longitude = '$longitude', altitude = '$altitude', inclination = '$inclination'
WHERE"; 

if ($link->query($sql) === TRUE && $link->query($sqlTwo) ===TRUE) {
  header("Location: /pages/insertSatellite.php?status=success");
} else {
  echo "Error: " . $sql . "<br>" . $link->error;
  echo "Error: " . $sqlTwo . "<br>" . $link->error;
}

$link->close();

?>
