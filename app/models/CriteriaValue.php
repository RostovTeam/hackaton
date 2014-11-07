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
class CriteriaValue extends ActiveRecord
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
			array('criteria_id,value,label', 'required'),
			array('criteria_id, value', 'numerical', 'integerOnly'=>true),
			array('criteria_id, value', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'criteria' => array(self::BELONGS_TO, Criteria::className(), 'criteria_id'),
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
