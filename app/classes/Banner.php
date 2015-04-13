<?php
class Banner
{
  
  private static $pdo;
  
  public function __construct($pdo) {
    self::$pdo = $pdo;
  }
  
  public function read($id = false) {
    
    $sql = 'SELECT `id`, `title`, `content`, `option_display` FROM `tmcms_tbanners` ORDER BY `id` ASC';
    
    try {
    $stmt = self::$pdo->query($sql); // PDOStatement | FALSE
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); // value | FALSE
    
    } catch(PDOException $e) {
      echo $e->getMessage();
      exit;
    }
    
    $rows ? $res = $rows /* array */ : $res = false;
    return $res;
    
  }
  
}