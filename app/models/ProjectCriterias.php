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
class ProjectCriterias extends ActiveRecord
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
			array('criterias_id, projects_id, expert_id', 'required'),
			array('criterias_id, projects_id, value, expert_id', 'numerical', 'integerOnly'=>true),
			array('id, criterias_id, projects_id, value, expert_id', 'safe', 'on'=>'search'),
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
			'criterias' => array(self::BELONGS_TO, 'Criterias', 'criterias_id'),
			'projects' => array(self::BELONGS_TO, 'Projects', 'projects_id'),
			'expert' => array(self::BELONGS_TO, 'Experts', 'expert_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'criterias_id' => 'Criterias',
			'projects_id' => 'Projects',
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
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
