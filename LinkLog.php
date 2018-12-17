<?php
/**
 * Created by PhpStorm.
 * User: 40435
 * Date: 2018/12/15
 * Time: 22:40
 */

require 'Logger/LinkLogger.php';
require 'IDCreator/BaseIDCreator.php';
class LinkLog{
    protected $logger;

    protected $idCreator;
    // 开始记录日志的时间，主要用来统计整个接口所花费的时间
    protected $beginTime;
    // 这里打算采用链表形式存储
    protected $headerSegment;
    // 当前的链路
    protected $currentSegment;
    // 最低的日志级别
    public $minLevel;

    public static $LinkLog;

    private function __construct(LinkLogger $logger,BaseIDCreator $idCreator)
    {
        $this->logger = $logger;
        $this->idCreator = $idCreator;
        $this->headerSegment = $this->currentSegment = new LogSegment($logger, $idCreator, NULL);
    }

    public static function getLogInstance(LinkLogger $logger,BaseIDCreator $idCreator){
        if (is_null(self::$LinkLog)) {
            self::$LinkLog = new self($logger,$idCreator);
        }

        return self::$LinkLog;
    }

    public function setMiniLevel($level){
        // todo 这里要对level做判断
        $this->minLevel = $level;
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        if (method_exists($this, $name)) {
            return $this->$name($arguments);
        }

        if (method_exists($this->headerSegment, $name)) {
            $preSegment = $this->currentSegment;
            $this->currentSegment = new LogSegment($this->logger, $this->idCreator, $preSegment);
            $preSegment->nextSegment = $this->currentSegment;
            return call_user_func_array(array($this->currentSegment, $name), $arguments);
        }

        throw new Exception("method not found!");
    }

    public static function __callStatic($name, $arguments){

        $instance = self::$LinkLog;

        if (method_exists($instance, $name)) {
            return call_user_func_array(array($instance, $name), $arguments);
        }

        if (method_exists($instance->headerSegment, $name)) {
            $preSegment = $instance->currentSegment;
            $instance->currentSegment = new LogSegment($instance->logger, $instance->idCreator, $preSegment);
            return call_user_func_array(array($instance->currentSegment, $name), $arguments);
        }

        throw new Exception("method not found!");
    }
}