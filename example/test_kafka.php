<?php
/**
 * Created by PhpStorm.
 * User: 40435
 * Date: 2018/12/22
 * Time: 23:12
 */
require_once '../LinkLog.php';
require_once '../LogSegment.php';
require_once '../Logger/FileLogger.php';
require_once '../IDCreator/BaseIDCreator.php';
require_once '../LogSegment.php';
require_once '../Logger/KafkaLogger.php';

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