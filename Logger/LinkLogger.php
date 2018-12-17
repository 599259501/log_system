<?php
/**
 * Created by PhpStorm.
 * User: 40435
 * Date: 2018/12/15
 * Time: 22:44
 */

require_once '../LinkLog.php';

class LinkLogger{

    const DEBUG_LEVEL = 'debug';
    const INFO_LEVEL = 'info';
    const NOTICE_LEVEL = 'notice';
    const WARN_LEVEL = 'warn';
    const ERROR_LEVEL = 'error';
    const CRITICAL_LEVEL = 'critical';
    const ALERT_LEVEL = 'alert';
    const EMERGENCY_LEVEL = 'emergency';

    public $baseDir;
    public $levelPriority = [
        self::DEBUG_LEVEL,
        self::INFO_LEVEL,
        self::NOTICE_LEVEL,
        self::WARN_LEVEL,
        self::ERROR_LEVEL,
        self::CRITICAL_LEVEL,
        self::ALERT_LEVEL,
        self::EMERGENCY_LEVEL,
    ];

    public function debug($file, $message, $context = []){
        return $this->addRecord(__FUNCTION__, $file, $message, $context);
    }

    public function info($file, $message, $context = []){
        return $this->addRecord(__FUNCTION__, $file, $message, $context);
    }

    public function notice($file, $message, $context = []){
        return $this->addRecord(__FUNCTION__, $file, $message, $context);
    }

    public function warn($file, $message, $context = []){
        return $this->addRecord(__FUNCTION__, $file, $message, $context);
    }

    public function error($file, $message, $context = []){
        return $this->addRecord(__FUNCTION__, $file, $message, $context);
    }

    public function critical($file, $message, $context = []){
        return $this->addRecord(__FUNCTION__, $file, $message, $context);
    }

    public function alert($file, $message, $context = []){
        return $this->addRecord(__FUNCTION__, $file, $message, $context);
    }

    public function emergency($file, $message, $context = []){
        return $this->addRecord(__FUNCTION__, $file, $message, $context);
    }

    public function addRecord($level,$file,$message,$context = []){
        return $this->addRecord(__FUNCTION__, $file, $message, $context);
    }

    public function getPriority($level){
        return array_search($level, $this->levelPriority);
    }

    public function setBaseDir($baseDir){
        $this->baseDir = $baseDir;
    }
}