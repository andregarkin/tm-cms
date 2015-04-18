<?php
class Validator {


  /** Check input string to match Number
   * 
   * notes: 
   * var_dump(ctype_digit(1));      // false
   * var_dump(ctype_digit(-1));     // false
   * var_dump(ctype_digit("1"));    // true
   * var_dump(ctype_digit("-1"));   // false
   * 
   * @ bool
   */
  public static function isID($may_id) {

    $res =  ctype_digit((string)$may_id);  // TRUE | FALSE
    
    return $res;
    
  }
  
  
} // end class Validator