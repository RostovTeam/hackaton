<?php
date_default_timezone_set('Europe/Moscow') ;

require_once __DIR__ . '/../../vendor/autoload.php';

$config = __DIR__ . '/../config/main.php';

error_reporting(E_ALL & ~(E_NOTICE | E_WARNING));

Yii::createApplication(WebApplication::className(), $config)->run();