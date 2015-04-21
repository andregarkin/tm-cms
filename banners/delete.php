<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');
include ('../app/classes/Database.php');
include ('../app/classes/Banner.php');
include ('../app/classes/Validator.php');


// plug the config
include ('../app/config.php'); 


$objSession = new Session();
$objSession->start();
$objSession->defineStatus();

    
if (false == LOGGED) {
  // go home
  header("Location: http://" . SERVER_NAME . SUBFOLDER_PATH);
}

if (LOGGED) {
  // show form to DELETE banner
  
  $id = null;
  
  if (empty($_GET['id']) && empty($_POST['id'])) {
    header("Location: list.php");
  }
   
  if ( !empty($_GET['id'])) {
      $id = $_REQUEST['id'];
  }
  
   
  if ( !empty($_POST['id'])) {
    
    //Printer::printnow($_POST, '$_POST');
    //Printer::gettype($_POST['id']);
  
    // keep track post values
    $id = $_POST['id'];
     
    // delete data
    $pdo = Database::connect();
    $objBanner = new Banner($pdo);
    $res = $objBanner->delete($id);
    
    //Printer::printnow($res, '$res');
    
    if ($res) {
      $msg_delete_status = "Banner was deleted!";
      $msg_class = ' text-success';
    } else {
      $msg_delete_status = "Can't delete the entry. Something was wrong.";
      $msg_class = ' text-danger';
    }
    
    Database::disconnect();
    
    //header("Location: list.php");
     
  }
  
  
  include ('../tpl/banners_delete.tpl.php');
  
}