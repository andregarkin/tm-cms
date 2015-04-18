<?php
// define the constants

define('SERVER_NAME', $_SERVER['SERVER_NAME']); // 'host.local' | 'magenta.ho.ua' | 
define('DOMAIN_LOCAL', 'host.local');
define('DOMAIN_DEV', 'magenta.ho.ua');
define('DOMAIN_LIVE', 'unexist');

//print 'SERVER_NAME: ' . SERVER_NAME . '<br>'; // 'host.local'


$string = trim($_SERVER['SCRIPT_NAME'], '/');  // [SCRIPT_NAME] => '/tm-cms/index.php'
$ar = explode($delimeter = '/', $string, $limit = 2); // $ar[0]; // '/tm-cms'
$subfolderPath = '/' . $ar[0]; // '/tm-cms'
define ('SUBFOLDER_PATH', $subfolderPath); // путь от доменв к реальной папке сайта

//print 'SUBFOLDER_PATH: ' . SUBFOLDER_PATH . '<br>'; // '/tm-cms'

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
elseif (SERVER_NAME == DOMAIN_DEV || SERVER_NAME == 'www.' . DOMAIN_DEV) {

  define('DB_NAME', 'magenta');
  define('DB_USER', 'magenta');
  define('DB_PASS', 'ufkfrnbrf7'); // ufkfrnbrf7
  define('DB_HOST', 'localhost');
  
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

/**
 * TM CMS Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
//$table_prefix  = 'tmcms_';
define('TABLE_PREFIX', 'tmcms_');

/*
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);

	mysql_connect ("localhost", "user19","tuser19");//пишите свои настройки
	mysql_select_db("test") or die (mysql_error());//и свою бд
	mysql_query('SET character_set_database = utf8'); 
	mysql_query ("SET NAMES 'utf8'");

*/