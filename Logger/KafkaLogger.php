<?php
/**
 * Created by PhpStorm.
 * User: 40435
 * Date: 2018/12/22
 * Time: 20:17
 */

require_once '../Logger/LinkLogger.php';
use RdKafka\Producer;

class KafkaLogger extends LinkLogger
{
    protected $producer;
    protected $partitionList = [0];
    protected $partitionCal = 1; // 计数器
    protected $partition = 0;

    public function setProducer(Producer $producer){
        $this->producer = $producer;
    }

    public function setPartition($partition){
        $this->partition = $partition;
    }

    public function setLogTopic($topic){
        $this->logSource = $topic;
    }

    public function addRecord($level, $message, $context = []){
        $topic = $this->producer->newTopic($this->logSource);
        $partition = $this->partition;
        $topic->produce(RD_KAFKA_PARTITION_UA, $partition, json_encode(['message'=> $message, 'context'=> $context]));
    }

    public function getPartitionAndReset(){
        $partitionCount = count($this->partitionList);
        $index = $this->partitionCal%$partitionCount;
        $this->partitionCal++;
        return $this->partitionList[$index];
    }


}