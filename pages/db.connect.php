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



?>