<?php
error_reporting(E_ALL);
ini_set("display_startup_errors","1");
ini_set("display_errors","1");
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require_once '../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$dotenv = new Symfony\Component\Dotenv\Dotenv;
$dotenv->load(__DIR__.'/../.env');

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
