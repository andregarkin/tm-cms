<?php
include ('../app/classes/Session.php');




// plug the config
include ('../app/config.php'); 


$objSession = new Session();
$objSession->start();
$objSession->defineStatus();


include('../tpl/about.tpl.php');