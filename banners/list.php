<?php
include ('../app/classes/Session.php');
include ('../app/classes/Database.php');
include ('../app/classes/Banner.php');
include ('../app/classes/Printer.php');

$objSession = new Session();
$objSession->start();



// plug the config
include ('../app/config.php'); 

    
$objSession->printnow();

$objSession->defineStatus();

    
if (false == LOGGED) {
  // go home
  header("Location: http://" . SERVER_NAME . SUBFOLDER_PATH);
}

if (LOGGED) {
  // show banners list 
  
  // connect to DB
  //$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
  //$dbObject->exec('SET CHARACTER SET utf8');  
  
  $pdo = Database::connect(); // PDO object
  
  $objBanner = new Banner($pdo);
  $arrBanners = $objBanner->read(); // array | false
  
  //Printer::printnow($arrBanners, '$arrBanners');
    /*Array
(
    [0] => Array
        (
            [id] => 1
            [title] => Banner First
            [content] => 
First Lorem ipsum dolor

            [option_display] => 1
        )
)*/
  Database::disconnect();
  
  include ('../tpl/banners_list.tpl.php');  
}
      




?>