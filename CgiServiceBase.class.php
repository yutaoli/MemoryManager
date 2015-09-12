<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CgiServiceBase
 *
 * @author yutaoli <yutaoli@athena.com>
 */
abstract class CgiServiceBase {
    
     //member variable here
     
    
    
    
    //member function here
    public function __construct() {
        ;
    }

    public function checkInput() {
        
    }

    public function preProcess() {
        $ret = $this->checkInput();
        if ($ret != 0) {
            echo "checkInput() error, ret[$ret]";
            return $ret;
        }
        //add your code here
    }

    public function process() {
        
    }

    public function postProcess() {
        
    }

    /**
     * ¿ò¼ÜÈë¿Úº¯Êý
     * @return type
     */
    public function run() {
        $ret = $this->preProcess();
        if ($ret != 0) {
            echo "preProcess error, ret[{$ret}]";
            return $ret;
        }

        $ret = $this->process();
        if ($ret != 0) {
            echo "process error, ret[{$ret}]";
            return $ret;
        }

        $ret = $this->postProcess();
        if ($ret != 0) {
            echo "postProcess error, ret[{$ret}]";
            return $ret;
        }
    }

}

?>
