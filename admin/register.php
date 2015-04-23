<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');
include ('../app/classes/Database.php');
include ('../app/classes/User.php');

// plug the config
include ('../app/config.php'); 


$objSession = new Session();
$objSession->start();
$objSession->defineStatus();

  
if (isset($_POST['submit'])) {
    
  // Connect to DB
  $pdo = Database::connect();
  
  // Check if there is already in the database user with this login. 
  // Check if the login name is free (available). 
  $objUser = new User();
  $user_login_available = $objUser->checkLoginAvailable($_POST['login']); // TRUE | FALSE
  
  
  if (FALSE == $user_login_available)  {
    
    $msg_register_status = "User with this login already exists. Try to register another name.";
    $msg_class = "text-danger";
    
  }
  
  // register new user
  if ($user_login_available) {
    
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    // Insert entry about new user in DB. 
    $res = $objUser->create($login, $password, $email); // TRUE | FALSE
    
    if ($res) {
      $msg_register_status = 'Вы успешно зарегистрировались с логином - '.$login;
      $msg_class = 'text-success';
    }
    else {
      $msg_register_status = 'По каким-то причинам зарег-ся не удалось с логином - '.$login;
      $msg_class = "text-danger";
    }

  }
  Database::disconnect();
   
}
  
  include('../tpl/admin_register.tpl.php');
?>