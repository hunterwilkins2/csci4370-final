<?php

require(__DIR__ . '/../util/db.connect.php');

$satellite_model  = $_POST['Model'];
$satellite_name  = $_POST['Name'];
$launch_latitiude  = $_POST['Lati'];
$launch_longitude  = $_POST['Longi'];
$launch_date = $_POST['Date'];
$company_id = $_COOKIE['cid']; //1 for now but will get this from the cookie when it is done
$typePending = "Pending";

//update data in Satellite table

$sql = "UPDATE Satellites
SET model = '".$satellite_model."'
WHERE satellite_name = '".$satellite_name."'"; 

//update data in Pending Launch Satellite table

$sqlTwo = "UPDATE `Pending` P
SET pending_latitude = '".$launch_latitiude."', pending_longitude = '".$launch_longitude."', pending_date = '".$launch_date."'
WHERE P.satellite_id = (SELECT satellite_id FROM Satellites WHERE satellite_name = '".$satellite_name."')"; 



if(!$mysqli->query($sql)) {
  die("Error: Could not update satellite. " . $mysqli->error);
}

if(!$mysqli->query($sqlTwo)) {
  die("Error: Could not update satellite. " . $mysqli->error);
}

header("Location: ./updateSatellite.php?status=success");
?>

