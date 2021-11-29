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


$sql = "INSERT INTO Satellites (satellite_id, company_id, satellite_name, model, types)
VALUES (null, '$company_id', '$satellite_name', '$satellite_model', '$typePending')"; 

//insert data into satellite table for launch pending satellite 


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

$sqlTwo = "INSERT INTO Pending (pid, satellite_id, pending_date, pending_latitude, pending_longitude)
VALUES (null, '$info', '$launch_date', '$launch_latitiude', '$launch_longitude')";
//inserts data into the pending satellite table


//if dara is entered successfully we rendeer the same page 
if ($link->query($sql) === TRUE && $link->query($sqlTwo) ===TRUE) {
  header("Location: /pages/insertSatellite.php?status=success");


} else {
  echo "Error: " . $sql . "<br>" . $link->error;
  echo "Error: " . $sqlTwo . "<br>" . $link->error;

}

$link->close();


?>