<?php

namespace App;

use \Slim\Slim;

class Start{
    static function test(\Slim\Slim $app){

        $app->get(
            '/hello',
            function () {
                echo 'Say Hello';
            }
        );
        $app->get(
            '/',
            function () {
                echo 'Say Index';
            }
        );
        $app->get('/index',
            function () use ($app){
                $app->render('main.php');
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