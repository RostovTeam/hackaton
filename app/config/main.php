<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php'),
    array(
        'sourceLanguage' => 'en',
        'language' => 'en',
        // application components
        'components' => array(
            'db' => require("db.php"),
            'clientScript' => array(
                'class' => ClientScript::className(),
                'packages' => require __DIR__ . '/assets.php',
            ),
            'cache' => array(
                'class' => 'system.caching.CDummyCache',
            ),
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'error, warning, info',
                    ),
                    array(
                        'class' => 'CWebLogRoute',
                    ),
                    array(
                        'class' => 'CProfileLogRoute',
                    ),
                ),
            ),
        ),
    )
);
