<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');
include ('../app/classes/Database.php');
include ('../app/classes/Banner.php');
include ('../app/classes/Validator.php');
include ('../app/classes/Sitemap.php');


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
   
  $pagesIDs = array(); // array of checked pages in 'Displayed on these pages'
   
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
    
    // get Pages ID's to displayed Banner.
    $option_display_pages = array();
    if (!empty($_POST['option_display_pages'])) {
      $option_display_pages = $_POST['option_display_pages']; // index array: [2] => Products | [52665] => Product: 52665
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
      
      // get pages ID's in Pages list checkboxes ('Displayed on these pages:')
      $option_display_pages_ids = array_keys($option_display_pages); // array
      
      // Switch off Active status
      if (0 == count($option_display_pages))
        $option_display = '0';
      
      // connect to DB
      $pdo = Database::connect(); // PDO object
      
      $objBanner = new Banner($pdo);
      $res = $objBanner->update($title, $content, $option_display, $id, $option_display_pages_ids); // true | false
      
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
      
      
      // create array with checked Pages id: array(1,52665, 52667, 4,7):
      foreach ($res['option_display_pages'] as $page) {
        $pagesIDs[] = $page['page_id'];
      }
      
    }
    
  }
  
  // get Pages list
  $pages = Sitemap::$pages;
  
  /* Page Title */
  $curr_page_title = 'Update Banner';
  
  include ('../tpl/banners_update.tpl.php');
}