<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');
include ('../app/classes/Database.php');
include ('../app/classes/Banner.php');
include ('../app/classes/Sitemap.php');

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
  // show form to CREATE banner

if ( !empty($_POST)) {
  //Printer::printnow($_POST, '$_POST');
  
  // keep track validation errors
  $titleError = null;
  $contentError = null;
  $option_displayError = null;
  $option_startviewError = null;
  
  // keep track post values
  $title = $_POST['title'];
  $content = $_POST['content'];
  if (isset($_POST['option_display'])) {
    $option_display = $_POST['option_display']; // '1' | '0' | Undefined index
  }
  else {
    $option_display = false;
  }
  
  //Quantity of page views after that to show to user the Banner.
  $option_startview = $_POST['option_startview'];
  
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
  
  if (empty($option_startview) && '0' !== $option_startview) {
    $option_startviewError = 'Please enter quantity of site pages views.';
    $valid = false;
  }
  elseif (false == Validator::isID($option_startview)) {
    // also should check - is unsigned number ?
    $option_startviewError = 'Should be a number.';
    $valid = false;
  }
   
  // insert data
  if ($valid) {
    
    // get pages ID's in Pages list checkboxes ('Displayed on these pages:')
    $option_display_pages_ids = array_keys($option_display_pages);
    
    // Switch off Active status
    if (0 == count($option_display_pages))
      $option_display = '0';
    
    // connect to DB
    $pdo = Database::connect(); // PDO object
    
    $objBanner = new Banner($pdo);
    $res = $objBanner->create($title, $content, $option_display, $option_startview, $option_display_pages_ids); // true | false
    Database::disconnect();
    
    if ($res) {
      $msg_create_status = "New banner was created!";
    } else {
      $msg_create_status = "Can't save new entry. Something was wrong.";
    }
    //header("Location: index.php");
  }
  
}

  // get Pages list
  $pages = Sitemap::$pages;
  
  /* Page Title */
  $curr_page_title = 'Create Banner';

  include ('../tpl/banners_create.tpl.php');
  //include ('../tpl/banners_create_temp.tpl.php');
}