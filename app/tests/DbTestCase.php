<?php
    /**
     * DbTestCase
     * Makes a better standard class
     *
     * @author Polosin Maxim <polosinms@mail.ru>
     * @copyright Geoads, 2012
     * @package Geoads
     */

    class DbTestCase extends CDbTestCase {
        
        public function truncateTable($tableName) {
            $db = $this->getDbConnection();
            $schema=$db->getSchema();
            if(($table=$schema->getTable($tableName))!==null)
            {
                $db->createCommand('TRUNCATE '.$table->rawName)->execute();
                $schema->resetSequence($table,1);
            }
            else
                throw new CException("Table '$tableName' does not exist.");
        }

    }
