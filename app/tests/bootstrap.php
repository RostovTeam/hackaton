<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once __DIR__ . '/../../vendor/autoload.php';

$config = __DIR__ . '/../config/test.php';

require_once __DIR__ . '/../../vendor/yiisoft/yii/framework/test/CDbTestCase.php';
require_once __DIR__ . '/RESTfulApiTestCase.php';
require_once __DIR__ . '/ApiTestCase.php';

error_reporting(E_ALL & ~(E_NOTICE | E_WARNING));

Yii::createApplication(WebApplication::className(), $config);

