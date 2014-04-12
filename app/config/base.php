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
//        'gii' => array(
//            'class' => 'system.gii.GiiModule',
//            'password' => false,
//            'generatorPaths' => array('application.gii'),
//        //'ipFilters' => array('127.0.0.1', '::1'),
//        ),
    ),
    // application components
    'components' => array(
        'request' => array(
            'class' => 'BaseHttpRequest'
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
                array('<controller>/list', 'pattern' => 'api/<controller:[a-zA-Z]+>',
                    'verb' => 'GET'),
                array('<controller>/view', 'pattern' => 'api/<controller:[a-zA-Z]+>/<id:\d+>',
                    'verb' => 'GET'),
                array('<controller>/update', 'pattern' => 'api/<controller:[a-zA-Z]+>/<id:\d+>',
                    'verb' => 'PUT'),
                array('<controller>/delete', 'pattern' => 'api/<controller:[a-zA-Z]+>/<id:\d+>',
                    'verb' => 'DELETE'),
                array('<controller>/create', 'pattern' => 'api/<controller:[a-zA-Z]+>',
                    'verb' => 'POST'),
                
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

        'eauth' => array(
            'class' => 'ext.eauth.EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache'.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'services' => array( // You can change the providers and their classes.
                'facebook' => array(
                    // register your app here: https://developers.facebook.com/apps/
                    'class' => 'FacebookOAuthService',
                    'client_id' => '...',
                    'client_secret' => '...',
                ),
                'vkontakte' => array(
                    // register your app here: https://vk.com/editapp?act=create&site=1
                    'class' => 'VKontakteOAuthService',
                    'client_id' => '4302211',
                    'client_secret' => 'NEsrfCNCG3aSGHFmxqk6',
                ),
            ),
        ),
        'loid' => array(
            'class' => 'ext.lightopenid.loid',
        ),
    ),
    'params' => require(dirname(__FILE__) . '/params.php'),
);
