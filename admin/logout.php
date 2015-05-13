<?php
// plug the config
include ('../app/config.php');

#include ('../app/classes/Printer.php');
#include ('../app/classes/Session.php');

// plug the functions
include ('../app/functions.php');
Logger::laydown($_SERVER['REQUEST_URI']);

$objSession = new Session();
$objSession->start();
$objSession->destroy();


Logger::write();
header("Location: http://" . SERVER_NAME . SUBFOLDER_PATH);

?>