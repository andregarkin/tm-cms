<?php
include ('app/classes/Session.php');

$objSession = new Session();
$objSession->start();



// plug the config
include ('app/config.php'); 

// Connect to DB
//$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
//$dbObject->exec('SET CHARACTER SET utf8');



    
$objSession->printnow();

$objSession->defineStatus();

include ('tpl/index.tpl.php');