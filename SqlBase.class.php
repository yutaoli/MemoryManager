<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SqlBase
 * ���� DML, DQL, DDL, DCL����
 * DML���Ա����ݽ���д��������insert, update, delete
 * DQL���Ա����ݽ��ж���������select
 * DDL���Ա�ṹ���в�������create, alter, drop
 * DCL���Ա������Ȩ����grant,deny,revoke
 * @author yutaoli <yutaoli@athena.com>
 */
class SqlBase {

    //put your code here
    public $conn;
    public $host;
    public $port;
    public $user;
    public $passwd;
    public $dbname;

    public function __construct($host, $port, $user, $passwd, $dbname) {
        /* @var $port type */
        $this->host = "{$host}:{$port}";
        $this->user = $user;
        $this->passwd = $passwd;
        $this->dbname = $dbname;

        echo "$this->host";
        $this->conn = mysql_connect($this->host, $this->user, $this->passwd) or die("mysql_connect errno:" . mysql_errno() . ", error: " . mysql . error());

        mysql_select_db($this->dbname, $this->conn) or die("cannot use db[ {$this->dbname}], errno:" . mysql_errno() . ", error:" . mysql . error());
    }

    /**
     * �ر�����
     */
    public function __destruct() {
        $this->close_connect();
    }

    /**
     * DML���Ա����ݽ���д��������insert�� update��delete
     * @param string $sql�� sql��sql���
     * @return int ��-1��ʧ�ܣ�0��д�����ݳɹ���1��д�����ݳɹ���û�����ܵ�Ӱ��
     */
    public function execute_dml($sql) {
        $ret = mysql_query($sql, $this->conn) or die("mysql_query error, sql[{$sql}], errno:" . mysql_errno() . ", error:" . mysql_error());

        if (false == $ret) {
            //ִ��ʧ��
            return -1;
        } else {
            if (mysql_affected_rows($this->conn) > 0) {
                //ִ�гɹ�
                return 0;
            } else {
                //û�����ܵ�Ӱ��
                return 1;
            }
        }
    }

    /**
     * DQL���Ա����ݽ��ж���������select
     * @param string $sql��sql���
     * @return type�����ݱ���Ҫ��mysql_fetch_assoc()ȡ��
     */
    public function execute_dql($sql) {
        $res = mysql_query($sql, $this->conn) or die("mysql_query error, sql[{$sql}], errno:" . mysql_errno() . ", error:" . mysql_error());
        return $res;
    }

    /**
     * DQL���Ա����ݽ��ж���������select
     * @param type $sql
     * @return array��array�����ж��У���assoc array����ʽ����
     */
    public function execute_dql_get_assoc_array($sql) {
        $res = mysql_query($sql, $this->conn) or die("mysql_query error, sql[{$sql}], errno:" . mysql_errno() . ", error:" . mysql_error());

        $array = array();
        $i = 0;
        while ($row = mysql_fetch_assoc($res)) {
            $array[$i++] = $row;
        }

        //�ͷ�mysql�����ռ�õ��ڴ�
        mysql_free_result($res);
        return $array;
    }

    /**
     * DQL���Ա����ݽ��ж���������select
     * @param type $sql
     * @return array , array�����ж��У���row array����ʽ����
     */
    public function execute_dql_get_row_array($sql) {
        $res = mysql_query($sql, $this->conn) or die("mysql_query error, sql[{$sql}], errno:" . mysql_errno() . ", error:" . mysql_error());

        $array = array();
        $i = 0;
        while ($row = mysql_fetch_row($res)) {
            $array[$i++] = $row;
        }

        //�ͷ�mysql�����ռ�õ��ڴ�
        mysql_free_result($res);
        return $array;
    }

    /**
     * DDL���Ա�ṹ���в�������create��alter��drop
     * @param type $sql�� sql���
     */
    public function execute_ddl($sql) {
        
    }

    /**
     * DCL���Ա������Ȩ����grant��deny��revoke
     * @param type $sql, sql���
     */
    public function execute_dcl($sql) {
        
    }

    public function close_connect() {
        if (!empty($this->conn)) {
            mysql_close($this->conn);
        }
    }

}

?>
