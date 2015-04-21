<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');
include ('../app/classes/Database.php');

$objSession = new Session();
$objSession->start();



// plug the config
include ('../app/config.php'); 


// connect to DB
Database::connect();
    
//Printer::printnow();

$objSession->defineStatus();
Database::disconnect();

include ('../tpl/admin_default.tpl.php');

?>