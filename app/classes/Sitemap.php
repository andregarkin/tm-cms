<?php
class Sitemap {
  
  // array of website pages links
  public static $pages = array (
    '/' => array('id' => 1, 'title' => 'Home' ),
    '/index.php' => array('id' => 1, 'title' => 'Home' ),
    '/products.php' => array('id' => 2, 'title' => 'Products' ),
      '/website-templates/52665.html' => array('id' => 52665, 'title' => 'Product: 52665'),
      '/website-templates/52666.html' => array('id' => 52666, 'title' => 'Product: 52666'),
      '/website-templates/52667.html' => array('id' => 52667, 'title' => 'Product: 52667'),
    '/templates.php' => array('id' => 3, 'title' => 'Search' ),
    '/category/' => array('id' => 4, 'title' => 'Categories' ),
    '/category/index.php' => array('id' => 4, 'title' => 'Categories' ),
    '/contact_us.php' => array('id' => 5, 'title' => 'Contact Us' ),
    '/banners/list.php' => array('id' => 6, 'title' => 'Banners List' ),
    '/other/about.php' => array('id' => 7, 'title' => 'About' ),
    //'/other/twitter-bootstrap.php' => array('id' => 8, 'title' => 'Twitter Bootstrap Page' ),
    
  );
  
  
  public static function getPageID($referer_link) {
    
    if (array_key_exists($key= $referer_link, $array = self::$pages)) {
      return self::$pages[$referer_link]['id'];
    }
    else
      return false;
    
  }
  
  
  public static function getPageTitle($curr_page_link) {

      if (!is_string($curr_page_link)) {
          return false;
      }

    if (array_key_exists($key = $curr_page_link, $array = self::$pages)) {
      return self::$pages[$curr_page_link]['title'];
    }
    else
      return false;
    
  }
  
  public static function getPageTitleByID($id) {
    
    $page_title = 'The page title was not found in Sitemap.';
    foreach (self::$pages as $page) {
      if ($page['id'] == $id) {
        $page_title = $page['title'];
        break;
      }
    }
    
    return $page_title;
    
  }
  
  
} // end class Sitemap