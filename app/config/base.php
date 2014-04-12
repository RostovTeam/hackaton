<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'homeUrl' => array('site/login'),
    'sourceLanguage' => 'ru',
    'language' => 'ru',
    'name' => '',
    'preload' => array('log'),
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.controllers.*',
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => false,
            'generatorPaths' => array('application.gii'),
            //'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'request' => array(
            'class' => 'HttpRequest'
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('site/login'),
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'caseSensitive' => true,
            'rules' => array(
                '<controller:[a-zA-Z]+>/<id:\d+>' => '<controller>/view',
                '<controller:[a-zA-Z]+>/<action:[a-zA-Z]+>/<id:\d+>' => '<controller>/<action>',
                '<controller:[a-zA-Z]+>/<action:[a-zA-Z]+>' => '<controller>/<action>',
            ),
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning, info',
                ),
//                                array(
//					'class'=>'CProfileLogRoute',
//				),
//                array(
//                    'class' => 'CWebLogRoute',
//                ),
            ),
        ),
    ),
    'params' => require(dirname(__FILE__) . '/params.php'),
);
