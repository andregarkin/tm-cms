<?php
class Session {
  
  public $cookLogin;
  public static $counterView;
  
  public function start() {
    
    session_start(); // start the session

  }
  
  public function defineStatus() {
    
    // check the Session, if exists, that mean the user is already authorized
    if (isset($_SESSION['user_id'])) {
      
      $userName = htmlspecialchars($_SESSION['user_login']);
      define('LOGGED', true);
      define('USERNAME', $userName);

    } else {
      
      define('LOGGED', false);
          
      $login = '';
      //проверяем куку, может он уже заходил сюда
      if (isset($_COOKIE['CookieMy'])) {
        $login = htmlspecialchars($_COOKIE['CookieMy']);
        //print('// кука есть, ' . $login . ' уже заходил сюда. <br/>');
        
        $this->cookLogin = $login;
      }
      else {
        //print('//нет, не заходил. <br/>');
      }
    }

  }
  
  public function destroy() {
    
    session_destroy();
    
  }
  
  public function counterViewPlus() {
    
    if (isset($_SESSION['counter_view'])) {
      $_SESSION['counter_view'] +=1;
    }
    else {
      $_SESSION['counter_view'] = 0;
    }
    
    self::$counterView = $_SESSION['counter_view'];
    
  }
  
} // end class