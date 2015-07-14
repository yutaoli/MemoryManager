<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SqlBase
 * 定义 DML, DQL, DDL, DCL方法
 * DML：对表数据进行写操作，如insert, update, delete
 * DQL：对表数据进行读操作，如select
 * DDL：对表结构进行操作，如create, alter, drop
 * DCL：对表进行授权，如grant,deny,revoke
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
     * 关闭连接
     */
    public function __destruct() {
        $this->close_connect();
    }

    /**
     * DML：对表数据进行写操作，如insert， update，delete
     * @param string $sql， sql：sql语句
     * @return int ，-1：失败，0：写入数据成功，1：写入数据成功，没有行受到影响
     */
    public function execute_dml($sql) {
        $ret = mysql_query($sql, $this->conn) or die("mysql_query error, sql[{$sql}], errno:" . mysql_errno() . ", error:" . mysql_error());

        if (false == $ret) {
            //执行失败
            return -1;
        } else {
            if (mysql_affected_rows($this->conn) > 0) {
                //执行成功
                return 0;
            } else {
                //没有行受到影响
                return 1;
            }
        }
    }

    /**
     * DQL：对表数据进行读操作，如select
     * @param string $sql，sql语句
     * @return type，数据表，需要用mysql_fetch_assoc()取出
     */
    public function execute_dql($sql) {
        $res = mysql_query($sql, $this->conn) or die("mysql_query error, sql[{$sql}], errno:" . mysql_errno() . ", error:" . mysql_error());
        return $res;
    }

    /**
     * DQL：对表数据进行读操作，如select
     * @param type $sql
     * @return array，array：表中多行，以assoc array的形式返回
     */
    public function execute_dql_get_assoc_array($sql) {
        $res = mysql_query($sql, $this->conn) or die("mysql_query error, sql[{$sql}], errno:" . mysql_errno() . ", error:" . mysql_error());

        $array = array();
        $i = 0;
        while ($row = mysql_fetch_assoc($res)) {
            $array[$i++] = $row;
        }

        //释放mysql结果集占用的内存
        mysql_free_result($res);
        return $array;
    }

    /**
     * DQL：对表数据进行读操作，如select
     * @param type $sql
     * @return array , array：表中多行，以row array的形式返回
     */
    public function execute_dql_get_row_array($sql) {
        $res = mysql_query($sql, $this->conn) or die("mysql_query error, sql[{$sql}], errno:" . mysql_errno() . ", error:" . mysql_error());

        $array = array();
        $i = 0;
        while ($row = mysql_fetch_row($res)) {
            $array[$i++] = $row;
        }

        //释放mysql结果集占用的内存
        mysql_free_result($res);
        return $array;
    }

    /**
     * DDL：对表结构进行操作，如create，alter，drop
     * @param type $sql， sql语句
     */
    public function execute_ddl($sql) {
        
    }

    /**
     * DCL：对表进行授权，如grant，deny，revoke
     * @param type $sql, sql语句
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
