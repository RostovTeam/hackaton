<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once __DIR__ . '/../../vendor/autoload.php';

$config = __DIR__ . '/../config/test.php';

require_once __DIR__ . '/../../vendor/yiisoft/yii/framework/test/CDbTestCase.php';

error_reporting(E_ALL & ~(E_NOTICE | E_WARNING));

Yii::createApplication(WebApplication::className(), $config);

//Запускаем миграцию базы данных
//$migrateCommand = new \Command\MigrateCommand('migrate', new CConsoleCommandRunner());
//$migrateCommand->init();
//$migrateCommand->run(array('up', '--interactive=0'));