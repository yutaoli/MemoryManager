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

    //��һҳ 1 2 3 4 ��һҳ ��100ҳ GO
    public $perPage; //ÿҳ��������¼
    public $nowPage; //��ǰչʾ���ǵڼ�ҳ������
    public $displayPageCount; //һ��չʾ����ҳ
    public $goUrl; //���ҳ��תurl
  

}

class FenyePageRsp {

    //put your code here
    //��һҳ 1 2 3 4 ��һҳ ��100ҳ GO
    public $totalPage; //һ������ҳ
    public $res; //��ҳ���
    public $navigator; //���������Ϣ

}

class TableBase {
    //put your code here
}

?>
