<?php

return CMap::mergeArray(
                require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php'),
                array(
            'sourceLanguage' => 'en',
            'language' => 'en',
            // application components
            'components' => array(
                'db' => array(
                    'connectionString' => 'mysql:host=localhost;dbname=hackaton',
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => 'hackaton',
                    'charset' => 'utf8',
                ),
                'cache' => array(
                    'class' => 'system.caching.CDummyCache',
                ),
            ),
                )
);
