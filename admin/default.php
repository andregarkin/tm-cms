<?php
// plug the config
include ('../app/config.php');

#include ('../app/classes/Printer.php');
#include ('../app/classes/Session.php');
#include ('../app/classes/Database.php');

// plug the functions
include ('../app/functions.php');
Logger::laydown($_SERVER['REQUEST_URI']);


$objSession = new Session();
$objSession->start();


$objSession->defineStatus();

/* Page Title */
$curr_page_title = 'Admin Default';

Logger::write();
include ('../tpl/admin_default.tpl.php');

?>