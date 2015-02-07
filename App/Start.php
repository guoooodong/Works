<?php

namespace App;

use \Slim\Slim;

class Start{

    static function test(){


        $twig_vars = \Lib\Sys\SlimConfig::getTwigVars();
        $config = $twig_vars['config'];

        $twigView = new \Slim\Views\Twig();


        $app = new \Slim\Slim(array(
            'debug'=> true,
            'view' => $twigView,
            'templates.path' => 'themes/'.$config['theme']."/", //模板路径
            'twigVars'=> $twig_vars
        ));

        $app->view->parserOptions = array(
            'charset' => 'utf-8',
            'auto_reload' => true,
            'autoescape' => false
        );
//
//        $app->config(array(
//            'debug'=> true,
//            'templates.path' => 'themes/'.$config['theme']."/", //模板路径
//            'twigVars'=> $twig_vars
//        ));

        $app->view->parserExtensions = array(new \Slim\Views\TwigExtension());

        $app->notFound(function () use ($app) {
            $twig_vars = \Lib\Sys\SlimConfig::getTwigVars();
            $app->render('404.html',$twig_vars);
        });

        //PUBLIC
        $app->get('/',
            function () use ($app){
                $twig_vars = $app->config('twigVars');
                $pages = $twig_vars['pages'];
                $twig_vars['page'] = $pages['index'];
                if($twig_vars['page']!= 0)

                $app->render('index.html',$twig_vars);
            }
        );
        $app->get('/login',
            function () use ($app){
                $app->render('login.php');
            }
        );
        $app->get('/works',
            function () use ($app){
                $app->render('works.php');
            }
        );
        $app->get('/friend',
            function () use ($app){
                $app->render('friend.php');
            }
        );
        $app->get(
            '/list',
            function () {
                echo 'This is works';
            }
        );
        $app->post(
            '/post',
            function () {
                echo 'This is a POST route';
                var_dump($_POST['name']);
            }
        );
        $app->run();
    }
}