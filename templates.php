<?php
include ('app/classes/Printer.php');
include ('app/classes/Session.php');
include ('app/classes/Page.php');
include ('app/classes/Sitemap.php');


$objSession = new Session();
$objSession->start();


// plug the config
include ('app/config.php'); 

$objSession->defineStatus();

/* Page Title */
$curr_page_link = Page::getCurrentLink();
// eg: $curr_page_title = 'Home';
$curr_page_title = Sitemap::getPageTitle($curr_page_link);

include ('tpl/templates.tpl.php');