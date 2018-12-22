<?php
/**
 * Created by PhpStorm.
 * User: 40435
 * Date: 2018/12/17
 * Time: 22:17
 */

require_once '../LinkLog.php';
require_once '../LogSegment.php';
require_once '../Logger/FileLogger.php';
require_once '../IDCreator/BaseIDCreator.php';
require_once '../LogSegment.php';

$logger = new FileLogger();
$logger->setLogSource('zhf_test');
$creator = new BaseIDCreator();

LinkLog::initLogInstance($logger,$creator);

for ($i=1;$i<=10;$i++){
    LinkLog::debug("第${i}次测试", []);
    sleep($i*$i);
}