<?php
include ('app/classes/Printer.php');
include ('app/classes/Session.php');
include ('app/classes/Page.php');
include ('app/classes/Sitemap.php');

$objSession = new Session();
$objSession->start();



// plug the config
include ('app/config.php'); 

// Connect to DB
//$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
//$dbObject->exec('SET CHARACTER SET utf8');



    
$objSession->printnow();

$objSession->defineStatus();

/* Page Title */
$curr_page_link = Page::getCurrentLink();
// eg: $curr_page_title = 'Home';
$curr_page_title = Sitemap::getPageTitle($curr_page_link);



//$curr_page_id = 1;

include ('tpl/index.tpl.php');