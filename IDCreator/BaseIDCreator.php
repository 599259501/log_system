<?php
/**
 * Created by PhpStorm.
 * User: 40435
 * Date: 2018/12/15
 * Time: 23:11
 */
namespace TRACE_LOG\IDCreator;

class BaseIDCreator{
    public function getLinkId(){
        return uniqid();
    }
}