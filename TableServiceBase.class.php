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
     * ��ȡ���ݿ��ҳ����
     */
    abstract public function getFenyePage(FenyePageReq $fenyePageReq, FenyePageRsp $fenyePageRsp);
}

?>
