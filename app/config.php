<?php
// define the constants
define ('DS', DIRECTORY_SEPARATOR);
$sitePath = realpath(dirname(__FILE__) . DS) . DS;
define ('SITE_PATH', $sitePath); // 'D:\Dropbox\codestorage\host.local\agarkin\php-mvc\'
//print DS . '<br>';
print 'SITE_PATH: ' . SITE_PATH . '<br>'; // 'D:\Dropbox\codestorage\host.local\agarkin\php-mvc\'


define('SERVER_NAME', $_SERVER['SERVER_NAME']); // 'host.local'
define('DOMAIN_LOCAL', 'host.local');
define('DOMAIN_DEV', 'unexist');
define('DOMAIN_LIVE', 'unexist');

print 'SERVER_NAME: ' . SERVER_NAME . '<br>'; // 'host.local'


$string = trim($_SERVER['SCRIPT_NAME'], '/');  // [SCRIPT_NAME] => '/tm-cms/index.php'
$ar = explode($delimeter = '/', $string, $limit = 2); // $ar[0]; // '/tm-cms'
$subfolderPath = '/' . $ar[0]; // '/tm-cms'
define ('SUBFOLDER_PATH', $subfolderPath); // путь от доменв к реальной папке сайта
print 'SUBFOLDER_PATH: ' . SUBFOLDER_PATH . '<br>'; // '/php-mvc'

//print 'S_SERVER: <pre>';
//print_r($_SERVER);
//print '</pre>';

if (SERVER_NAME == DOMAIN_LOCAL) {

  define('DB_NAME', 'test');
  define('DB_USER', 'user19');
  define('DB_PASS', 'tuser19');
  define('DB_HOST', 'localhost');
  //define('DB_CHARSET', 'utf8');
  //define('DB_COLLATE', '');
  
}
else {

  define('DB_NAME', 'unexist');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_HOST', 'localhost');
  
}

/**
 * Режим отладки.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 */
if (SERVER_NAME == DOMAIN_LOCAL) {
  define('TM_DEBUG', true);
}
elseif (SERVER_NAME == DOMAIN_DEV) {
  define('TM_DEBUG', false);
}
elseif (SERVER_NAME == DOMAIN_LIVE) {
  define('TM_DEBUG', false);
}
else {
  define('TM_DEBUG', true);
}


if (true == TM_DEBUG) {
  // включим отображение всех ошибок
  error_reporting (E_ALL); 
}


/*
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);

	mysql_connect ("localhost", "user19","tuser19");//пишите свои настройки
	mysql_select_db("test") or die (mysql_error());//и свою бд
	mysql_query('SET character_set_database = utf8'); 
	mysql_query ("SET NAMES 'utf8'");

*/