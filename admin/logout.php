<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');

// plug the config
include ('../app/config.php'); 


$objSession = new Session();
$objSession->start();
$objSession->destroy();


header("Location: http://" . SERVER_NAME . SUBFOLDER_PATH);

?>