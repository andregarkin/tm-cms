<?php
class Printer
{
  
  public static function printnow($var, $var_name) {
    if (false == TM_DEBUG) return;
    print $var_name . ': <pre>';
    print_r($var);
    print '</pre>';
  }
  
  public static function gettype($var) {
    if (false == TM_DEBUG) return;
    print '<pre>gettype: '. gettype($var) .'</pre>';
  }
  
}