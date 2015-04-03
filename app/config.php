<?php
// Задаем константы:
define ('DS', DIRECTORY_SEPARATOR); // разделитель для путей к файлам
$sitePath = realpath(dirname(__FILE__) . DS) . DS;
define ('SITE_PATH', $sitePath); // путь к корневой папке сайта
//print DS . '<br>';
print 'SITE_PATH: ' . SITE_PATH . '<br>';


define('SERVER_NAME', $_SERVER['SERVER_NAME']);
define('DOMAIN_LOCAL', 'host.local');
define('DOMAIN_DEV', 'unexist');
define('DOMAIN_LIVE', 'unexist');

print 'SERVER_NAME: ' . SERVER_NAME . '<br>';


$string = trim($_SERVER['SCRIPT_NAME'], '/');  // [SCRIPT_NAME] => '/php-mvc/index.php'
$ar = explode($delimeter = '/', $string, $limit = 2); // $ar[0]; // '/php-mvc'
$subfolderPath = '/' . $ar[0]; // '/php-mvc'
define ('SUBFOLDER_PATH', $subfolderPath); // путь от доменв к реальной папке сайта
print 'SUBFOLDER_PATH: ' . SUBFOLDER_PATH . '<br>';

print '<pre>';
//print_r($_SERVER);
print '</pre>';

if (SERVER_NAME == DOMAIN_LOCAL) {
  define('DB_NAME', 'user19_tst_php_mvc');
  define('DB_USER', 'user19');
  define('DB_PASS', 'tuser19');
  define('DB_HOST', 'localhost');
  //define('DB_CHARSET', 'utf8');
  //define('DB_COLLATE', '');
}
else {
  // для подключения к бд
  define('DB_NAME', 'blog_mvc');
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
