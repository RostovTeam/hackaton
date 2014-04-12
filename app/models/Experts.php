<?php

/**
 * This is the model class for table "experts".
 *
 * The followings are the available columns in table 'experts':
 * @property integer $id
 * @property string $full_name
 * @property string $created
 *
 * The followings are the available model relations:
 * @property ProjectCriterias[] $projectCriteriases
 */
class Experts extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'experts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('full_name', 'length', 'max'=>400),
			array('created', 'safe'),
			array('id, full_name, created', 'safe', 'on'=>'search'),
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
			'projectCriteriases' => array(self::HAS_MANY, 'ProjectCriterias', 'expert_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'full_name' => 'Full Name',
			'created' => 'Created',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Experts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
