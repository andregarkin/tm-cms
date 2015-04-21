<?php
include ('../app/classes/Session.php');




// plug the config
include ('../app/config.php'); 


$objSession = new Session();
$objSession->start();
$objSession->defineStatus();



include('../tpl/twitter-bootstrap.tpl.php');