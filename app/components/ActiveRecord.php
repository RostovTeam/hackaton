<?php

/**
 * Extended active record class with helper functions
 */
class ActiveRecord extends CActiveRecord 
{
    use \Traits\ClassName;
    /**
     * @var string field name with record creation date
     */
    protected $createdField = 'created';

    /**
     * @var string field name with record last update date
     */
    protected $updatedField = 'updated';

    /**
     * Sets created and updated field values
     *
     * @return bool true
     */
    protected function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        if (isset($this->getMetaData()->tableSchema->columns[$this->updatedField])) {
            $this->{$this->updatedField} = new CDbExpression('CURRENT_TIMESTAMP');
        }

        if ($this->isNewRecord && isset($this->getMetaData()->tableSchema->columns[$this->createdField])) {
            $this->{$this->createdField} = new CDbExpression('CURRENT_TIMESTAMP');
        }

        return true;
    }


    /**
     * Start DB transaction
     *
     * @param CDbConnection $connection
     * @return CDbTransaction
     */
    public static function beginTransaction($connection = null)
    {
        if ($connection === null) {
            $connection = Yii::app()->getDb();
        }

        return $connection->beginTransaction();
    }

    /**
     * Commit current DB connection transaction
     *
     * @static
     * @param CDbConnection $connection
     */
    public static function commitTransaction($connection = null)
    {
        if ($connection === null) {
            $connection = Yii::app()->getDb();
        }

        /** @var CDbTransaction $transaction */
        if (($transaction = $connection->getCurrentTransaction()) === null) {
            throw new ActiveRecordException('Transaction not started');
        }

        $transaction->commit();
    }

    /**
     * Rollback current DB connection transaction
     *
     * @static
     * @param CDbConnection $connection
     */
    public static function rollbackTransaction($connection = null)
    {
        if ($connection === null) {
            $connection = Yii::app()->getDb();
        }

        /** @var CDbTransaction $transaction */
        if (($transaction = $connection->getCurrentTransaction()) === null) {
            throw new ActiveRecordException('Transaction not started');
        }

        $transaction->rollback();
    }
}
