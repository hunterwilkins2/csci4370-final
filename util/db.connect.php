<?php
    require('./DotEnv.php');

    (new DotEnv(__DIR__ . '/../.env'))->load();

    $mysqli = new mysqli(getenv("HOST"), getenv("USER"), getenv("PASSWORD"), getenv("DATABASE"));
?>