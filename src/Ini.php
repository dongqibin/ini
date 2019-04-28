<?php
/**
 * Created by PhpStorm.
 * User: DJ
 * Date: 2019/4/28
 * Time: 14:46
 */

namespace dongqibin\ini;


class Ini
{
    public $config = []; //config
    private $_file = ''; //the file of config
    private $_string = ''; //the string of config

    public function loadFile($file) {
        $this->_file = $file;
        $this->decodeByFile();
        return $this;
    }

    public function load($config) {
        $this->config = $config;
        return $this;
    }

    public function getFile() {
        return $this->_file;
    }

    public function setFile($file) {
        $this->_file = $file;
        return $this;
    }

    public function getAll() {
        return $this->config;
    }

    public function decodeByFile($file='') {
        if(!$file) $file = $this->_file;
        $configs = file($file);
        $this->decode($configs);
    }

    public function decode($configs) {
        $key = '';
        foreach($configs as $config) {
            if(empty(trim($config))) continue;
            if(strpos($config, '#') === 0) {
                $key = trim(substr($config, 1));
                $this->config[$key] = [];
                continue;
            }

            list($k, $v) = explode('=', $config);
            $k = trim($k);
            $v = trim($v);
            if($key) {
                $this->config[$key][$k] = $v;
            } else {
                $this->config[$k] = $v;
            }
        }
    }

    public function encode($configs=[]) {
        if(!$configs) $configs = $this->getAll();

        $str = '';
        foreach($configs as $key=>$config) {
            if (is_array($config)) {
                $str .= PHP_EOL . '#' . $key . PHP_EOL;
                foreach ($config as $k => $v) {
                    $str .= $k . '=' . $v . PHP_EOL;
                }
            } else {
                $str .= $key . '=' . $config . PHP_EOL;
            }
        }
        return $str;
    }

    public function write($file='', $config=[]) {
        if($file) $this->setFile($file);
        if($config) $this->load($config);

        $config = $this->encode();
        file_put_contents($this->getFile(), $config);
        return true;
    }
}