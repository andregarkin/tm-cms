<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');
include ('../app/classes/Database.php');
include ('../app/classes/Banner.php');
include ('../app/classes/Validator.php');


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
  // show form to UPDATE banner
  
  $id = null;
  if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
  }
   
  if ( null==$id ) {
    header("Location: list.php");
  }
   
  if ( !empty($_POST)) {
  //Printer::printnow($_POST, '$_POST');
  
  // keep track validation errors
  $titleError = null;
  $contentError = null;
  $option_displayError = null;  
  
  // keep track post values
  $title = $_POST['title'];
  $content = $_POST['content'];
  if (isset($_POST['option_display'])) {
    $option_display = $_POST['option_display']; // '1' | '0' | Undefined index
  }
  else {
    $option_display = false;
  }
   
  // validate input
  $valid = true;
  if (empty($title)) {
      $titleError = 'Please enter Title';
      $valid = false;
  }
   
  if (empty($content)) {
      $contentError = 'Please enter Content';
      $valid = false;
  }
   
  if ('0' !== $option_display && '1' !== $option_display) {
      $option_displayError = 'Please check the Dispaly Option';
      $valid = false;
  }

     
    // update data
    if ($valid) {
      $pdo = Database::connect();
      
      $objBanner = new Banner($pdo);
      $res = $objBanner->update($title, $content, $option_display, $id); // true | false
      
      if ($res) {
        $msg_update_status = "Banner was updated!";
        $msg_class = ' text-success';
      } else {
        $msg_update_status = "Can't update the entry. Something was wrong.";
        $msg_class = ' text-danger';
      }
      
      Database::disconnect();
      //header("Location: index.php");
    }
    
  }
  else {
    $pdo = Database::connect();
    
    $objBanner = new Banner($pdo);
    $res = $objBanner->read($id);
    
    Database::disconnect();
    
    //Printer::printnow($res, '$res');
    //Printer::gettype($res);
    
    if (!$res) {
      $msg_update_status = "Can't read the entry. Something was wrong.";
      $msg_class = ' text-danger';
      
      $id = null;
      $title = 'empty';
      $content = 'empty';
      $option_display = 'empty';
    }
    else {
      $title = $res['title'];
      $content = $res['content'];
      $option_display = $res['option_display'];
    }
    
  }
  
  
  include ('../tpl/banners_update.tpl.php');
}