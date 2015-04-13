<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');
include ('../app/classes/Database.php');
include ('../app/classes/Banner.php');


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
  // show form to create banner

if ( !empty($_POST)) {
  // keep track validation errors
  $nameError = null;
  $emailError = null;
  $mobileError = null;
   
  // keep track post values
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
   
  // validate input
  $valid = true;
  if (empty($name)) {
      $nameError = 'Please enter Name';
      $valid = false;
  }
   
  if (empty($email)) {
      $emailError = 'Please enter Email Address';
      $valid = false;
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
      $emailError = 'Please enter a valid Email Address';
      $valid = false;
  }
   
  if (empty($mobile)) {
      $mobileError = 'Please enter Mobile Number';
      $valid = false;
  }
   
  // insert data
  if ($valid) {
    
        
    // connect to DB
    $pdo = Database::connect(); // PDO object
    
    //$objBanner = new Banner($pdo);
    //$arrBanners = $objBanner->read(); // array | false
    
    $sql = 'SELECT `id`, `title`, `content`, `option_display` FROM `tmcms_tbanners` ORDER BY `id` ASC';
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `tmcms_tbanners` (`title`,`content`,`option_display`) values(?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($title, $content, $option_display));
    
    Database::disconnect();
    //header("Location: index.php");
    $msg_create_status = "New banner was created!";
  }
}

  //include ('../tpl/banners_create.tpl.php');
  include ('../tpl/banners_create_temp.tpl.php');
}
?>