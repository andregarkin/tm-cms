<?php
// включим отображение всех ошибок
//error_reporting (E_ALL); 

// подключаем конфиг
include ('app/config.php'); 


// Соединяемся с БД
$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
$dbObject->exec('SET CHARACTER SET utf8');

// подключаем ядро сайта
include (SITE_PATH . DS . 'core' . DS . 'core.php'); 

