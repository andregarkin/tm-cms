<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');
include ('../app/classes/Page.php');
include ('../app/classes/Sitemap.php');


// plug the config
include ('../app/config.php'); 


$objSession = new Session();
$objSession->start();
$objSession->defineStatus();

/* Page Title */
$curr_page_link = Page::getCurrentLink(); // eg: '/index.php'
$curr_page_title = Sitemap::getPageTitle($curr_page_link); // eg: 'Home'

include('../tpl/about.tpl.php');