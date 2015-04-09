<?php

include ('../app/config.php'); 


// Connect to DB
$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
$dbObject->exec('SET CHARACTER SET utf8');



include('../tpl/about.tpl.php');