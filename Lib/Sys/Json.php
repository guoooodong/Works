<?php
namespace Lib\Sys;
/**
 * Class Json
 * @package Lib\Sys
 * JSON 配置文件读取
 */
class Json {
    public static function read($path) {
        if(file_exists($path)) {
            $string = file_get_contents($path);
            $json = json_decode($string,true);
            return $json;
        } else {
            return 0;
        }
    }
}