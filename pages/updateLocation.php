<?php

include_once 'db.connect.php';
error_reporting(E_ERROR | E_PARSE);

$satellite_model  = $_POST['Model'];
$satellite_name  = $_POST['Name'];
$launch_latitiude  = $_POST['Lati'];
$launch_longitude  = $_POST['Longi'];
$launch_date = $_POST['Date'];
$company_id = 1; //1 for now but will get this from the cookie when it is done
$typeLaunched = "In-Orbit";
$launch_altitude= $_POST["Alt"];
$launch_inclination= $_POST["Incl"];

//update data in Satellite table

$sql = "UPDATE Satellites
SET satellite_name = '$satellite_name', satellite_model = '$satellite_model'
WHERE"; 

//update data in In-Orbit Satellite table

$sqlTwo = "UPDATE Orbit 
SET launch_date = '$launch_date', launch_latitude = '$launch_latitiude', launch_longitude = '$launch_longitude', altitude = '$launch_altitude', inclination = '$launch_inclination'
WHERE"; 

if ($link->query($sql) === TRUE && $link->query($sqlTwo) ===TRUE) {
  header("Location: /pages/insertSatellite.php?status=success");
} else {
  echo "Error: " . $sql . "<br>" . $link->error;
  echo "Error: " . $sqlTwo . "<br>" . $link->error;
}

$link->close();

?>
