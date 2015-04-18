<?php 
class Page {
  
  /** Need: $curr_link  
   *  get Current Page Link from $_SERVER[PHP_SELF]
   *  
   * Return eg:
   *  '/index.php'
   *  '/category/index.php'
   */
  public static function getCurrentLink() {
    
    $php_self = $_SERVER['PHP_SELF']; // '/tm-cms/index.php' |  '/tm-cms/category/index.php'
    
    $subfolder_path = SUBFOLDER_PATH; // '/tm-cms'
    $offset = strlen($subfolder_path); // 7
    
    //Printer::printnow($offset, '$offset'); // 7
    
    $curr_link  = substr($string = $php_self, $start = $offset); // '/index.php'
    
    //Printer:: printnow($curr_link, '$curr_link'); // '/index.php'
    
    return $curr_link;
    
  }
  
} // end class Page