<?php 
class User {
  
  private static $pdo;
  private static $tableUsers;
  
  public function __construct() {
    
    // Connect to DB
    self::$pdo = Database::connect();
    self::$tableUsers = TABLE_PREFIX . 'users';
    
  }
  
  /** Check User By Login & Password
   *  and return Entry if exists.
   *
   * @  array | FALSE
   */
  public function checkExists($login, $password) {
    
    // hash the password because the database contains the hash
    $password = md5(trim($_POST['password']));
    
    // built the query
    $query = "SELECT user_id, user_login FROM "
      . self::$tableUsers
      . " WHERE user_login= '$login' AND user_password = '$password' LIMIT 1";
            
    try {
      
      $stmt = self::$pdo->query($query); // PDOStatement | FALSE
      $row = $stmt->fetch(PDO::FETCH_ASSOC); // value | FALSE
      
    }
    catch(PDOException $e) {
      
      echo $e->getMessage();
      exit;
    }
    
    return $row;
  }
  
  /** Check if there is already in the database user with this login. 
   *  Check if the login name is free (available). 
   *
   * @  Boolean
   */
  public function checkLoginAvailable($login) {
    
    // should verify 'login string' here ?
    
    // built the query
    $query = "SELECT COUNT(user_id) FROM "
      . self::$tableUsers
      . " WHERE user_login= '$login';";
    
    $stmt = self::$pdo->query($query); // PDOStatement | FALSE
    $row = $stmt->fetch();
    //Printer::printnow($row, '$row');
    
    $login_available = true;
    if ($row['COUNT(user_id)'] > 0)  {
        $login_available = false;
    }
    
    return $login_available;
    
  }
  
  
  /** Insert entry about new user in DB. 
   *
   * @  Boolean
   */
  public function create($login, $password, $email) {
    
    // Remove the spaces and hash the password
    $password = md5(trim($_POST['password']));
    
    $query = "INSERT INTO " . self::$tableUsers
      . " SET user_login='$login', user_password='$password', user_email='$email';";
    
    try {
      $stmt = self::$pdo->prepare($query); // PDOStatement | FALSE | PDOException
      $res = $stmt->execute(); // bool
    }
    catch (PDOException $e) {
      echo 'Error : '.$e->getMessage();
      echo '<br/>Error sql. <br/>'; 
      exit();
    }
    
    return $res;
    
  }
    
    
    
  
  
} // end class User