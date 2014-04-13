<?php

/**
 * This is the model class for table "project_criterias".
 *
 * The followings are the available columns in table 'project_criterias':
 * @property integer $id
 * @property integer $criterias_id
 * @property integer $projects_id
 * @property integer $value
 * @property integer $expert_id
 *
 * The followings are the available model relations:
 * @property Criterias $criterias
 * @property Projects $projects
 * @property Experts $expert
 */
class ProjectCriteria extends ActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'project_criterias';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('criteria_id, project_id, expert_id', 'required'),
            array('criteria_id, project_id, value, expert_id', 'numerical', 'integerOnly' => true),
            array('id, criteria_id, project_id, value, expert_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'criterias' => array(self::BELONGS_TO, Criteria::className(), 'criteria_id'),
            'projects' => array(self::BELONGS_TO, Project::className(), 'project_id'),
            'expert' => array(self::BELONGS_TO, Expert::className(), 'expert_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'criteria_id' => 'Criterias',
            'project_id' => 'Projects',
            'value' => 'Value',
            'expert_id' => 'Expert',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ProjectCriterias the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
