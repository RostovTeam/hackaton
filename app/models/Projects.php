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
class Projects extends ActiveRecord
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
			array('event_id, owner_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>500),
			array('description, created', 'safe'),
			array('id, event_id, owner_id, name, description, created', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'commits' => array(self::HAS_MANY, 'Commits', 'project_id'),
			'projectCriteriases' => array(self::HAS_MANY, 'ProjectCriterias', 'projects_id'),
			'event' => array(self::BELONGS_TO, 'Events', 'event_id'),
			'owner' => array(self::BELONGS_TO, 'Members', 'owner_id'),
			'teams' => array(self::HAS_MANY, 'Teams', 'project_id'),
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
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
