<?php 
class Iframe {
  
  /** Need: $referer_link  
   *         '/'
   *         '/index.php'
   *  from Referer: 'http://host.local/tm-cms/index.php?id=1'
   *
   */
  public static function getRefererLink() {
    
    /* Referer $_SERVER['HTTP_REFERER'] examples:
    'http://host.local/tm-cms/'
    'http://host.local/tm-cms/index.php?id=1'
    'http://host.local/tm-cms/?id=1'
    */
    
    $referer = $_SERVER['HTTP_REFERER']; // 'http://host.local/tm-cms/index.php?id=1'
    
    // TM CMS Address (URL)
    $tm_siteurl = 'http://' . SERVER_NAME . SUBFOLDER_PATH; // 'http://host.local/tm-cms'
    $offset = strlen($tm_siteurl); // 24
    
    //Printer::printnow($tm_siteurl, '$tm_siteurl'); // 'http://host.local/tm-cms'
    //Printer::printnow($offset, '$offset'); // 24
    
    // tiil with QUERY_STRING
    $referer_link_with_query_string  = substr($string = $referer, $start = $offset); // '/index.php?id=1'
    //Printer:: printnow($referer_link_with_query_string, '$referer_link_with_query_string'); // '/index.php?id=1'
    
    // cut QUERY_STRING from referer_link
    $question_mark_pos = strpos ( $haystack = $referer_link_with_query_string, $needle = '?'); // int | FALSE
    if ($question_mark_pos) {
      $referer_link = substr($string = $referer_link_with_query_string, $start = 0 , $length = $question_mark_pos);
      //$referer_link = strstr($haystack = $referer_link_with_query_string, $needle = '?', $before_needle = true);
    }
    else {
      $referer_link = $referer_link_with_query_string;
    }
    
    return $referer_link;
    
  }
  
} // end class Iframe