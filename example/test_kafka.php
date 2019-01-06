<?php
/**
 * Created by PhpStorm.
 * User: 40435
 * Date: 2018/12/22
 * Time: 23:12
 */
//require_once '../LinkLog.php';
use TRACE_LOG\LinkLog;
//require_once '../LogSegment.php';
use TRACE_LOG\LogSegment;
//require_once '../Logger/FileLogger.php';
use TRACE_LOG\Logger\FileLogger;
//require_once '../IDCreator/BaseIDCreator.php';
use TRACE_LOG\IDCreator\BaseIDCreator;
//require_once '../LogSegment.php';
use TRACE_LOG\LogSegment;
//require_once '../Logger/KafkaLogger.php';
use TRACE_LOG\Logger\KafkaLogger;

$producer = new RdKafka\Producer();
$producer->setLogLevel(LOG_DEBUG);
$producer->addBrokers("127.0.0.1:9092,127.0.0.1:9093,127.0.0.1:9094");

$logger = new KafkaLogger();
$logger->setLogTopic('log_system');
$logger->setProducer($producer);

$creator = new BaseIDCreator();
LinkLog::initLogInstance($logger,$creator);

for ($i=1;$i<=10;$i++){
    LinkLog::debug("第${i}次测试", []);
}