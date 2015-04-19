<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');
include ('../app/classes/Database.php');
include ('../app/classes/Banner.php');

include ('../app/classes/Sitemap.php');
include ('../app/classes/Validator.php');


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
        
        $row = array('id'=>null, 'title'=>'empty', 'content'=>'empty', 'option_display'=>'empty', 'option_display_pages' => array() );
      }
      else { // format result Banner array
        
        // create array with checked Pages id: array(1,52665, 52667, 4,7):
        foreach ($res['option_display_pages'] as $page) {
          $pagesIDs[] = $page['page_id'];
        }
        
        
        // edit array: $res['option_display_pages']
        /*$option_display_pages = array(); // temp array
        foreach ($res['option_display_pages'] as $page) {
          $option_display_pages[$page['page_id']] = Sitemap::getPageTitleByID((int) $page['page_id']);
        }*/
        /*
          FROM: 
        [option_display_pages] => Array
        (
            [0] => Array
                (
                    [page_id] => 1
                )
          TO:
        [option_display_pages] => Array
        (
            [1] => Home
            [52666] => Product: 52666
            [7] => About
        )
        */
                
        
        //$res['option_display_pages'] = $option_display_pages;
        $row = $res;
        
        //Printer::printnow($row, '$row');
        
      }
  }
  
  
  // get Pages list
  $pages = Sitemap::$pages;
  
  include ('../tpl/banners_read.tpl.php');
  
}