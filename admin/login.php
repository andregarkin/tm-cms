<?php
include ('../app/classes/Session.php');

$objSession = new Session();
$objSession->start();



// plug the config
include ('../app/config.php'); 

// Connect to DB
$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
$dbObject->exec('SET CHARACTER SET utf8');  




$objSession->printnow();

if (isset($_POST['login']) && isset($_POST['password'])) {

  $login = $_POST['login'];
  // hash the password because the database contains the hash
  $password = md5(trim($_POST['password']));
  // built the query
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
		//print('// если такой пользователь есть //ставим метку в сессии <br/>');
    
  }
  else {
    
    //если пользователя нет, то пусть пробует еще
    //header("Location: login.php"); 
    
    //print('//если пользователя нет, то пусть пробует еще. </br>');
    $errMessage = 'You put wrong data. May try again.';
  }
}

$objSession->defineStatus();

include('../tpl/admin_login.tpl.php');
//include('../tpl/admin_login_temp.tpl.php');

?>