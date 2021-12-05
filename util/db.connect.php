<?php
    require('DotEnv.php');

    (new DotEnv(__DIR__ . '/../.env'))->load();

    $mysqli = new mysqli(getenv("HOST"), getenv("USER"), getenv("PASSWORD"), getenv("DATABASE"), getenv("PORT"));
    error_reporting(E_ERROR | E_PARSE);

    // Check connection
    if ($mysqli -> connect_errno) {

        die("ERROR: Could not connect to the database. " . $mysqli->connect_error);
    }
?>