<?php
include ('../app/classes/Session.php');
include ('../app/classes/Database.php');

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
  
  $pdo = Database::connect();
  $sql = 'SELECT `id`, `title`, `content`, `option_display` FROM `tmcms_tbanners` ORDER BY `id` ASC';
  
  include ('../tpl/banners_list.tpl.php');  
}
      




?>