<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TableBase
 *
 * @author yutaoli <yutaoli@athena.com>
 */
class FenyePageReq {

    //上一页 1 2 3 4 下一页 共100页 GO
    public $perPage; //每页多少条记录
    public $nowPage; //当前展示的是第几页的数据
    public $displayPageCount; //一次展示多少页
    public $goUrl; //点击页跳转url
  

}

class FenyePageRsp {

    //put your code here
    //上一页 1 2 3 4 下一页 共100页 GO
    public $totalPage; //一共多少页
    public $res; //本页结果
    public $navigator; //输出导航信息

}

class TableBase {
    //put your code here
}

?>
