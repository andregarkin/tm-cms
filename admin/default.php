<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');
include ('../app/classes/Database.php');


// plug the config
include ('../app/config.php'); 

$objSession = new Session();
$objSession->start();


$objSession->defineStatus();


include ('../tpl/admin_default.tpl.php');

?>