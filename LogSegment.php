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

    public function __construct(LinkLogger $logger,BaseIDCreator $idCreator,LogSegment $preSegment)
    {
        $this->logger = $logger;
        $this->linkIdCreator = $idCreator;
        $this->preSegment = $preSegment;
        $this->logTime = time();
    }

    public function debug(){

    }
}