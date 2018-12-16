<?php
/**
 * Created by PhpStorm.
 * User: 40435
 * Date: 2018/12/16
 * Time: 18:06
 */

require 'Logger/LinkLogger.php';
require 'IDCreator/BaseIDCreator.php';

class LogSegment
{
    public $preSegment;

    public $nextSegment;

    public $logFormat;

    public $logTime;

    public $logger;

    public $linkIdCreator;

    public $tranceId;

    public $headerSegment;

    public function __construct(LinkLogger $logger,BaseIDCreator $idCreator,LogSegment $preSegment)
    {
        $this->logger = $logger;
        $this->linkIdCreator = $idCreator;
        $this->preSegment = $preSegment;
        $this->logTime = time();

        if (is_null($preSegment)) {
            $this->headerSegment = &$this;
        }

        $this->tranceId = $idCreator->getLinkId();
    }

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

    public function addRecord($level, $file, $message, $context = []){
        if (!is_null($this->preSegment)) {
            $context['cost_time'] = $this->logTime - $this->preSegment->logTime;
            $context['parent_trance_id'] = $this->tranceId;
            $context['request_trance_id'] = $this->headerSegment->tranceId;
        }

        return $this->logger->$level($file, $message, $context);
    }
}