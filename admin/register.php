<?php


// подключаем конфиг
include ('../app/config.php'); 

// Соединяемся с БД
$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
$dbObject->exec('SET CHARACTER SET utf8');  
  
	if(isset($_POST['submit'])) {
	//проверяем, нет ли у нас пользователя с таким логином
	$stmt = $dbObject->query("SELECT COUNT(user_id) 
		FROM tmcms_users WHERE 
		user_login='" . $_POST['login'] . "'"); // PDOStatement | FALSE
  $row = $stmt->fetch();

  print 'row: <pre>';
  print_r($row);
  print '</pre>';
  
    if ($row['COUNT(user_id)'] == 1)  {
        $error = "<p style='color:red;'>Пользователь с таким логином уже есть</p>";
    }
    
		// Если нет, то добавляем нового пользователя
	  if(!isset($error) )   {
      $login = $_POST['login'];
      $email = $_POST['email'];

      // Убираем пробелы и хешируем пароль
      $password = md5(trim($_POST['password']));
      
      
      try {
        $stmt = $dbObject->prepare("INSERT INTO tmcms_users 
        SET user_login='".$login."', user_password='".$password."', user_email='" .$email. "'"); // // PDOStatement | FALSE | PDOException
        $bres = $stmt->execute(); // bool
        if ($bres) {
          echo '<p style="color:green;">Вы успешно зарегистрировались с логином - '.$login .'</p>';
        }
        else {
          echo '<p style="color:red;">По каким-то причинам зарег-ся не удалось с логином - '.$login .'</p>';
        }
        
      } catch (PDOException $e) {
        echo 'Error : '.$e->getMessage();
        echo '<br/>Error sql. <br/>'; 
        exit();
      }
      /*
      mysql_query("INSERT INTO tmcms_users 
      SET user_login='".$login."', user_password='".$password."', user_email='" .$email. "'");
      */
	 }  else   {
	// если есть такой логин то говорим об этом
		 echo $error;
		}
	}
	//по умолчанию данные будут отправляться на этот же файл
	print <<< html
	<form method="POST">
		Логин <input name="login" type="text"><br>
		Пароль <input name="password" type="password"><br>
    Email <input name="email" type="email"><br>
		<input name="submit" type="submit" value="Зарегистрироваться">
	</form>
html;
?>