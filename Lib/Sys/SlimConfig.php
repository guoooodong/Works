<?php
/**
 * Created by PhpStorm.
 * User: guodont
 * Date: 15-2-7
 * Time: 下午9:13
 */

namespace Lib\Sys;

class SlimConfig {
    public static function getTwigVars() {
        $config = SlimConfig::getConfig();
        $menus = SlimConfig::getMenu('menu');
        $pages = SlimConfig::getAllFrom('pages');
        $themes = SlimConfig::getThemes($config['path']."/themes");

        $twig_vars = array(
            'config'    =>  $config,
            'menus'     =>  $menus,
            'pages'     =>  $pages,
            'themes'    =>  $themes
        );

        return $twig_vars;
    }

    //Get the Config
    public static function getConfig(){
        if($_SERVER['HTTP_HOST'] == "localhost")
            $folder = "/Works";
        else
            $folder = "";
        $path = $_SERVER['DOCUMENT_ROOT'].$folder;
        $url = "http://".$_SERVER['HTTP_HOST'].$folder;

        $config = Json::read("config/config.json");

        if(!isset($config['url']) || $config['url'] == "")
            $config['url'] = $url;
        $config['path'] = $path;

        return $config;
    }

    //Update the Config
    public static function UpdateConfig($key,$value){
        if(!isset($config[$key]) || $config[$key] == "")
            $config[$key] = $value;
    }

    // Get all the Elements by Folder
    public static function getAllFrom($folder) {
        $iterator = new \DirectoryIterator("config/".$folder);
        $files = new \RegexIterator($iterator,'/\\'."json".'$/');
        foreach($files as $file){
            if($file->isFile()){
                $array = Json::read("config/".$folder."/". $file->getFilename());
                $fileNames[$array['Slug']] = $array;
            }
        }
        if ($folder == "blog")
            return array_reverse($fileNames);
        else
            return $fileNames;
    }

    //Get the Themes
    public static function getThemes($folder){
        $themes = array_diff(scandir($folder),array('..','.'));
        return $themes;
    }

    //Get Menu
    public static function getMenu($folder) {
        $iterator = new \DirectoryIterator("config/".$folder);
        $files = new \RegexIterator($iterator,'/\\'."json".'$/');
        foreach($files as $file){
            if($file->isFile()){
                $menu = Json::read("config/".$folder."/".$file->getFilename());
                $fileNames = $menu;
            }
        }
        if (isset($fileNames))
            return array_reverse(array_reverse($fileNames));
        else
            return "";
    }

}