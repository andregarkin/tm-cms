<?php
class Printer
{

  public static function printnow($var, $var_name, $hide = false) {
    if (false == TM_DEBUG) return;

    if (!$hide) {
      print $var_name . ': <pre>';
      print_r($var);
      print '</pre>';
    }
    else {
      print '<!--pr: '. $var_name . '-->';
      print_r($var);
      print '<!--pr: /' . $var_name . '-->';
    }
  }

  public static function gettype($var, $hide = false) {
    if (false == TM_DEBUG) return;
    if (!$hide) {
      print '<pre>gettype: '. gettype($var) .'</pre>';
    }
    else {
      print '<!--pr: gettype-->'. gettype($var) .'<!--pr: /gettype-->';
    }

  }

}