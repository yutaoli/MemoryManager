<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MemoryManagerDb
 *
 * @author Administrator
 */
require_once 'SqlBase.class.php';

class MemoryManagerDb extends SqlBase {

    //put your code here
    public function __construct($host = "localhost", $port = 3306, $user = "root", $passwd = "1990610", $dbname = "memorymanager") {
        parent::__construct($host, $port, $user, $passwd, $dbname);
    }

}

?>
