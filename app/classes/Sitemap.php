<?php
class Sitemap {
  
  // array of website pages links
  public static $pages = array (
    '/' => array('id' => 1, 'title' => 'Home' ),
    '/index.php' => array('id' => 1, 'title' => 'Home' ),
    '/products.php' => array('id' => 2, 'title' => 'Products' ),
    '/templates.php' => array('id' => 3, 'title' => 'Search' ),
    '/category/' => array('id' => 4, 'title' => 'Categories' ),
    '/category/index.php' => array('id' => 4, 'title' => 'Categories' ),
    '/contact_us.php' => array('id' => 5, 'title' => 'Contact Us' ),
    '/banners/list.php' => array('id' => 6, 'title' => 'Banners List' ),
    
  );
  
  
  public static function getPageID($referer_link) {
    
    if (array_key_exists($key= $referer_link, $array = self::$pages)) {
      return self::$pages[$referer_link]['id'];
    }
    else
      return false;
    
  }
  
  
  public static function getPageTitle($curr_page_link) {
    
    if (array_key_exists($key= $curr_page_link, $array = self::$pages)) {
      return self::$pages[$curr_page_link]['title'];
    }
    else
      return false;
    
  }
  
  
} // end class Sitemap