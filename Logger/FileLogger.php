<?php
/**
 * Created by PhpStorm.
 * User: 40435
 * Date: 2018/12/17
 * Time: 22:00
 */

require_once 'LinkLogger.php';
class FileLogger extends LinkLogger{
    static $date;
    public function __construct()
    {
        self::$date = date("Ymd", time());
        $this->setBaseDir(dirname(__FILE__));
    }

    public function addRecord($level, $file, $message, $context = [])
    {
        $dirs = $this->baseDir.DIRECTORY_SEPARATOR.self::$date;

        if (!is_dir($dirs)) {
            mkdir($dirs, 0777, true);
        }
        $logName = $dirs.DIRECTORY_SEPARATOR.$file.'.log';

        file_put_contents($logName, sprintf("%s|%s|||%s\r\n", $level, $message, json_encode($context)), FILE_APPEND);

        return true;
    }
}