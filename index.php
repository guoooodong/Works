<?php

session_start();

//类库自动载入
require 'vendor/autoload.php';

$app = new \Slim\Slim();
$app->config(array(
    'templates.path' => './themes' //模板路径
));
App\Start::test($app);