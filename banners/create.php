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
  
  $option_timestart = date($format = 'Y-m-d'); // 2015-01-26 | 2015-04-24
  $option_timestart_hours = date('G'); // from '0' to '23'
  $option_timestart_minutes = date('i'); // from '00' to '59'
  
  $option_timeend_hours = null;
  $option_timeend_minutes = null;

if ( !empty($_POST)) {
  //Printer::printnow($_POST, '$_POST');
  
  // keep track validation errors
  $titleError = null;
  $contentError = null;
  $option_displayError = null;
  $option_startviewError = null;
  
  $option_timestartError = null;
  $option_timeendError = null;
  
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
  
  $option_timestart = $_POST['option_timestart']; // '' | string
  $option_timestart_hours = $_POST['option_timestart_hours']; // ? | from '00' to '23'
  $option_timestart_minutes = $_POST['option_timestart_minutes']; // ? | from '00' to '59'
  
  $option_timeend = $_POST['option_timeend']; // '' | string
  $option_timeend_hours = $_POST['option_timeend_hours']; // ? | '00' - '23'
  $option_timeend_minutes = $_POST['option_timeend_minutes']; // ? | '00' - '59'

  //Printer::printnow($_POST, '$_POST');
  
   
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
  
  if (empty($option_timestart)) {
    $option_timestart = date($format = 'Y-m-d'); // '2015-01-26' | '2015-04-24'
  }
  elseif (false == Validator::isDateFormat($option_timestart)) { // Boolean
    $option_timestartError = 'Should be a correct date in format YYYY-MM-DD.';
    $valid = false;
  }
  
  if (empty($option_timeend)) {
    $option_timeend = END_EPOCH; // YYYY-MM-DD
  }
  elseif (false == Validator::isDateFormat($option_timeend)) { // Boolean
    $option_timeendError = 'Should be a correct date in format YYYY-MM-DD.';
    $valid = false;
  }
  
  // insert data
  if ($valid) {
    
    // get pages ID's in Pages list checkboxes ('Displayed on these pages:')
    $option_display_pages_ids = array_keys($option_display_pages);
    
    // Switch off Active status
    if (0 == count($option_display_pages))
      $option_display = '0';
    
    // add hours and minutes
    // 'YYYY-MM-DD hh:mm:ss' | '2011-10-20 11:00:00'
    $option_DATETIME_start = ($option_timestart . ' ' . $option_timestart_hours . ':' . $option_timestart_minutes . ':00');
    $option_DATETIME_end = ($option_timeend . ' ' . $option_timeend_hours . ':' . $option_timeend_minutes . ':00');
    
    //Printer::printnow($option_DATETIME_start, '$option_DATETIME_start');
    //Printer::printnow($option_DATETIME_end, '$option_DATETIME_end');
    
    // connect to DB
    $pdo = Database::connect(); // PDO object
    
    $objBanner = new Banner($pdo);
    $res = $objBanner->create($title, $content, 
                                                $option_display, $option_startview, 
                                                $option_DATETIME_start, $option_DATETIME_end, 
                                                $option_display_pages_ids); // true | false
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