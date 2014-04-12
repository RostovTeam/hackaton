<?php

/**
 * This is the model class for table "criteria_values".
 *
 * The followings are the available columns in table 'criteria_values':
 * @property integer $id
 * @property integer $criteria_id
 * @property integer $max_value
 *
 * The followings are the available model relations:
 * @property Criterias $criteria
 */
class CriteriaValues extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'criteria_values';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('id, criteria_id, max_value', 'required'),
			array('id, criteria_id, max_value', 'numerical', 'integerOnly'=>true),
			array('id, criteria_id, max_value', 'safe', 'on'=>'search'),
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
			'criteria' => array(self::BELONGS_TO, 'Criterias', 'criteria_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'criteria_id' => 'Criteria',
			'max_value' => 'Max Value',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CriteriaValues the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
