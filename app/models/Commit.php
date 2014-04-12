<?php

/**
 * This is the model class for table "commits".
 *
 * The followings are the available columns in table 'commits':
 * @property integer $id
 * @property integer $member_id
 * @property integer $project_id
 * @property string $hash
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Members $member
 * @property Projects $project
 */
class Commit extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'commits';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('id, member_id, project_id', 'required'),
			array('id, member_id, project_id', 'numerical', 'integerOnly'=>true),
			array('hash', 'length', 'max'=>45),
			array('date', 'safe'),
			array('id, member_id, project_id, hash, date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		
		return array(
			'member' => array(self::BELONGS_TO, Member::className(), 'member_id'),
			'project' => array(self::BELONGS_TO, Project::className(), 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'member_id' => 'Member',
			'project_id' => 'Project',
			'hash' => 'Hash',
			'date' => 'Date',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Commits the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
