<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');
include ('../app/classes/Database.php');
include ('../app/classes/User.php');


// plug the config
include ('../app/config.php'); 


$objSession = new Session();
$objSession->start();



if (isset($_POST['login']) && isset($_POST['password'])) {

  $login = $_POST['login'];
  $password = $_POST['password'];
  
  // get user info if user entry exists in DB
  $objUser = new User();
  $user_entry = $objUser->checkExists($login, $password); // array | FALSE
  
  //Printer::printnow($user_entry, '$user_entry');
   /*   Array (
      [user_id] => 1
      [user_login] => mylogin
      )*/  
  
  // If such user exists in DB.
  if ($user_entry) {

    // put the tag in the session
    $_SESSION['user_id'] = $user_entry['user_id'];
    $_SESSION['user_login'] = $user_entry['user_login'];
    
    // set the cookies and the storage time of 10 days
    setcookie("CookieMy", $user_entry['user_login'], time()+60*60*24*10);
    
  }
  else {
    
    // if the user does not, then let him try another
    //header("Location: login.php"); 
    $errMessage = 'You put wrong data. May try again.';
    
  }
  
}

Database::disconnect();

$objSession->defineStatus(); // should be placed after define $_SESSION['user_id']
include('../tpl/admin_login.tpl.php');

?>