<?php
class Banner
{
  
  private static $pdo;
  
  public function __construct($pdo) {
    self::$pdo = $pdo;
  }
  
  public function read($id = false) {
    
    if (!$id) {
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
    else {
      // should validate id before.
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT `id`, `title`, `content`, `option_display` FROM `tmcms_tbanners` where id = ?";
      $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
      if (!$q) return false;
      $q->execute(array($id)); // TRUE | FALSE
      $row = $q->fetch(PDO::FETCH_ASSOC);
      return $row;
    }
    
  }
  
  public function create($title, $content, $option_display) {
    
    $entry_values = array($title, $content, $option_display);
    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `tmcms_tbanners` (`title`,`content`,`option_display`) values(?, ?, ?)";
    $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
    if (!$q) return false;
    $q->execute($entry_values); // TRUE | FALSE
    return $q;
    
  }
  
  public function update($title, $content, $option_display, $id) {
    
    $entry_values = array($title, $content, $option_display, $id);
    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE `tmcms_tbanners`  set title = ?, content = ?, option_display =? WHERE id = ?";
    $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
    if (!$q) return false;
    $q->execute($entry_values); // TRUE | FALSE
    return $q;
    
  }
  
}