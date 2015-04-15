<?php
include ('../app/classes/Session.php');

$objSession = new Session();
$objSession->start();


// plug the config
include ('../app/config.php'); 

$objSession->defineStatus();


include('../tpl/about.tpl.php');