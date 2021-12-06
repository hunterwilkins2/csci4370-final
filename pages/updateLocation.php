<?php

require(__DIR__ . '/../util/db.connect.php');

$satellite_name = $_POST['Name'];
$satellite_model  = $_POST['Model'];
$satellite_id  = $_POST['id'];
$latitiude  = $_POST['Lati'];
$longitude  = $_POST['Longi'];
$launch_date = $_POST['Date'];
$company_id = $_COOKIE['cid']; //1 for now but will get this from the cookie when it is done
$typeLaunched = "In-Orbit";
$altitude= $_POST["Alt"];
$inclination= $_POST["Incl"];
$launch_location = $_POST["Location"];

//update data in Satellite table

$sql = "UPDATE Satellites
SET model = '".$satellite_model."'
WHERE satellite_name = '".$satellite_name."'"; 

//update data in In-Orbit Satellite table

$sqlTwo = "UPDATE `In-Orbit` I
SET launch_latitude = '".$latitiude."', launch_longitude = '".$longitude."', altitude = '".$altitude."', inclination = '".$inclination."'
WHERE I.satellite_id = (SELECT satellite_id FROM Satellites WHERE satellite_name = '".$satellite_name."')"; 

if(!$mysqli->query($sql)) {
  die("Error: Could not update satellite. " . $mysqli->error);
}

if(!$mysqli->query($sqlTwo)) {
  die("Error: Could not update satellite. " . $mysqli->error);
}

header("Location: ./updateSatellite.php?status=success");
?>
