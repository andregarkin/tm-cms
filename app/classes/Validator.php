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
  
  /** Check date is in YYYY-MM-DD format
   *
   *
   * @ bool
   */
  public static function isDateFormat($may_date) {
    
    $dt = DateTime::createFromFormat("Y-m-d", $may_date);
    
    if ($dt !== false && !array_sum($dt->getLastErrors())) {
        //echo $dt->format('Y-m-d');
        return true;
    }
    return false;
    
  }
  
  
} // end class Validator