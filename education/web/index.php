<?php
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
//print_r($_SERVER);
//echo $_SERVER["REMOTE_ADDR"];
date_default_timezone_set('Asia/Shanghai'); 
defined('baseURI') or define('baseURI', $_SERVER['CONTEXT_PREFIX'].'/index.php?r=/education');
require(__DIR__ . '/../education/Tool.php');
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
