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
      if (!Validator::isID($id)) return false;
      
      //self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = 'SELECT `id`, `title`, `content`, `option_display`, `option_startview` FROM `' . self::$tableBanners . '` where `id` = ?';
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
  
  public function create($title, $content, $option_display, $option_startview, $option_timestart, $option_timeend, $option_display_pages_ids) {
    
    $entry_values = array($title, $content, $option_display, $option_startview, $option_timestart, $option_timeend);
    //self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'INSERT INTO `' . self::$tableBanners . '` (`title`,`content`,`option_display`, `option_startview`, '
        .' `option_timestart`, `option_timeend`) values(?, ?, ?, ?, ?, ?)';
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
  
  public function update($title, $content, $option_display, $option_startview, $id, $option_display_pages_ids) {
    
    // should validate id before.
    if (!Validator::isID($id)) return false;
    
    $entry_values = array($title, $content, $option_display, $option_startview, $id);
    //self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE `" . self::$tableBanners . "`  set title =?, content =?, option_display =?, option_startview =? WHERE id =?";
    $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
    if (!$q) return false;
    $q->execute($entry_values); // TRUE | FALSE
    if (!$q) return false;
    
    // insert into comparison table `banners_pages` new value `banner_id` and `pages_id` value.
    // Before writing these lines (line) must be removed for this banner all entries from the link table (remove the checkboxes).
    $sql = "DELETE FROM `" . self::$tableBannersPages . "`  WHERE banner_id = ?";
    $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
    if (!$q) return false;
    $q->execute(array($id)); // TRUE | FALSE
    
    // insert into comparison table `banners_pages` new value `banner_id` and `pages_id` value.
    // if arr $option_display_pages_ids contains at least 1 value with `page_id`.
    if (count($option_display_pages_ids) > 0) {
      
      
      $sql = 'INSERT INTO `' . self::$tableBannersPages . '` (`banner_id`,`page_id`) values(:banner_id, :page_id)';
      //$q = self::$pdo->prepare('INSERT INTO foo VALUES(:a, :b, :c)');
      $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
      if (!$q) return false;
      foreach($option_display_pages_ids as $page_id)
      {
          $q->bindValue(':banner_id', $id); // TRUE | FALSE
          $q->bindValue(':page_id', $page_id);
          $q->execute(); // TRUE | FALSE
      }
      
    }
    
    return $q;
    
  }
  
  public function delete($id) {
    
    // should validate id before.
    if (!Validator::isID($id)) return false;
    
    
    $sql = "DELETE FROM `" . self::$tableBanners . "`  WHERE id = ?";
    $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
    if (!$q) return false;
    $q->execute(array($id)); // TRUE | FALSE
    if ($q->rowCount() > 0) {
      $succsess_deletion = TRUE;
    }
    else {
      $succsess_deletion = FALSE;
    }
    
    // must be removed for this banner all entries from the link table.
    $sql = "DELETE FROM `" . self::$tableBannersPages . "`  WHERE banner_id = ?";
    $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
    if (!$q) return false;
    $q->execute(array($id)); // TRUE | FALSE
    
    return $succsess_deletion;
    
  }
  
  /** Get Banner Content for iframe by current Page ID 
   * 
   * @: false | 'html'
   */
  public function getContentByPageID($page_id) {
    
    $banner_content = '<h1 style="text-align:center; color:green;">This banner content returned from Banner class</h1>';
    $banner_content .= '<p>Banner Content for $page_id: ' . $page_id . '</p>';
    
    // get Banners ID's  (Active banners, attached to specific pages) by Page ID.
    $res = self::getBannersIDsByPageID($page_id);// array | FALSE
    if (!$res)
      return false;
    if (count($res) == 0)
      return false;
    
    // get random Banner ID
    $random_index = rand(1, count($res)) -1; // 0 - N
    $banner_random_ID = $res[$random_index]['id'];
    
    // get Banner Content
    $sql = 'SELECT `content` FROM `' . self::$tableBanners . '` where `id` = ?';
    $q = self::$pdo->prepare($sql); // obj PDOStatement | FALSE | PDOException
    if (!$q) return false;
    $q->execute(array($banner_random_ID)); // TRUE | FALSE
    $row = $q->fetch(PDO::FETCH_ASSOC);
    
    $banner_content = $row['content'];
    
    return $banner_content;
    
  }
  
  /**
   * Get banners rows by Search string 'title'
   *
   * @ array | false
   */
  public function searchByName($searchName) {
    $sql = 'SELECT `id`, `title`, `content`, `option_display` FROM `' . self::$tableBanners 
      . '` WHERE title LIKE "%' . $searchName . '%" ORDER BY `id` ASC';
      
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
  
  /** get Banners ID's  (Active banners, attached to specific pages) by Page ID.
   *   Also take into account the number of page views $counterView.
   *
   * @  array | FALSE
   */
  private function getBannersIDsByPageID($page_id) {
    
    $sql = 'SELECT bnrs.id FROM `' . self::$tableBanners . '` AS bnrs, `' . self::$tableBannersPages . '` AS bnrs_pgs '
      . 'WHERE bnrs_pgs.page_id= ' . $page_id
      . ' AND bnrs_pgs.banner_id= bnrs.id '
      . ' AND bnrs.option_display=1 '
      . ' AND bnrs.option_startview <= ' . Session::$counterView . ';';
    
          
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
  
} // end class Banner