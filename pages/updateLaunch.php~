<?php

include_once 'db.connect.php';
error_reporting(E_ERROR | E_PARSE);


$satellite_model  = $_POST['Model'];
$satellite_name  = $_POST['Name'];
$launch_latitiude  = $_POST['Lati'];
$launch_longitude  = $_POST['Longi'];
$launch_date = $_POST['Date'];
$company_id = 1; //1 for now but will get this from the cookie when it is done
$typePending = "Pending";

//update data in Satellite table

$sql = "UPDATE Satellites
SET satellite_id = null, company_id = '$company_id', satellite_name = '$satellite_name', satellite_model = '$satellite_model', types = '$typePending'
WHERE"; 

//determine satellite id

$satID = mysqli_query($link,"SELECT satellite_id FROM Satellites ");
$array = array();
$count=0;
while($row = mysqli_fetch_array($satID)){
  // add each row returned into an array
  $array[] = $row;
  $count++;
}

$size = sizeof($array)-1;
//print_r($array); // show all array data
//echo $array[$size]["satellite_id"];
$info = $array[$size]["satellite_id"]+1;
//echo $info; 

//update data in Pending Launch Satellite table

$sqlTwo = "UPDATE Pending 
SET pid = null, satellite_id = '$info', pending_date = '$launch_date', pending_latitude = '$launch_latitiude', pending_longitude = '$launch_longitude'
WHERE"; 

//if data is entered successfully we rendeer the same page 
if ($link->query($sql) === TRUE && $link->query($sqlTwo) ===TRUE) {
  header("Location: /pages/insertSatellite.php?status=success");


} else {
  echo "Error: " . $sql . "<br>" . $link->error;
  echo "Error: " . $sqlTwo . "<br>" . $link->error;

}

$link->close();

?>
