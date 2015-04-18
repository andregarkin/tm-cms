<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');

$objSession = new Session();
$objSession->start();



// plug the config
include ('../app/config.php'); 


$objSession->destroy();


header("Location: http://" . SERVER_NAME . SUBFOLDER_PATH);

?>