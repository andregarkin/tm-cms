<?php
include ('../app/classes/Printer.php');
include('../app/classes/Iframe.php');
include ('../app/classes/Sitemap.php');
include ('../app/classes/Database.php');
include ('../app/classes/Banner.php');

//include ('../app/classes/Session.php');




// Get Banner for iframe by current Page ID 

// plug the config
include ('../app/config.php'); 
    

Printer::printnow($_GET, '$_GET');

Printer::printnow($_SERVER['HTTP_REFERER'], '$_SERVER[HTTP_REFERER]');

// Need Referer Link, eg:  '/' | 'index.php' | 'products.php' , etc.
$referer_link = Iframe::getRefererLink();
Printer::printnow($referer_link, '$referer_link'); //  '/' | 'index.php' | 'products.php'

// Sitemap - get Page ID by Site Page link: '/' | 'index.php' | 'products.php'
$page_id = Sitemap::getPageID($referer_link); // int | false
//$page_id = false;

if ($page_id) {
  
  // Banner - get Content By Page ID
  $pdo = Database::connect();
  $objBanner = new Banner($pdo);
  $banner_content = $objBanner->getContentByPageID($page_id); // false | 'html'
  
}

if (empty($banner_content) || false == $banner_content) {
  $banner_content = 'On this page can be placed your banner';
}
  
  
include ('../tpl/banners_banner.tpl.php');
