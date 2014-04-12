<?php

return CMap::mergeArray(
                require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php'), array(
            'sourceLanguage' => 'en',
            'language' => 'en',
            // application components
            'components' => array(
                'db' => array(
                    'pdoClass' => 'NestedPDO',
                    'connectionString' => 'mysql:host=localhost;dbname=lis1',
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
                    'enableParamLogging' => true,
                    'enableProfiling' => true,
                    'autoCommit' => true,
                ),
                'cache' => array(
                    'class' => 'system.caching.CDummyCache',
                ),
            ),
                )
);
