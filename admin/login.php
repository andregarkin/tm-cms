<?php

// подключаем конфиг
include ('../app/config.php'); 

// Соединяемся с БД
$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
$dbObject->exec('SET CHARACTER SET utf8');  

session_start(); // не забываем во всех файлах писать session_start

if (isset($_POST['login']) && isset($_POST['password'])) {
  //немного профильтруем логин
  $login = $_POST['login'];
  //хешируем пароль т.к. в базе именно хеш
  $password = md5(trim($_POST['password']));
  // проверяем введенные данные
  $query = "SELECT user_id, user_login 
          FROM tmcms_users 
          WHERE user_login= '$login' AND user_password = '$password' 
          LIMIT 1";
          
  try {
    $stmt = $dbObject->query($query); // PDOStatement | FALSE
    $row = $stmt->fetch(PDO::FETCH_ASSOC); // value | FALSE
    
    print 'row: <pre>';
    print_r($row);
    print '</pre>';
 /*   Array (
    [user_id] => 1
    [user_login] => mylogin
    )*/

  } catch(PDOException $e) {
    echo $e->getMessage();
    exit;
  }
          
          
  // если такой пользователь есть
  if ($row) {

    //ставим метку в сессии 
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['user_login'] = $row['user_login'];
    
    //ставим куки и время их хранения 10 дней
    setcookie("CookieMy", $row['user_login'], time()+60*60*24*10);
		print('// если такой пользователь есть //ставим метку в сессии <br/>');
  }
  else {
    //если пользователя нет, то пусть пробует еще
    //header("Location: login.php"); 
    
    print('//если пользователя нет, то пусть пробует еще. </br>');
  }
}

    
print 'SESSION: <pre>';
print_r($_SESSION);
print '</pre>';



//проверяем сессию, если она есть, то значит уже авторизовались
if (isset($_SESSION['user_id'])) {
	echo htmlspecialchars($_SESSION['user_login'])." <br />"."Вы авторизованы <br />
	Т.е. мы проверили сессию и можем открыть доступ к определенным данным";
  
  print ('<p><a href="/tm-cms/admin/logout.php">Logout</a></p>');
  
} else {
	$login = '';
	//проверяем куку, может он уже заходил сюда
  print('//проверяем куку, может он уже заходил сюда. <br/>');
	if (isset($_COOKIE['CookieMy'])) {
		$login = htmlspecialchars($_COOKIE['CookieMy']);
    print('// кука есть, ' . $login . ' уже заходил сюда. <br/>');
	}
  else {
    print('//нет, не заходил. <br/>');
  }
  
  print ('<p style="color:red;">Войдите. </p>');
	//простая формочка
	print <<< 	html
<form action="login.php" method="POST">
		Логин <input name="login" type="text" value = $login><br>
		Пароль <input name="password" type="password"><br>
		<input name="submit" type="submit" value="Войти">
	</form>
html;
}
?>