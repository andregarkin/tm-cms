<?php
// plug the config
include ('../app/config.php');

#include ('../app/classes/Printer.php');
#include ('../app/classes/Session.php');
#include ('../app/classes/Database.php');
#include ('../app/classes/Banner.php');
#include ('../app/classes/Validator.php');
#include ('../app/classes/Sitemap.php');

// plug the functions
include ('../app/functions.php');
Logger::laydown($_SERVER['REQUEST_URI']);

$objSession = new Session();
$objSession->start();
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
   
  if (null == $id) {
    header("Location: list.php");
  }
   
  $pagesIDs = array(); // array of checked pages in 'Displayed on these pages'
   
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
    

     
    // update data
    if ($valid) {
      
      // get pages ID's in Pages list checkboxes ('Displayed on these pages:')
      $option_display_pages_ids = array_keys($option_display_pages); // array
      
      // Switch off Active status
      if (0 == count($option_display_pages))
        $option_display = '0';
      
      // add hours and minutes
      // 'YYYY-MM-DD hh:mm:ss' | '2011-10-20 11:00:00'
      $option_DATETIME_start = ($option_timestart . ' ' . $option_timestart_hours . ':' . $option_timestart_minutes . ':00');
      $option_DATETIME_end = ($option_timeend . ' ' . $option_timeend_hours . ':' . $option_timeend_minutes . ':00');

      
      // connect to DB
      $pdo = Database::connect(); // PDO object
      
      $objBanner = new Banner($pdo);
      $res = $objBanner->update($title, $content, 
                                                  $option_display, $option_startview, 
                                                  $option_DATETIME_start, $option_DATETIME_end, 
                                                  $id, $option_display_pages_ids); // true | false
      
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
    else {
      $msg_update_status = "Can't update the entry. Please input correct data in highlighted fields.";
      $msg_class = ' text-danger';
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
      $option_startview = 'empty';
      $option_timestart = null;
      $option_timestart_hours = null;
      $option_timestart_minutes = null;
      $option_timeend = null;
      $option_timeend_hours = null;
      $option_timeend_minutes = null;
    }
    else {
      $title = $res['title'];
      $content = $res['content'];
      $option_display = $res['option_display'];
      $option_startview = $res['option_startview'];
      
      $option_DATETIME_start = $res['option_timestart']; // 'YYYY-MM-DD hh:mm:ss'
      $option_DATETIME_end = $res['option_timeend'];
      
      // extract date, hours and minutes
      list($date, $time) = explode(' ', $option_DATETIME_start);
      list($hour, $min) = explode(':', $time);
      
      $option_timestart = $date; // 'YYYY-MM-DD'
      $option_timestart_hours = $hour; // from '00' to '23'
      $option_timestart_minutes = $min; // from '00' to '59'
      
      // extract date, hours and minutes for end time
      list($date, $time) = explode(' ', $option_DATETIME_end);
      list($hour, $min) = explode(':', $time);
      
      $option_timeend = $date; // 'YYYY-MM-DD'
      $option_timeend_hours = $hour; // from '00' to '23'
      $option_timeend_minutes = $min; // from '00' to '59'
      
      
      // create array with checked Pages id: eg.: array(1,52665, 52667, 4,7)
      foreach ($res['option_display_pages'] as $page) {
        $pagesIDs[] = $page['page_id'];
      }
      
    }
    
  }
  
  // get Pages list
  $pages = Sitemap::$pages;
  
  /* Page Title */
  $curr_page_title = 'Update Banner';

  Logger::write();
  include ('../tpl/banners_update.tpl.php');
}