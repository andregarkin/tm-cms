<?php
include ('../app/classes/Printer.php');
include ('../app/classes/Session.php');
include ('../app/classes/Database.php');



$objSession = new Session();
$objSession->start();

// plug the config
include ('../app/config.php'); 

$objSession->printnow();
$objSession->defineStatus();

  
if(isset($_POST['submit'])) {
    
  // Connect to DB
  $pdo = Database::connect();
    
	//проверяем, нет ли у нас пользователя с таким логином
	$stmt = $pdo->query("SELECT COUNT(user_id) 
		FROM tmcms_users WHERE 
		user_login='" . $_POST['login'] . "'"); // PDOStatement | FALSE
  $row = $stmt->fetch();


  Printer::printnow($row, '$row');
    
    $user_login_exists = false;
    if ($row['COUNT(user_id)'] == 1)  {
        $user_login_exists = true;
        
        $msg_register_status = "User with this login already exists. Try to register another name.";
        $msg_class = "text-danger";
    }
    
		// Если нет, то добавляем нового пользователя
	  if (false == $user_login_exists) {
      $login = $_POST['login'];
      $email = $_POST['email'];

      // Убираем пробелы и хешируем пароль
      $password = md5(trim($_POST['password']));
      
      
      try {
        $stmt = $pdo->prepare("INSERT INTO tmcms_users 
        SET user_login='".$login."', user_password='".$password."', user_email='" .$email. "'"); // // PDOStatement | FALSE | PDOException
        $bres = $stmt->execute(); // bool
        if ($bres) {
          $msg_register_status = 'Вы успешно зарегистрировались с логином - '.$login;
          $msg_class = 'text-success';
        }
        else {
          $msg_register_status = 'По каким-то причинам зарег-ся не удалось с логином - '.$login;
          $msg_class = "text-danger";
        }
        
      } catch (PDOException $e) {
        echo 'Error : '.$e->getMessage();
        echo '<br/>Error sql. <br/>'; 
        exit();
      }

  }
  
  Database::disconnect();
   
}
  
  include('../tpl/admin_register.tpl.php');
  
	//по умолчанию данные будут отправляться на этот же файл
	/*print <<< html
	<form method="POST">
		Логин <input name="login" type="text"><br>
		Пароль <input name="password" type="password"><br>
    Email <input name="email" type="email"><br>
		<input name="submit" type="submit" value="Зарегистрироваться">
	</form>
html;*/
?>