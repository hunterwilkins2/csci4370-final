<?php


$user = 'root';
$password = '';
$db = 'FinalSatellite';
$host = 'localhost';
$port = 8889;

$link = mysqli_connect(
   "$host:$port",
   $user,
   $password
);
$db_selected = mysqli_select_db($link,$db);


// if($link){
//   echo "Connected";
// }
// else{
//   echo "Not Connected";
// }



$satellite_model = $satellite_name = $launch_latitude = $launch_longitude = $pending_launchDate = " " ;

$sql = "INSERT INTO Satellites (satellite_id, company_id, satellite_name, model, types)
VALUES (null, 1, 'Test Test', 't303c', 'Pending')";



if ($link->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $link->error;
}

$link->close();


?>