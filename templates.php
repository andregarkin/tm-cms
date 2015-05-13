<?php
// plug the config
include ('app/config.php');

#include ('app/classes/Printer.php');
#include ('app/classes/Session.php');
#include ('app/classes/Database.php');
#include ('app/classes/Banner.php');
#include ('app/classes/Page.php');
#include ('app/classes/Sitemap.php');

// plug the functions
include ('app/functions.php');
Logger::laydown($_SERVER['REQUEST_URI']);

$objSession = new Session();
$objSession->start();
$objSession->defineStatus();

if (LOGGED) {
  
  
  if (!empty($_GET['s'])) {
    // get banners list by Search string
    $searchName = $_GET['s'];
    
    $pdo = Database::connect(); // PDO object
    
    $objBanner = new Banner($pdo);
    $arrBanners = $objBanner->searchByName($searchName); // array | false
    
    if (!$arrBanners) {
      $msg_search_status = 'Not found Banner with such title. Try another one.';
    }

    Database::disconnect();  
    
    //Printer::printnow($arrBanners, '$arrBanners');
    
  }
  
  
}



/* Page Title */
$curr_page_link = Page::getCurrentLink(); // eg: '/index.php'
$curr_page_title = Sitemap::getPageTitle($curr_page_link); // eg: 'Home'

Logger::write();
include ('tpl/templates.tpl.php');