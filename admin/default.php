<?php

// подключаем конфиг
include ('../app/config.php'); 

// Соединяемся с БД
$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
$dbObject->exec('SET CHARACTER SET utf8');  

session_start(); // не забываем во всех файлах писать session_start

    
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
  
  print ('<p style="color:red;">На этой странице могут быть только залогиненные. Вход здесь: </p>');
  print ('<p><a href="/tm-cms/admin/login.php">Login</a></p>');
}
?>