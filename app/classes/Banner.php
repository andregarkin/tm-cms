<?php
class Banner
{
  
  private static $pdo;
  private static $tableBanners;
  
  public function __construct($pdo) {
    self::$pdo = $pdo;
    self::$tableBanners = TABLE_PREFIX . 'tbanners';
  }
  
  public function read($id = false) {
    
    if (!$id) {
      $sql = 'SELECT `id`, `title`, `content`, `option_display` FROM `' . self::$tableBanners . '` ORDER BY `id` ASC';
      
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
      $sql = 'SELECT `id`, `title`, `content`, `option_display` FROM `' . self::$tableBanners . '` where id = ?';
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
    $sql = 'INSERT INTO `' . self::$tableBanners . '` (`title`,`content`,`option_display`) values(?, ?, ?)';
    $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
    if (!$q) return false;
    $q->execute($entry_values); // TRUE | FALSE
    return $q;
    
  }
  
  public function update($title, $content, $option_display, $id) {
    
    $entry_values = array($title, $content, $option_display, $id);
    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE `" . self::$tableBanners . "`  set title = ?, content = ?, option_display =? WHERE id = ?";
    $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
    if (!$q) return false;
    $q->execute($entry_values); // TRUE | FALSE
    return $q;
    
  }
  
  public function delete($id) {
    
    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM `" . self::$tableBanners . "`  WHERE id = ?";
    $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
    if (!$q) return false;
    $q->execute(array($id)); // TRUE | FALSE
    if ($q->rowCount() > 0) {
      return TRUE;
    }
    return FALSE;
    
  }
  
  /**
   * 
   * return: false | 'html'
   */
  public function getContentByPageID($page_id) {
    
    $banner_content = 'This banner content returned from Banner class';
    return $banner_content;
    
  }
  
} // end class Banner