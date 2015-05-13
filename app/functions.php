<?php

/**
 * @param $class_name
 */
function __autoload($class_name) {
  include ('classes/' . $class_name . '.php');
  //Printer::log($class_name);
    Logger::laydown($class_name);
}