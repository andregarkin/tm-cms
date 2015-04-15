<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');
include ('../app/classes/Database.php');
include ('../app/classes/Banner.php');


$objSession = new Session();
$objSession->start();

// plug the config
include ('../app/config.php'); 
    
//$objSession->printnow();
$objSession->defineStatus();

    
if (false == LOGGED) {
  // go home
  header("Location: http://" . SERVER_NAME . SUBFOLDER_PATH);
}

if (LOGGED) {
  // show form to READ banner
  
  $id = null;
  if ( !empty($_GET['id'])) {
      $id = $_REQUEST['id'];
      Printer::printnow($_REQUEST, '$_REQUEST');
  }
   
  if ( null==$id ) {
      header("Location: list.php");
  } else {
      // connect to DB
      $pdo = Database::connect();
      $objBanner = new Banner($pdo);
      $res = $objBanner->read($id);
      
      Database::disconnect();
      
      Printer::printnow($res, '$res');
      Printer::gettype($res);
      
      if (!$res) {
        $msg_read_status = "Can't read the entry. Something was wrong.";
        $msg_class = ' text-danger';
        
        $row = array('id'=>null, 'title'=>'empty', 'content'=>'empty', 'option_display'=>'empty', );
      }
      else {
        $row = $res;
      }
  }
  
  include ('../tpl/banners_read.tpl.php');
  
}