<?php
// plug the config
include ('../app/config.php');

#include ('../app/classes/Session.php');

// plug the functions
include ('../app/functions.php');
Logger::laydown($_SERVER['REQUEST_URI']);



$objSession = new Session();
$objSession->start();
$objSession->defineStatus();


/* Page Title */
$curr_page_title = 'Twitter Bootstrap Page'; // eg: 'Home'

Logger::write();
include('../tpl/twitter-bootstrap.tpl.php');