<?php
class Logger
{
    private static $lineNumber = 0;
    private static $textLog ='';

    /**
     * @param $string
     */
    public static function writeLine($string) {

        if (false == TM_DEBUG) return false;
        $time_write = date('Ymd-G-i-s');
        $file = $_SERVER['DOCUMENT_ROOT'] . SUBFOLDER_PATH . '/logs/class_Logger-' . $time_write
            . '-line-' . ++self::$lineNumber . '-' . rand(1000, 9999) . '.txt';
        $line = "Line: " . (string) $string . "\n";

        // Пишем содержимое в файл,
        // используя флаг FILE_APPEND flag для дописывания содержимого в конец файла
        // и флаг LOCK_EX для предотвращения записи данного файла кем-нибудь другим в данное время
        file_put_contents($file, $line, FILE_APPEND | LOCK_EX);

        return true;
    }

    /**
     * @return bool
     */
    public static function write() {

        if (false ==TM_DEBUG) return false;
        $file = $_SERVER['DOCUMENT_ROOT'] . SUBFOLDER_PATH . '/logs/class_Logger-' . date('Ymd-G-i-s')
            . '-' . rand (1000, 9999) . '.txt';

        // Пишем содержимое в файл,
        // используя флаг FILE_APPEND flag для дописывания содержимого в конец файла
        // и флаг LOCK_EX для предотвращения записи данного файла кем-нибудь другим в данное время
        file_put_contents($file, self::$textLog, FILE_APPEND | LOCK_EX);

        return true;
    }

    public static function laydown($string) {

        if (false == TM_DEBUG) return false;
        self::$textLog .= (string) $string . "\n";

        return true;
    }

}