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


$sql = "INSERT INTO Satellites (satellite_id, company_id, satellite_name, model, types)
VALUES (null, '$company_id', '$satellite_name', '$satellite_model', '$typeLaunched')";
//insert into Satellite Table

$satID = mysqli_query($link,"SELECT satellite_id FROM Satellites ");
$array = array();
$count=0;
while($row = mysqli_fetch_array($satID)){
  $array[] = $row;
  $count++;
}
$size = sizeof($array)-1;
$info = $array[$size]["satellite_id"]+1;

$sqlTwo = "INSERT INTO Orbit(orbital_id, satellite_id, launch_date, launch_latitude, launch_longitude, altitude, inclination)
VALUES (null, '$info', '$launch_date', '$launch_latitiude', '$launch_longitude', '$launch_altitude', '$launch_inclination')";

if ($link->query($sql) === TRUE && $link->query($sqlTwo) ===TRUE) {
  header("Location: /pages/insertSatellite.php?status=success");


} else {
  echo "Error: " . $sql . "<br>" . $link->error;
  echo "Error: " . $sqlTwo . "<br>" . $link->error;

}

$link->close();

 
?>