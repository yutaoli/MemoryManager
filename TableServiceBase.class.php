<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TableServiceBase
 *
 * @author yutaoli <yutaoli@athena.com>
 */

require_once 'TableBase.class.php';

abstract class TableServiceBase {

    //put your code here

    public function __construct() {
        
    }

    /**
     * 获取数据库分页数据
     */
    abstract public function getFenyePage(FenyePageReq $fenyePageReq, FenyePageRsp $fenyePageRsp);
}

?>
