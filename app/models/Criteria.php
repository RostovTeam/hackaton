<?php

/**
 * This is the model class for table "criterias".
 *
 * The followings are the available columns in table 'criterias':
 * @property integer $id
 * @property string $name
 * @property string $created
 *
 * The followings are the available model relations:
 * @property CriteriaValues[] $criteriaValues
 * @property ProjectCriterias[] $projectCriteriases
 */
class Criteria extends ActiveRecord
{

    public $event_id;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'criterias';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('max_value,type', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 45),
            array('created', 'safe'),
            array('id, name, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'criteriaValues' => array(self::HAS_MANY, CriteriaValue::className(),
                'criteria_id'),
            'projectCriterias' => array(self::HAS_MANY, ProjectCriteria::className(),
                'criteria_id'),
        );
    }

    /**
     * 
     * 
     * @return boolean
     */
    public function beforeSave()
    {
        parent::beforeSave();

        if ($this->isNewRecord && $this->event_id)
        {
            $this->addToEvent($this->event_id);
        }

        return true;
    }

    public function addToEvent($event_id)
    {
        return Yii::app()->db->createCommand()->insert('event_members',
                        ['member_id' => $this->id, 'event_id' => $event_id]);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Criterias the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
