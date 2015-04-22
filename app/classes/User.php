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
  
} // end class User