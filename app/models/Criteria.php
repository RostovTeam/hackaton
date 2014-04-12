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
            array('id', 'required'),
            array('id', 'numerical', 'integerOnly' => true),
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
            'criteriaValues' => array(self::HAS_MANY, CriteriaValues::className(),
                'criteria_id'),
            'projectCriteriases' => array(self::HAS_MANY, ProjectCriterias::className(), 'criterias_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'created' => 'Created',
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
