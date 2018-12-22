<?php
/**
 * Created by PhpStorm.
 * User: 40435
 * Date: 2018/12/16
 * Time: 18:06
 */

require_once 'Logger/LinkLogger.php';
require_once 'IDCreator/BaseIDCreator.php';

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

    public function __construct(LinkLogger $logger,BaseIDCreator $idCreator,$preSegment)
    {
        $this->logger = $logger;
        $this->linkIdCreator = $idCreator;
        $this->preSegment = $preSegment;
        $this->logTime = time();
        $this->tranceId = $idCreator->getLinkId();

        if (is_null($preSegment)) {
            $this->headerSegment = $this;
        } else {
            $this->headerSegment = $this->preSegment->headerSegment;
        }
    }

    public function debug($message, $context = []){
        return $this->addRecord(__FUNCTION__, $message, $context);
    }

    public function info($message, $context = []){
        return $this->addRecord(__FUNCTION__, $message, $context);
    }

    public function notice($message, $context = []){
        return $this->addRecord(__FUNCTION__, $message, $context);
    }

    public function warn($message, $context = []){
        return $this->addRecord(__FUNCTION__, $message, $context);
    }

    public function error($message, $context = []){
        return $this->addRecord(__FUNCTION__, $message, $context);
    }

    public function critical($message, $context = []){
        return $this->addRecord(__FUNCTION__, $message, $context);
    }

    public function alert($message, $context = []){
        return $this->addRecord(__FUNCTION__, $message, $context);
    }

    public function emergency($message, $context = []){
        return $this->addRecord(__FUNCTION__, $message, $context);
    }

    public function addRecord($level, $message, $context = []){
        if (!is_null($this->preSegment)) {
            $context['cost_time'] = $this->logTime - $this->preSegment->logTime;
            $context['parent_trance_id'] = $this->preSegment->tranceId;
            $context['request_trance_id'] = $this->tranceId;
        } else {
            $context['parent_trance_id'] = 0;
            $context['request_trance_id'] = $this->tranceId;
        }
        $context['first_trance_id'] = $this->headerSegment->tranceId;

        return $this->logger->$level($message, $context);
    }
}