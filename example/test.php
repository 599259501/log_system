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
$creator = new BaseIDCreator();

$instance = LinkLog::getLogInstance($logger,$creator);
$instance->debug("test", "第一次测试", []);
sleep(10);
$instance->info("test", "第2次测试", []);