<?php
class Banner
{
  
  private static $pdo;
  private static $tableBanners;
  private static $tableBannersPages;
  
  public function __construct($pdo) {
    self::$pdo = $pdo;
    self::$tableBanners = TABLE_PREFIX . 'tbanners';
    self::$tableBannersPages = TABLE_PREFIX . 'banners_pages';
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
    else { // select by ID
      // should validate id before.
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = 'SELECT `id`, `title`, `content`, `option_display` FROM `' . self::$tableBanners . '` where `id` = ?';
      $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
      if (!$q) return false;
      $q->execute(array($id)); // TRUE | FALSE
      $row = $q->fetch(PDO::FETCH_ASSOC);
      if (!$row) return false;
      
      $sql = 'SELECT `page_id` FROM `tmcms_banners_pages` where `banner_id`=:banner_id';
      
      try {
        
      $stmt = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
      $stmt->bindValue(':banner_id', $id);
      $stmt->execute(); // TRUE | FALSE
      $option_display_pages = $stmt->fetchAll(PDO::FETCH_ASSOC); // value | FALSE
      
      } catch(PDOException $e) {
        echo $e->getMessage();
        exit;
      }
      
      $option_display_pages? $row['option_display_pages'] = $option_display_pages : $row['option_display_pages'] = array();
      
      return $row;
    }
    
  }
  
  public function create($title, $content, $option_display, $option_display_pages_ids) {
    
    $entry_values = array($title, $content, $option_display);
    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'INSERT INTO `' . self::$tableBanners . '` (`title`,`content`,`option_display`) values(?, ?, ?)';
    $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
    if (!$q) return false;
    $q->execute($entry_values); // TRUE | FALSE
    if (!$q) return false;
    
    // insert into comparison table `banners_pages` new value `banner_id` and `pages_id` value.
    // if arr $option_display_pages_ids contains at least 1 value with `page_id`.
    if (count($option_display_pages_ids) > 0) {
      
      // get id of the last entry (it is new `banner_id`).
      $new_banner_ID = self::$pdo->lastInsertId();
      
      $sql = 'INSERT INTO `' . self::$tableBannersPages . '` (`banner_id`,`page_id`) values(:banner_id, :page_id)';
      //$q = self::$pdo->prepare('INSERT INTO foo VALUES(:a, :b, :c)');
      $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
      if (!$q) return false;
      foreach($option_display_pages_ids as $page_id)
      {
          $q->bindValue(':banner_id', $new_banner_ID); // TRUE | FALSE
          $q->bindValue(':page_id', $page_id);
          $q->execute(); // TRUE | FALSE
      }
      
    }
    
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