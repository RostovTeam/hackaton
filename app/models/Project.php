<?php

/**
 * This is the model class for table "projects".
 *
 * The followings are the available columns in table 'projects':
 * @property integer $id
 * @property integer $event_id
 * @property integer $owner_id
 * @property string $name
 * @property string $description
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Commits[] $commits
 * @property ProjectCriterias[] $projectCriteriases
 * @property Events $event
 * @property Members $owner
 * @property Teams[] $teams
 */
class Project extends ActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'projects';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('event_id, owner_id', 'required'),
            array('event_id, owner_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 500),
            array('description, created', 'safe'),
            array('id, event_id, owner_id, name, description, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {

        return array(
            'commits' => array(self::HAS_MANY, Commit::className(), 'project_id'),
            'projectCriteriases' => array(self::HAS_MANY, ProjectCriteria::className(), 'projects_id'),
            'event' => array(self::BELONGS_TO, Event::className(), 'event_id'),
            'owner' => array(self::BELONGS_TO, Member::className(), 'owner_id'),
            'team' => array(self::HAS_ONE, Team::className(), 'project_id','with'=>'members'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'event_id' => 'Event',
            'owner_id' => 'Owner',
            'name' => 'Name',
            'description' => 'Description',
            'created' => 'Created',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Projects the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
