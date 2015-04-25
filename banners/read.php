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
  // show form to READ banner
  
  $id = null;
  if ( !empty($_GET['id'])) {
      $id = $_REQUEST['id'];
      //Printer::printnow($_REQUEST, '$_REQUEST');
  }
   
  if ( null==$id ) {
      header("Location: list.php");
  } else {
      // connect to DB
      $pdo = Database::connect();
      $objBanner = new Banner($pdo);
      $res = $objBanner->read($id);
      
      Database::disconnect();
      
      //Printer::printnow($res, '$res');
      //Printer::gettype($res);
      
      $pagesIDs = array(); // arr of checked pages
      if (!$res) {
        $msg_read_status = "Can't read the entry. Something was wrong.";
        $msg_class = ' text-danger';
        
        $row = array('id'=>null, 'title'=>'empty', 'content'=>'empty', 
          'option_display'=>'empty', 
          'option_startview' => 'empty', 
          'option_timestart' => 'empty',
          'option_timeend' => 'empty',
          'option_display_pages' => array() );
      }
      else { // format result Banner array
        
        // create array with checked Pages id: array(1,52665, 52667, 4,7):
        foreach ($res['option_display_pages'] as $page) {
          $pagesIDs[] = $page['page_id'];
        }
        
        
        $row = $res;
        
        //Printer::printnow($row, '$row');
        
      }
  }
  
  
  // get Pages list
  $pages = Sitemap::$pages;
  
  /* Page Title */
  $curr_page_title = 'Read Banner';
  
  include ('../tpl/banners_read.tpl.php');
  
}