<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'clicangoevent-app',
    'defaultRoute' => 'module\LandingPage',
    'basePath' => dirname(__DIR__),

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],


    /*    'as access' => [
//    'as beforeRequest' => [
//        'class' => \yii\filters\AccessControl::className(),
//        'class' => 'dektrium\rbac\components\AccessControl',
        'class' => \mdm\admin\components\AccessControl::className(),
        'allowActions' => [
            'site/*',
            'admin/*',
            'partner/*',
            'product/*',
            'reservation/*',
            'payment/*',
            'subscription/*',
            'user/*',
            'rbac/*',
            'gii/*',
            'debug/*',
//            'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ],
        
    ],*/
    'params' => $params,
];


return $config;
